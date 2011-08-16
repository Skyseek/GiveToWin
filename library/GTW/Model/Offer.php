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
 * Offer Model
 *
 * @package    Givetowin
 * @copyright  Copyright (c) 2011, Give to Win, Inc
 * @author     Sean Thayne <sean@skyseek.com
 */
class GTW_Model_Offer {
    public $id;
	private $_company;
	public $status;
	public $title;
	public $sub_title;
	public $description;
	public $fine_print;
	public $highlights;
	public $value;
	public $time_redeem;
	public $time_expire;

	public function setCompany(GTW_Model_Company $company) {
		$this->_company = $company;
	}

	public function getCompany() {
		return $this->_company;
	}

}
