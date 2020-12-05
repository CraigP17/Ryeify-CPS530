<?php

// Create the Users Table
$SQL = "
        CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                fname VARCHAR(55) NOT NULL,
                lname VARCHAR(55) NOT NULL,
                password VARCHAR(512) NOT NULL,
                spotify_connected TINYINT DEFAULT 0,
                spotify_refresh_token varchar(255) NOT NULL DEFAULT '',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;
        ";

