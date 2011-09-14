START TRANSACTION;
USE `gtw`;


TRUNCATE `offer_schedule`;
TRUNCATE `offer`;
TRUNCATE `fundraiser_schedule`;
TRUNCATE `fundraiser`;
TRUNCATE `user`;
TRUNCATE `city`;
TRUNCATE `charity`;
TRUNCATE `company`;


# ***************************
# 		City Data
# ***************************

INSERT INTO  `gtw`.`city` (`id` ,`state_id` ,`status_id` ,`city`) VALUES 
	(1 ,  '13',  '2',  'Athens'),
	(2 ,  '13',  '1',  'Atlanta');


# ***************************
# 		User Data
# ***************************
INSERT INTO `gtw`.`user` (`id`, `role_id`, `status_id`, `city_id`, `email`, `password`, `first_name`, `last_name`, `gender`, `token`) VALUES 
	(1, 4, 2, 1, 'sean@skyseek.com', MD5('blackdog'), 'Sean', 'Thayne', 'Male', NULL),
	(2, 4, 2, 1, 'maxwell.ruppersburg@gmail.com', MD5('temp123'), 'Maxwell', 'Ruppersburg', 'Male', NULL),
	(3, 4, 2, 1, 'john.doe@test.com', MD5('temp123'), 'John', 'Doe', 'Male', NULL),
	(4, 4, 2, 1, 'sally.doe@test.com', MD5('temp123'), 'Sally', 'Doe', 'Female', NULL);



# ***************************
# 		Charity Data
# ***************************

INSERT INTO  `gtw`.`charity` (`id`,`status_id` ,`name`, `website`, `phone`, `mission`, `work`, `email`) VALUES 
	(1 ,  '2',  'YMCA of the USA', 'http://www.ymca.net', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(2 ,  '1',  'Catholic Charities USA', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(3 ,  '4',  'United Way', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(4 ,  '3',  'Goodwill Industries International', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(5 ,  '2',  'American Red Cross', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(6 ,  '2',  'The Salvation Army', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(7 ,  '2',  'Memorial Sloan-Kettering Cancer Center', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(8 ,  '2',  'Boys & Girls Clubs of America', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(9 ,  '1',  'Habitat for Humanity Internation', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(10 , '3',  'Easter Seals', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com'),
	(11 , '5',  'World Vision', 'http://www.google.com', '5551231234', 'our mission', 'our work', 'test@google.com');

INSERT INTO `fundraiser` (`id`, `charity_id`, `status_id`, `cost`, `goal`, `title`, `description`) VALUES
	(1, 1, 1, 20, 2000, 'Save the Music', 'Save the Music'),
	(2, 2, 1, 20, 2000, 'Food Drive', 'Food Drive Description'),
	(3, 3, 1, 20, 2000, 'Save the Children', 'Save the Children'),
	(4, 3, 1, 20, 2000, 'Save the Children #2', 'Save the Children #2');

INSERT INTO `fundraiser_schedule` (`id`, `city_id`, `fundraiser_id`, `status_id`, `start_date`, `end_date`) VALUES
	(1, 1, 2, 2, '2011-09-04', '2011-09-15'),
	(2, 2, 2, 1, '2011-09-07', '2011-09-11');


# ***************************
# 		Company Data
# ***************************

INSERT INTO `company` (`id`, `status_id`, `name`, `website`, `email`, `phone`) VALUES
	(1, 1, 'Skyseek', 'http://www.skyseek.com', 'sean@skyseek.com', '8016543007'),
	(2, 1, 'Fearyoucanhear', 'http://www.fearyoucanhear.com', 'troy@fearyoucanhear.com', '8016543007'),
	(3, 1, 'Goodmonkeys', 'http://www.goodmonkeys.com', 'troy@fearyoucanhear.com', '8016543007'),
	(4, 1, 'Sears', 'http://www.sears.com', 'troy@fearyoucanhear.com', '8016543007'),
	(5, 1, 'Wal-Mart', 'http://www.walmart.com', 'troy@fearyoucanhear.com', '8016543007'),
	(6, 1, 'Home Depot', 'http://www.walmart.com', 'troy@fearyoucanhear.com', '8016543007'),
	(7, 1, '7-11', 'http://www.7-eleven.com', 'troy@fearyoucanhear.com', '8016543007');

INSERT INTO `offer` (`id`, `company_id`, `status_id`, `value`, `title`, `sub_title`, `description`, `fine_print`, 
					 `highlights`, `time_redeem`, `time_expire`, `minimum`) VALUES 
	(1, '1', '1', '50', 'Free Ice Cream Cone', 'For you!', 'As a way to thank our customers for their support and to celebrate 33 years of scooping the chunkiest, funkiest ice cream, frozen yogurt and sorbet, Ben & Jerry''s chocolate frenzy.', 'An ice cream cone, poke or cornet is a dry, cone-shaped pastry, usually made of a wafer similar in texture to a waffle, allowing ice cream to be eaten without a bowl or spoon. Various types of ice-cream cones include waffle cones, cake cones (or wafer cones), pretzel cones, and sugar cones.', 'Edible cones have been mentioned in French cooking books as early as 1825, Julien Archambault describes a cone where one can roll "little waffles".[1] Another printed reference to an edible cone is in Mrs A. B. Marshall’s Cookery Book, written in 1888 by Agnes B. Marshall (1855–1905) of England. Her recipe for "Cornet with Cream" says that - "the cornets were made with almonds and baked in the oven, not pressed between irons". The influential innovator who published two recipe books and ran a school of cookery.', '2011-09-30 11:46:51', '2011-10-31 11:46:56', '1000');

INSERT INTO `gtw`.`offer_schedule` (`id`, `offer_id`, `city_id`, `status_id`, `start_date`, `end_date`) VALUES 
	(1, 1, 1, 2, '2011-09-01', '2011-09-30');

COMMIT;