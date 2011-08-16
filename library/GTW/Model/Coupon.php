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
 * Coupon Model
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc 
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Coupon extends Skyseek_Model_Entity {
    public $id;

	private $_status;
	private $_offer;
	private $_user;

	/**
	 * Set Coupon Offer
	 *
	 * @param GTW_Model_Offer $offer 
	 */
	public function setOffer(GTW_Model_Offer $offer) {
		$this->_offer = $offer;
	}

	/**
	 * Get Coupon Offer
	 *
	 * @return GTW_Model_Offer
	 */
	public function getOffer() {
		return $this->_offer;
	}


	/**
	 * Set Coupon Status
	 *
	 * @param GTW_Model_Coupon_Status $status
	 */
	public function setStatus(GTW_Model_Status $status) {
		$this->_status = $status;
	}

	/**
	 * Get Coupon Status
	 *
	 * @return GTW_Model_Coupon_Status
	 */
	public function getStatus() {
		return $this->_status;
	}


	/**
	 * Set Coupon User
	 *
	 * @param GTW_Model_User $user
	 */
	public function setUser(GTW_Model_User $user) {
		$this->_user = $user;
	}

	/**
	 * Get Coupon User
	 *
	 * @return GTW_Model_User
	 */
	public function getUser() {
		return $this->_user;
	}

	
}
