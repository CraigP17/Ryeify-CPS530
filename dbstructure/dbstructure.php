<?php

// Create the Users Table
$SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                fname VARCHAR(55) NOT NULL,
                lname VARCHAR(55) NOT NULL,
                password VARCHAR(512) NOT NULL,
                status TINYINT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";

$updateUser = "ALTER TABLE users 
                    DROP COLUMN status, 
                    ADD spotify_connected tinyint DEFAULT 0 AFTER password ,
                    ADD spotify_refresh_token varchar(255) NOT NULL DEFAULT ''
                    ;";
