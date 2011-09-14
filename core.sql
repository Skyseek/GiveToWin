START TRANSACTION;
USE `gtw`;

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
# 		Email Templates
# ***************************

INSERT INTO `email_template` (`id`, `name`, `description`, `subject`, `text_body`, `html_body`, `from_email`, `from_alias`) VALUES
	(1, 'User New Email Confirmation', 'Email sent after a new user subscribes to a newsletter', '', '', NULL, NULL, NULL),
	(2, 'User New Subscription', 'User New Subscription', NULL, NULL, NULL, NULL, NULL);


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

COMMIT;