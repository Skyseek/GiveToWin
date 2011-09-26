START TRANSACTION;
USE `gtw`;

TRUNCATE `offer_schedule`;
TRUNCATE `offer`;
TRUNCATE `fundraiser_schedule`;
TRUNCATE `fundraiser`;
TRUNCATE `city_subscription`;
TRUNCATE `user`;
TRUNCATE `city`;
TRUNCATE `charity`;
TRUNCATE `company`;

TRUNCATE `charity_status`;
TRUNCATE `city_status`;
TRUNCATE `company_status`;
TRUNCATE `coupon_status`;
TRUNCATE `fundraiser_schedule_status`;
TRUNCATE `fundraiser_status`;
TRUNCATE `offer_schedule_status`;
TRUNCATE `offer_status`;
TRUNCATE `user_status`;
TRUNCATE `user_role`;
TRUNCATE `email`;
TRUNCATE `email_template`;
TRUNCATE `state`;



# ***************************
# 		Status Types
# ***************************



INSERT INTO `charity_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Charity has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Charity is now Active.'),
	(3, 'Rejected', 'Charity has been rejected.'),
	(4, 'Suspended', 'Charity has been suspended by GTW staff.'),
	(5, 'Removed', 'Charity has removed it\'s self from GTW');


INSERT INTO `city_status` (`id`, `status`, `description`) VALUES
	(1, 'Planned', 'GTW is currently planning to use this city in the near future.'),
	(2, 'Active', 'This city is currently active.'),
	(3, 'Disabled', 'This city has been discontinued.');


INSERT INTO `company_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Company has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Company is now Active.'),
	(3, 'Rejected', 'Company has been rejected.'),
	(4, 'Suspended', 'Company has been suspended by GTW staff.'),
	(5, 'Removed', 'Company has removed it\'s self from GTW');


INSERT INTO `coupon_status` (`id`, `status`, `description`) VALUES
	(1, 'Pending', 'Coupon is currently Pending. Once GTW received payment notification this coupon will become active.'),
	(2, 'Active', 'Coupon is Active.'),
	(3, 'Used', 'Coupon has been used. It is no longer valid.');


INSERT INTO `fundraiser_schedule_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Fundraiser Schedule has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Fundraiser Schedule is now Active.'),
	(3, 'Rejected', 'Fundraiser Schedule has been rejected.'),
	(4, 'Suspended', 'Fundraiser Schedule has been suspended by GTW staff.');


INSERT INTO `fundraiser_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Fundraiser has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Fundraiser is now Active.'),
	(3, 'Rejected', 'Fundraiser has been rejected.'),
	(4, 'Suspended', 'Fundraiser has been suspended by GTW staff.');

