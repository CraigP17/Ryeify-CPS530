<?php


class migration0001_users
{
    public function up()
    {
        // Creating the Migration
        echo "Applying migration".PHP_EOL;

        $db = Application::$app->db;
        $SQL = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                fname VARCHAR(255) NOT NULL,
                lname VARCHAR(255) NOT NULL,
                password VARCHAR(512) NOT NULL,
                status TINYINT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }
}
