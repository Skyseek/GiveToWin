<?php

class GTW_Emailer extends GTW_Service_Map
{ 
	protected $_maxProcesses = 5; 
	protected $_processes = array(); 
	protected $_signalQueue=array();   
	protected $_parentPID; 

	protected $_emailIdsBeingSent = array();
	protected $_emailProcessIdMap = array();
   
	public function __construct()
	{
		$this->_log("Starting up..."); 
		$this->_parentPID = getmypid();


		file_put_contents(APPLICATION_PATH . "/cli/mailer.pid", $this->_parentPID);

		pcntl_signal(SIGCHLD, array($this, "childSignalHandler")); 
	}

	public function getNextEmail()
	{
		$request = new Skyseek_Model_Entity_Collection_Request(1, 1);
		$request->addFilter('time_sent', '=', null);



		foreach($this->_emailIdsBeingSent as $id=>$true) {
			$request->addFilter('id', '!=', $id);
		}

		$result = GTW_Model_Email_Mapper::getInstance()->getCollection($request);
		

		return count($result) ? $result->current() : null;
	}
   
	/** 
	* Run the Daemon 
	*/ 
	public function start()
	{ 
		$this->_log("Started!"); 
		$sleeping = false;
		
		while(true) {
			if(count($this->_processes) <= $this->_maxProcesses) {
				
				$email = $this->getNextEmail();

				if($email && !$this->_isEmailLocked($email)) {
					$this->_sendEmail($email);
				} else {
					if(!$sleeping) {
						$this->_log("Nothing Queued. Going to sleep.");
						$sleeping = true;
					}

					sleep(1);
				}
			} else {
				$this->_log("Too much Mail!!! Give me a couple seconds to catch up!");
				sleep(3);
			}
		}
	}

	protected function _lockEmail(GTW_Model_Email $email)
	{
		$this->_emailIdsBeingSent[$email->id] = $email;
	}

	protected function _unLockEmail(GTW_Model_Email $email)
	{
		unset($this->_emailIdsBeingSent[$email->id]);
	}
	
	protected function _isEmailLocked(GTW_Model_Email $email)
	{
		return isset($this->_emailIdsBeingSent[$email->id]);
	}

	protected function _sendEmail(GTW_Model_Email $email)
	{
		$this->_lockEmail($email);
		$processId = pcntl_fork();

		if($processId == -1) {
			$this->_log("Unabled to start process...");
			$this->_unLockEmail($email);
		} else if($processId == 0) {
			$this->_log("Sending Email ({$email->id}) to {$email->to_email}...");
			$email->convertToZendMail()->send();
			exit(1);
		} else {
			$DB = Zend_Db_Table::getDefaultAdapter();
			$DB->closeConnection();
			$this->_emailProcessIdMap[$processId] = $email->id;
		}
	}
   

	/** 
	* Launch a job from the job queue 
	*/ 
	protected function launchJob($jobID){ 
		$processId = pcntl_fork();
		if($processId == -1){ 
			//Problem launching the job 
			error_log('Could not launch new job, exiting'); 
			return false; 
		} 
		else if ($processId){ 
			// Parent process 
			// Sometimes you can receive a signal to the childSignalHandler function before this code executes if 
			// the child script executes quickly enough! 
			// 
			$this->_processes[$processId] = $jobID; 
		   
			// In the event that a signal for this pid was caught before we get here, it will be in our _signalQueue array 
			// So let's go ahead and process it now as if we'd just received the signal 
			if(isset($this->_signalQueue[$processId])){ 
				$this->_log("found $processId in the signal queue, processing it now"); 
				$this->childSignalHandler(SIGCHLD, $processId, $this->_signalQueue[$processId]); 
				unset($this->_signalQueue[$processId]); 
			} 
		} 
		else{ 
			//Forked child, do your deeds.... 
			$exitStatus = 0; //Error code if you need to or whatever 
			$this->_log("Doing ($jobID) something fun in pid ".getmypid()); 
			
		} 
		return true; 
	} 
   
	public function childSignalHandler($signo, $processId=null, $status=null)
	{    
		//If no pid is provided, that means we're getting the signal from the system.  Let's figure out 
		//which child process ended 
		if(!$processId) { 
			$processId = pcntl_waitpid(-1, $status, WNOHANG); 
		} 
	   
		//Make sure we get all of the exited children 
		while($processId > 0) {
			if($processId && isset($this->_emailProcessIdMap[$processId])){ 
				$exitCode = pcntl_wexitstatus($status);

				$emailId = $this->_emailProcessIdMap[$processId];
				$email = $this->_emailIdsBeingSent[$emailId];

				if($exitCode != 0){ 
					$this->_log("Email #{$email->id} Sent to {$email->to_email}!"); 
				} 

				$email->time_sent = Zend_Date::now()->get('c');
				$result = GTW_Model_Email_Mapper::getInstance()->save($email);

				$this->_unLockEmail($email);

			} else if($processId) { 
				$this->_log("Process ran withou mapping?!?"); 
				//$this->_signalQueue[$processId] = $status; 
			} 
			$processId = pcntl_waitpid(-1, $status, WNOHANG); 
		} 
		return true; 
	} 

	protected function _log($message) 
	{
		echo "Emailer: $message \n";
	}
}