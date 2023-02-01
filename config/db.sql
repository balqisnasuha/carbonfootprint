CREATE TABLE `users` (
    `user_id` int(11) NOT NULL AUTO_INCREMENT,
    `user_name` varchar(80) NOT NULL,
    `user_email` varchar(255) NOT NULL,
    `user_ic_no` varchar(12) NOT NULL,
    `user_phone` varchar(20) NOT NULL,
    `user_password` varchar(255) NOT NULL,
    `user_role` enum('admin', 'user') NOT NULL DEFAULT 'user',
    `user_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `user_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `user_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`user_id`),
    UNIQUE KEY `user_email` (`user_email`),
    UNIQUE KEY `user_ic_no` (`user_ic_no`)
);

CREATE TABLE `electric_device`(
    `device_id` int(11) NOT NULL AUTO_INCREMENT,
    `device_name` varchar(255) NOT NULL,
    `device_watt` int(11) NOT NULL,
    `device_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `device_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `device_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `device_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`device_id`)
);

INSERT INTO
    `electric_device` (`device_name`, `device_watt`)
VALUES
    ('LED TV', 150),
    ('Fridge', 220),
    ('Washer', 500),
    ('Dryer', 4000),
    ('Aircond', 2500),
    ('Fan', 70),
    ('Light', 100);

CREATE TABLE `electric_usage`(
    `usage_id` int(11) NOT NULL AUTO_INCREMENT,
    `usage_device_id` int(11) NOT NULL,
    `usage_user_id` int(11) NOT NULL,
    `usage_duration` int(11) NOT NULL,
    `usage_power` float (10, 2) NOT NULL,
    `usage_watt` float (10, 2) NOT NULL,
    `usage_date` date NOT NULL,
    `usage_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `usage_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `usage_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `usage_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`usage_id`),
    FOREIGN KEY (`usage_device_id`) REFERENCES `electric_device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`usage_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `user_reward`(
    `reward_id` int(11) NOT NULL AUTO_INCREMENT,
    `reward_user_id` int(11) NOT NULL,
    `reward_point` int(11) NOT NULL,
    `reward_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `reward_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `reward_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `reward_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`reward_id`),
    FOREIGN KEY (`reward_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `reward`(
    `reward_id` int(11) NOT NULL AUTO_INCREMENT,
    `reward_name` varchar(255) NOT NULL,
    `reward_point` int(11) NOT NULL,
    `reward_start_date` datetime NOT NULL,
    `reward_end_date` datetime NOT NULL,
    `reward_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `reward_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `reward_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `reward_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`reward_id`)
);

CREATE TABLE `reward_redeem`(
    `redeem_id` int(11) NOT NULL AUTO_INCREMENT,
    `redeem_reward_id` int(11) NOT NULL,
    `redeem_user_id` int(11) NOT NULL,
    `redeem_point` int(11) NOT NULL,
    `redeem_status` enum('0', '1', '2', '3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
    `redeem_comment` text NULL,
    `redeem_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `redeem_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `redeem_deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`redeem_id`),
    FOREIGN KEY (`redeem_reward_id`) REFERENCES `reward` (`reward_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`redeem_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
);