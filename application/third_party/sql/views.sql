/*

-- -----------------------------------------------------------------------------

-- Create the User_Details View

CREATE OR REPLACE VIEW `User_Details` AS 
SELECT  `User`.user_id, 
        `User`.`name`, 
        `User`.email, 
        `User`.action_code, 
        `Status`.status_id, 
        `Status`.`name` as `status`, 
        `Status`.`order` as `status_order`, 
        `Access_Level`.access_level_id, 
        `Access_Level`.`name` as `access_level`, 
        `Access_Level`.`order` as `access_level_order`
  FROM `User` 
  JOIN `Status` ON `User`.`status` = `Status`.status_id 
  JOIN `Access_Level` ON `User`.`access_level` = `Access_Level`.access_level_id;

-- Test the User_Details View

SELECT * FROM User_Details;


-- -----------------------------------------------------------------------------

-- Create the Data_Info View

CREATE OR REPLACE VIEW `Data_Info` AS
SELECT width, height, url, avg_pages, avg_duration, CONCAT(width,'x',height) AS device,
    IF(width>height,CONCAT(width,'x',height),CONCAT(height,'x',width)) AS global_device, 
    IF(width<height,1,0) AS is_portrait, 
    sessions, 
    site, period 
FROM Data_Point
JOIN Data_Period ON Data_Point.period = Data_Period.period_id;

-- Test the Data_Info View

SELECT * FROM Data_Info;


-- -----------------------------------------------------------------------------

-- Update the aggregate_sessions_by_period Procedure

DROP PROCEDURE IF EXISTS `aggregate_sessions_by_site`;
DELIMITER //
CREATE PROCEDURE `aggregate_sessions_by_site`
(IN site_id INT(11))
BEGIN
    DECLARE total_sessions INT DEFAULT 0;
 
    SELECT SUM(sessions) INTO total_sessions FROM Data_Info WHERE site = site_id ;

    SELECT di.site, di.period, di.device, 
        SUM(di.sessions) as sessions, 
        total_sessions as `total_sessions` 
        FROM Data_Info as di WHERE di.site = site_id GROUP BY di.device;
END //
DELIMITER ;

-- Test the aggregate_sessions_by_site Procedure

CALL aggregate_sessions_by_site(2);



-- -----------------------------------------------------------------------------

-- Update the aggregate_sessions_by_period Procedure

DROP PROCEDURE IF EXISTS `aggregate_sessions_by_period`;
DELIMITER //
CREATE PROCEDURE `aggregate_sessions_by_period`
(IN period_id INT(11))
BEGIN
    DECLARE total_sessions INT DEFAULT 0;
 
    SELECT SUM(sessions) INTO total_sessions FROM Data_Info WHERE period = period_id ;

    SELECT di.site, di.period, di.device, 
        SUM(di.sessions) as sessions, 
        total_sessions as `total_sessions` 
        FROM Data_Info as di WHERE di.period = period_id GROUP BY di.device;
END //
DELIMITER ;

-- Test the aggregate_sessions_by_period Procedure

CALL aggregate_sessions_by_period(2);


-- -----------------------------------------------------------------------------

-- Update the total_session_for_site Procedure

DROP PROCEDURE IF EXISTS `total_session_for_site`;

DELIMITER //
CREATE PROCEDURE `total_session_for_site`
(IN site_id INT(11))
BEGIN
    SELECT SUM(sessions) FROM Data_Info WHERE site = site_id;
END //
DELIMITER ;

-- Test the total_session_for_site Procedure

CALL total_session_for_site(2);


-- -----------------------------------------------------------------------------

-- Update the total_session_for_period Procedure 

DROP PROCEDURE IF EXISTS `total_session_for_period`;

DELIMITER //
CREATE PROCEDURE `total_session_for_period`
(IN period_id INT(11))
BEGIN
    SELECT SUM(sessions) FROM Data_Info WHERE period = period_id;
END //
DELIMITER ;

-- Test the total_session_for_period Procedure 

CALL total_session_for_period(3);


*/