<?php


namespace app\core;


use PDO;

class Database
{
    public $pdo;

    public function __construct($config)
    {
        $db_name = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        $this->pdo = new PDO($db_name, $user, $password);

        // Throws an exception when error occurs
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function connectSpotify($token, $id)
    {
        $sql = "UPDATE users
                    SET 
                        spotify_connected = 1,
                        spotify_refresh_token = :token
                    WHERE id = :id
                    ;";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(":token", $token);
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement;
    }

    public function getSpotifyConnection($id)
    {
        $statement = self::prepare("SELECT spotify_connected FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }

}
