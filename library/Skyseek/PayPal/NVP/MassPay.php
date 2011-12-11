<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MassPay
 *
 * @author Sean
 */
class Skyseek_PayPal_NVP_MassPay extends Skyseek_PayPal_NVP_Operation {
    public $environment = 0;

	/**
	 * Indicates how you identify the recipients of payments in this call to MassPay.
	 * Must be EmailAddress or UserID
	 *
	 * @var String
	 */
	public $receiverType = "EmailAddress";

	/**
	 * The subject line of the email that PayPal sends when the transaction is completed.
	 * The subject line is the same for all recipients.
	 * Character length and limitations: 255 single-byte alphanumeric characters.
	 *
	 * @var String
	 */
	public $emailSubject;

	/**
	 * A three-character currency code. See Currency Codes
	 * @link https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_nvp_currency_codes).
	 *
	 * @var String
	 */
	public $currencyCode="USD"; // or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')


	protected $recipients = array();

	public function addRecipient(Skyseek_PayPal_NVP_MassPay_RecipientVO $recipient) {
		$this->recipients[] = $recipient;
	}

	public function send() {
		// Set request-specific fields.
		$emailSubject =urlencode($this->emailSubject);
		$receiverType = urlencode($this->receiverType);
		$currency = urlencode($this->currencyCode);							// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

		// Add request-specific fields to the request string.
		$requestNVP = "&EMAILSUBJECT=$emailSubject&RECEIVERTYPE=$receiverType&CURRENCYCODE=$currency";
		$i = 0;

		foreach($this->recipients as $recipient) {
			$receiverEmail = urlencode($recipient->emailAddress);
			$amount = urlencode($recipient->amount);
			$uniqueID = urlencode($recipient->id);
			$note = urlencode($recipient->note);
			$requestNVP .= "&L_EMAIL$i=$receiverEmail&L_Amt$i=$amount&L_UNIQUEID$i=$uniqueID&L_NOTE$i=$note";
			$i++;
		}

		return $this->call("MassPay", $requestNVP);
	}

}

