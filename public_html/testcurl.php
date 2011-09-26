<?php


class Job_Seeker_API 
{
	protected $_endPoint = 'http://jobseekers.direct.gov.uk';	
	protected $_sessionId;
	protected $_pId;
	
	/**
	 * @param $jobTitle String Job title, job ref or SOC code
	 * @param $location String Postcode or location
	 *
	 * @return String Page Content
	 */
	public function searchJobs($jobTitle, $location) 
	{
		$postVars  = $this->getFormVariables();
		$postVars += array(
			'txtSubject'						=> $jobTitle,
			'txtLocation'						=> $location,
			'ddlDistance'						=> 4,
			'btnSearch'						=> 'Search',
			'ddlHours'						=> 70,
			'ddlType'						=> 0,
			'ddlAge'						=> 0,
			'hiddenInputToUpdateATBuffer_CommonToolkitScripts' 	=> 0
		);
		
		$postData = http_build_query($postVars);
			
		$ch = curl_init(); 
		curl_setopt ($ch, CURLOPT_URL, $this->getEndpointURL('/homepage.aspx'));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, "cookies.txt"); 
		curl_setopt ($ch, CURLOPT_REFERER, "http://jobseekers.direct.gov.uk"); 
		curl_setopt ($ch, CURLOPT_POSTFIELDS, $postData); 
		curl_setopt ($ch, CURLOPT_POST, 1);
		
		$response = curl_exec ($ch);
		
		return $response;
	}
	
	public function getFormVariables() 
	{
		$ch = curl_init(); 
		curl_setopt ($ch, CURLOPT_URL, $this->getEndpointURL('/homepage.aspx'));
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt ($ch, CURLOPT_COOKIEJAR, "cookies.txt"); 
		curl_setopt ($ch, CURLOPT_REFERER, "http://jobseekers.direct.gov.uk"); 
		
		$response = curl_exec ($ch); 
		$matches = array();
		preg_match_all('<input type="hidden" name="(.*)" value="(.*)">', $response, $matches);
		
		return array(
			'tsmGlobal_HiddenField' => $matches[2][0],
			'__VIEWSTATE' => $matches[2][1]
		);		
	}
	
	
	/**
	 * Returns Endpoint URL to be used with API functions.
	 * 
	 * @param $relativePath Relative Path to be called.
	 *
	 * @return String Valid Absolute Endpoint URL.
	 */
	public function getEndpointURL($relativePath) 
	{
		return $this->_endPoint . $relativePath .
			'?sessionid=' . $this->getSessionId()  .
			'&pid=' . $this->getPId();
	}
	
	/**
	 * Returns the Session ID
	 *
	 * @return String Session ID
	 */
	public function getSessionId() 
	{
		if(!$this->_sessionId)
			$this->fetchSessionDetails();
	
		return $this->_sessionId;
	}
	
	/**
	 * Return Process ID
	 * 
	 * @return Process ID
	 */
	public function getPId() 
	{
		if(!$this->_pId)
			$this->fetchSessionDetails();
	
		return $this->_pId;
	}
	
	/**
	 * Sets Session details from server.
	 */
	protected function fetchSessionDetails() {
		$ch = curl_init(); 
		curl_setopt ($ch, CURLOPT_URL, $this->_endPoint);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
		curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/9.0.597.107 Safari/534.13"); 
		curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 0); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		$response = curl_exec ($ch);
		
		$matches = array();
		preg_match('/href="%2fhomepage.aspx%3fsessionid%3d(.+)%26pid%3d(.+)"/', $response, $matches);
		
		$this->_sessionId = $matches[1];
		$this->_pId = $matches[2];
	}
}

$api = new Job_Seeker_API();
echo $api->searchJobs('decorative painter', 'London');


