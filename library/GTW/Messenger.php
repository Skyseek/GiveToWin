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
  * Flash Messenger
  *
  * Responsible for storing messages from the lower level model/services. To be displayed on view. 
  * or in a user visual response.
  *
  * @package    Givetowin
  * @copyright  Copyright (c) 2011, Give to Win, Inc
  * @author     Sean Thayne <sean@skyseek.com
  */
class GTW_Messenger
{
	protected $_messages = array();
	
	protected static $_instance;
	
	public static function getInstance() 
	{
		if(!self::$_instance)
			self::$_instance = new GTW_Messenger();
			
		return self::$_instance;
	}
	
	public function addMessage($subject, $body=NULL, $type='message') 
	{
		$message = new GTW_Messenger_Message();
		$message->subject 	= $subject;
		$message->body 		= $body;
		$message->type 		= $type;
		
		$this->_messages[] 	= $message;
		
		return $message;
	}
	
	public function getMessages($type='all')
	{
		return $this->_messages;
	}
}
