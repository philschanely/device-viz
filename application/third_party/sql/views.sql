CREATE OR REPLACE VIEW `user_details` AS 
SELECT  `User`.user_id, 
        `User`.`name`, 
        `User`.email, 
        `Status`.status_id, 
        `Status`.`name` as `status`, 
        `Status`.`order` as `status_order`, 
        `Access_Level`.access_level_id, 
        `Access_Level`.`name` as `access_level`, 
        `Access_Level`.`order` as `access_level_order`
  FROM `User` 
  JOIN `Status` ON `User`.`status` = `Status`.status_id 
  JOIN `Access_Level` ON `User`.`access_level` = `Access_Level`.access_level_id;

SELECT * FROM user_details;