INSERT INTO `offer_schedule_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Offer Schedule has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Offer Schedule is now Active.'),
	(3, 'Rejected', 'Offer Schedule has been rejected.'),
	(4, 'Suspended', 'Offer Schedule has been suspended by GTW staff.');


INSERT INTO `offer_status` (`id`, `status`, `description`) VALUES
	(1, 'Submitted', 'Offer has been submitted. It\'s Now Waiting for GTW staff\'s approval'),
	(2, 'Active', 'Offer is now Active.'),
	(3, 'Rejected', 'Offer has been rejected.'),
	(4, 'Suspended', 'Offer has been suspended by GTW staff.');


INSERT INTO `user_status` (`id`, `status`, `description`) VALUES
	(1, 'Pending', 'User has submitted information, but hasn''t confirmed there email address'),
	(2, 'Active', 'User has subscribed to one or more city newsletters'),
	(3, 'Suspended', 'User has been suspended by GTW staff'),
	(4, 'Cancelled', 'User has cancelled there service.');



# ***************************
# 		Misc Types
# ***************************

INSERT INTO `user_role` (`id`, `role`, `description`) VALUES
	(1, 'Guest', 'New visitor to the site.'),
	(2, 'Subscriber', 'User has subscribed to at least one city''s subscription.'),
	(3, 'Member', 'User has submited details, and now needs to confirm his/her email address.'),
	(4, 'Admin', 'User is an Admin and has full access to the site and the Admin area.');


# ***************************
# 		Core Data
# ***************************

INSERT INTO `state` (`id`, `state`, `abbreviation`) VALUES
	(1, 'Alabama', 'AL'),
	(2, 'Alaska', 'AK'),
	(3, 'American Samoa', 'AS'),
	(4, 'Arizona', 'AZ'),
	(5, 'Arkansas', 'AR'),
	(6, 'California', 'CA'),
	(7, 'Colorado', 'CO'),
	(8, 'Connecticut', 'CT'),
	(9, 'Delaware', 'DE'),
	(10, 'District of Columbia', 'DC'),
	(11, 'Federated States of Micronesia', 'FM'),
	(12, 'Florida', 'FL'),
	(13, 'Georgia', 'GA'),
	(14, 'Guam', 'GU'),
	(15, 'Hawaii', 'HI'),
	(16, 'Idaho', 'ID'),
	(17, 'Illinois', 'IL'),
	(18, 'Indiana', 'IN'),
	(19, 'Iowa', 'IA'),
	(20, 'Kansas', 'KS'),
	(21, 'Kentucky', 'KY'),
	(22, 'Louisiana', 'LA'),
	(23, 'Maine', 'ME'),
	(24, 'Marshall Islands', 'MH'),
	(25, 'Maryland', 'MD'),
	(26, 'Massachusetts', 'MA'),
	(27, 'Michigan', 'MI'),
	(28, 'Minnesota', 'MN'),
	(29, 'Mississippi', 'MS'),
	(30, 'Missouri', 'MO'),
	(31, 'Montana', 'MT'),
	(32, 'Nebraska', 'NE'),
	(33, 'Nevada', 'NV'),
	(34, 'New Hampshire', 'NH'),
	(35, 'New Jersey', 'NJ'),
	(36, 'New Mexico', 'NM'),
	(37, 'New York', 'NY'),
	(38, 'North Carolina', 'NC'),
	(39, 'North Dakota', 'ND'),
	(40, 'Northern Mariana Islands', 'MP'),
	(41, 'Ohio', 'OH'),
	(42, 'Oklahoma', 'OK'),
	(43, 'Oregon', 'OR'),
	(44, 'Palau', 'PW'),
	(45, 'Pennsylvania', 'PA'),
	(46, 'Puerto Rico', 'PR'),
	(47, 'Rhode Island', 'RI'),
	(48, 'South Carolina', 'SC'),
	(49, 'South Dakota', 'SD'),
	(50, 'Tennessee', 'TN'),
	(51, 'Texas', 'TX'),
	(52, 'Utah', 'UT'),
	(53, 'Vermont', 'VT'),
	(54, 'Virgin Islands', 'VI'),
	(55, 'Virginia', 'VA'),
	(56, 'Washington', 'WA'),
	(57, 'West Virginia', 'WV'),
	(58, 'Wisconsin', 'WI'),
	(59, 'Wyoming', 'WY');



# ***************************
# 		Email Templates
# ***************************

INSERT INTO `email_template` (`id`, `name`, `description`, `subject`, `text_body`, `html_body`, `from_email`, `from_alias`) VALUES
(1, 'new_subscription', 'Email sent when a user subscribes to the newsletter but has already confirmed their email account with the system.', 'Welcome to Give to Win', 'Welcome to Give to WinÃ¢â‚¬â„¢s %%city->city%% Newsletter!\r\n\r\nYou have successfully subscribed to receive updates about Give to Win goals in the great city of %%city->city%%.\r\n\r\n{!user - Only displayed if user isnÃ¢â‚¬â„¢t registered}\r\nOur system noticed we donÃ¢â‚¬â„¢t have a username registered to this email address. Please click the link below if you would like to register online to create your Give to Win account. You will need to complete this step in order to be able to donate. You can also login with your Facebook account.\r\n\r\nPlease use the url below to register your account now!\r\n\r\nhttp://www.givetowin.org/User/Register/id/######\r\n\r\n{end !user}\r\n\r\nWe love to hear what you want to see, so let us know!\r\n\r\nSuggest a charity\r\n  -> http://www.givetowin.org/Suggest/Charity\r\n\r\nSuggest a business\r\n       -> http://www.givetowin.org/Suggest/Business\r\n\r\nSuggest a city\r\n  -> http://www.givetowin.org/Suggest/City\r\n\r\nIf you have any questions, please contact us at support@givetowin.org.\r\n\r\nThank you!\r\n\r\nThe Give to Win Team', 'Welcome to Give to Win''s %%city->city%% Newsletter!\r\n\r\nYou have successfully subscribed to receive updates about Give to Win goals in %%city->city%%.  Please click the link below if you would like to register online to create your Give to Win account.  You will need to complete this step in order to be able to donate.\r\n\r\n[Click here to register your account now]\r\n\r\nIf the above link isn''t working, copy and paste the following URL into your browser\r\n->[URL]\r\n\r\n\r\nWe love to hear what you want to see, so let us know!\r\n[Suggest a charity]\r\n[Suggest a business]\r\n[Suggest a city]\r\n\r\nIf you have any questions, please contact us at support@givetowin.org.\r\n\r\n\r\nThank you!\r\n\r\nThe Give to Win Team', 'mruppersburg@givetowin.org', 'goals@givetowin.org'),
(2, 'new_subscription_confirm', 'Email sent to a new user who subscribed to the newsletter and has not already confirmed their email address.', 'Welcome to Give to Win, Please confirm your email! ', 'Welcome to Give to Win''s %%city->city%% newsletter!\r\n\r\nThanks for subscribing to receive updates about Give to Win goals in %%city->city%%.  Before we can send you any updates we need to confirm your email. Please copy and paste the URL below into your browser to get started.\r\n\r\nConfirm your email\r\n        ->[url]\r\n\r\n\r\nWe love to hear what you want to see, so let us know!\r\nSuggest a charity\r\n       -> http://www.givetowin.org/Suggest/Charity\r\n\r\nSuggest a business\r\n       -> http://www.givetowin.org/Suggest/Business\r\n\r\nSuggest a city\r\n  -> http://www.givetowin.org/Suggest/City\r\n\r\nIf you have any questions, please contact us at support@givetowin.org.\r\n\r\n\r\nThank you!\r\n\r\nThe Give to Win Team', 'Welcome to Give to Win''s %%city->city%% newsletter!\r\n\r\nThanks for subscribing to receive updates about Give to Win goals in %%city->city%%.  Before we can send you any updates we need to confirm your email. Please follow the link below or paste the URL into your browser to get started.\r\n\r\n[Click here to confirm your email]\r\n\r\n->[url]\r\n\r\n\r\nWe love to hear what you want to see, so let us know!\r\n[Suggest a charity]\r\n[Suggest a business]\r\n[Suggest a city]\r\n\r\nIf you have any questions, please contact us at support@givetowin.org.\r\n\r\n\r\nThank you!\r\n\r\nThe Give to Win Team', 'mruppersburg@givetowin.org', 'admin@givetowin.org'),
(3, 'user_registration', 'Email sent after user registers', 'Registration successful, Please confirm your email address!', 'Welcome, %%user->first_name%%!\r\n\r\nThank you for registering with Give to Win.  We just need to confirm your email and then you will be ready to go!\r\n\r\nPlease copy and paste the following URL into your internet browser to confirm your account.\r\n->[URL]\r\n\r\n\r\nGive to Win allows you to support your community and enjoy great savings at the same time.  When you donate to a nonprofitÃ¢â‚¬â„¢s goal through Give to Win, a local business rewards you with a discount voucher if the goal is met in time.  \r\n\r\nHow It Works\r\nGet It\r\nReceive updates on fundraising goals and great discounts in your town.\r\nGive It\r\nDonate to a charitable cause near you and great local businesses will offer you a discount if the goal is met.\r\nShare It\r\nSpread the love and tell your friends to join in.  When the goal is reached, your coupon is activated.\r\nWin It\r\nReceive a voucher in your inbox and take it to the business to get your reward.  Enjoy your savings and your karma boost.\r\n\r\nIf you have any questions, please contact us at support@givetowin.org!\r\n\r\nThank you!\r\nThe Give to Win Team', 'Welcome, %%user->first_name%%!\r\n\r\nThank you for registering with Give to Win.  We just need to confirm your email and then you will be ready to go!\r\n\r\n[Click here to confirm your email address]\r\n\r\nIf the above link isn''t working, copy and paste the following URL into your browser.\r\n->[URL]\r\n\r\nGive to Win allows you to support your community and enjoy great savings at the same time.  When you donate to a nonprofitÃ¢â‚¬â„¢s goal through Give to Win, a local business rewards you with a discount if the goal is met in time.  \r\n\r\nHow It Works\r\nGet It\r\nReceive updates on fundraising goals and great discounts in your town.\r\nGive It\r\nDonate to a charitable cause near you and great local businesses will offer you a discount if the goal is met.\r\nShare It\r\nSpread the love and tell your friends to join in.  When the goal is reached, your coupon is activated.\r\nWin It\r\nReceive a voucher in your inbox and take it to the business to get your reward.  Enjoy your savings and your karma boost.\r\n\r\nIf you have any questions, please contact us at support@givetowin.org!\r\n\r\nThank you!\r\nThe Give to Win Team', 'mruppersburg@givetowin.org', 'admin@givetowin.org'),
(4, 'suggest_city', 'Email sent to admins when a user suggests a city.', 'New City Suggested.', 'Hey %%user->first_name%%,\r\n\r\nA user just suggested a new city. Check it out below.\r\n\r\nCity: %%city->city%% \r\nState: %%city->state->state%% \r\n\r\nAdditional Comments:\r\n\r\n%%city->comments%% ', 'Hey %%user->first_name%%,<br />\r\n<br />\r\nA user just suggested a new city. Check it out below.<br />\r\n<br />\r\nCity: %%city->city%% <br />\r\nState: %%city->state->state%% <br />\r\n<br />\r\nAdditional Comments:<br />\r\n<br />\r\n%%city->comments%% ', 'noreply@givetowin.org', 'Give To Win System'),
(5, 'contact_us_staff', 'Email sent to all GTW staff when contact us form is filled out.', 'Contact Us Message Received.', 'Name: %%message->name%%\r\nEmail: %%message->email%%\r\n\r\nMessage:\r\n\r\n%%message->message%%', '<b>Name:</b> %%message->name%%<br />\r\n<b>Email:</b> %%message->email%%<br />\r\n<br />\r\n<b>Message:</b><br />\r\n<br />\r\n%%message->message%%', 'noreply@givetowin.org', 'Give To Win System'),
(6, 'suggest_charity_staff', 'Email sent to all GTW staff when suggest charity form is filled out.', 'Charity Suggestion Received.', 'Suggested by:\r\n\r\nName: %%charity->name%%\r\nEmail: %%charity->email%%\r\n\r\nCharity Information:\r\n\r\nName: %%charity->charityName%%\r\nType: %%charity->charityType%%\r\nURL: %%charity->charityWebsite%%\r\n\r\nComments:\r\n\r\n%%charity->message%%', 'Suggested by:<br />\r\n<br />\r\nName: %%charity->name%%<br />\r\nEmail: %%charity->email%%<br />\r\n<br />\r\nCharity Information:<br />\r\n<br />\r\nName: %%charity->charityName%%<br />\r\nType: %%charity->charityType%%<br />\r\nURL: %%charity->charityWebsite%%<br />\r\n<br />\r\nComments:<br />\r\n<br />\r\n%%charity->message%%', 'noreply@givetowin.org', 'Give To Win System'),
(7, 'suggest_company_staff', 'Email sent to all GTW staff when suggest company form is filled out.', 'Company Suggestion Received.', 'Suggested by:\r\n\r\nName: %%company->name%%\r\nEmail: %%company->email%%\r\n\r\nCompany Information:\r\n\r\nName: %%company->companyName%%\r\nType: %%company->companyType%%\r\nURL: %%company->companyWebsite%%\r\n\r\nComments:\r\n\r\n%%company->message%%', 'Suggested by:<br />\r\n<br />\r\nName: %%company->name%%<br />\r\nEmail: %%company->email%%<br />\r\n<br />\r\nCompany Information:<br />\r\n<br />\r\nName: %%company->companyName%%<br />\r\nType: %%company->companyType%%<br />\r\nURL: %%company->companyWebsite%%<br />\r\n<br />\r\nComments:<br />\r\n<br />\r\n%%company->message%%', 'noreply@givetowin.org', 'Give To Win System');



COMMIT;