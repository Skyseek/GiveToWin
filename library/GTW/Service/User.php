<?php
/**
 * Givetowin.org License, Version 1.0
 *
 * You may not modify or use this file except with written permission
 * from Give to Win, Inc.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND Give to Win HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 */


/**
 * User Service Layer
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Service_User extends GTW_Service_Map
{

	// ====================================================================
	//
	// 	Singleton Implementation
	//
	// ====================================================================
	
	protected static $_instance;

	/**
	 * @return GTW_Service_User
	 */
	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}


	// ====================================================================
	//
	// 	Public Methods
	//
	// ====================================================================
	

	/**
	 * Finds/Creates Subscriber with given email address.
	 *
	 * @param $email Email of Subscriber.
	 * @param $createIfNonExistant Create new user, if none found.
	 *
	 * @return GTW_Model_User
	 */
	public function getSubscriberByEmail($email, $createIfNonExistant=true) 
	{
		$user = $this->getUserByEmail($email);	
		
		if(!$user && $createIfNonExistant)
			$user = $this->createSubscriber($email);

		return $user;
	}
	
	
	/**
	 * Creates a new Subscription User.
	 * 
	 * Returns the new User on success. NULL on Failure.
	 * 
	 * @param $email Email address for new subscriber.
	 * 
	 * @return GTW_Model_User
	 */
	public function createSubscriber($email) 
	{
		$emailValidator = new Zend_Validate_EmailAddress();
		if(!$emailValidator->isValid($email))
			return;
			
		$user = new GTW_Model_User(array(
			'email'		=> $email,
			'role_id'	=> GTW_Model_User_Role::SUBSCRIBER,
			'status_id'	=> GTW_Model_User_Status::PENDING
		));

		if($this->getCityService()->hasCitySelected())
			$user->city	= $this->getCityService()->getCitySelection();

		$this->getUserMapper()->save($user);
		
		return $user;
	}
	
	/**
	 * Returns the User Entity with given Email.
	 *
	 * @param $email Email Address to search for.
	 * 
	 * @return GTW_Model_User User (if exists)
	 */
	public function getUserByEmail($email) 
	{
		$request = new Skyseek_Model_Entity_Collection_Request(1, 1);
		$request->addFilter('email', '=', $email);

		return $this->getUserMapper()->getUserCollection($request)->current();
	}

	/**
	 * Returns the User Entity with given id.
	 *
	 * @param $id user_id to search for
	 * 
	 * @return GTW_Model_User User (if exists)
	 */
	public function getUserById($id) 
	{
		return $this->getUserMapper()->getUser($id);
	}
	
	public function login($email, $password)
	{
		$user = new GTW_Model_User(array(
			'email'		=> $email,
			'password'	=> $password
		));
		
		$authAdapter = new GTW_Auth_Adapter_Standard($user);
		$authUtility = GTW_Auth::getInstance();
		
		$result = $authUtility->authenticate($authAdapter);
		
		if (!$result->isValid()) {
			$message = GTW_Messenger::getInstance()->addMessage('Login Failed', null, 'login-error');
			
			switch($result->getCode()) {
				case Zend_Auth_Result::FAILURE_IDENTITY_NOT_FOUND:
					$message->body = "Authenticaton Failure - User Not Found!";
					break;
					
				case Zend_Auth_Result::FAILURE_IDENTITY_AMBIGUOUS:
					$message->body = "Authenticaton Failure - User is Ambiguous!";
					break;
					
				case Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID:
					$message->body = "Authenticaton Failure - Wrong Password!";
					break; 
					
				default:
					$message->body = "Authenticaton Failure";
			}
			
			return false;
		}
		
		$user = $authAdapter->getResultRowObject();
		$this->startSession($user);

		return true;
	}

	public function startSession(GTW_Model_User $user)
	{
		GTW_Auth::getInstance()->getStorage()->write($user->id);

		if($this->getCityService()->hasCitySelected())
			$this->getCityService()->setCitySelection($user->city);
	}

	public function stopSession()
	{
		GTW_Auth::getInstance()->clearIdentity();
	}
	
	public function isLoggedIn() 
	{
		return GTW_Auth::getInstance()->hasIdentity();
	}
	
	/**
	 *
	 * @return GTW_Model_User
	 */
	public function getCurrentUser() 
	{
		$user = null;

		if($this->isLoggedIn())	{
			$userId = GTW_Auth::getInstance()->getIdentity();
			$user	= $this->getUserMapper()->getUser($userId);

			if(!$user) {
				$this->stopSession();
			}
		} 

		if(!$user instanceof GTW_Model_User) {
			//Use Guest User instead.
			$user = new GTW_Model_User();
			$user->referenceId('role_id', GTW_Model_User_Role::GUEST);
		}

		return $user;
	}
	
		
	public function getForm(GTW_Model_User $user) 
	{
		$form = new GTW_Model_User_Form();
		$form->setUser($user);

		return $form;
	}

	/**
	 * Saves a User Values
	 *
	 * @param $users GTW_Model_User User Entity to save
	 * 
	 * @return GTW_Model_User Returns the same entity passed in.
	 */
	public function save(GTW_Model_User $user) 
	{
		return $this->getUserMapper()->save($user);
	}

	public function delete(GTW_Model_User $user) 
	{
		return $this->getUserMapper()->delete($user);
	}

	public function register(GTW_Model_User $user)
	{
		$existingUser = $this->getUserByEmail($user->email);

		if($existingUser) {
			if($existingUser->role->id == GTW_Model_User_Role::SUBSCRIBER) {
				$existingUser->first_name	= $user->first_name;
				$existingUser->last_name	= $user->last_name;

				$user = $existingUser;
			} else {
				$urlEmail = urlencode($existingUser->email);

				$messageBody  = "Email is already Registered. ";
				$messageBody .= "<a href='/User/Forgot-Password/email/{$urlEmail}'>Click here to get recover your password.</a>";
				GTW_Messenger::getInstance()->addMessage('Registration Failed', $messageBody, 'register-error');
				return false;
			}
		} else {

			if($this->getCityService()->hasCitySelected()) {
				$user->city = $this->getCityService()->getCitySelection();
			}
		}
		
		$user->status = $user->statusMapper()->getStatus(GTW_Model_User_Status::PENDING);
		$user->role = $user->roleMapper()->getRole(GTW_Model_User_Role::MEMBER);
		$user->setNewPassword($user->password);

		$this->getUserMapper()->save($user);
		$this->sendRegistrationEmail($user);

		return $user;
	}


	public function sendRegistrationEmail(GTW_Model_User $user)
	{
		if($user->status->id == GTW_Model_User_Status::PENDING)
			$emailTemplate	= $this->getEmailService()->getTemplateByName('user_registration');

		// Assign Template Vars
		$emailTemplate->assign('user', $user);

		// Queue Rendered Email
		$this->getEmailService()->queueEmail($emailTemplate->render($user));
	}
}
