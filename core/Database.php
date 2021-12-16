<?php


namespace app\core;


use PDO;

class Database
{
    // Instantiates PDO connection to the database, used by Application so $app has access connection to DB available
    // Contains main methods used through web platform, especially to return Spotify client tokens for a given user

    public $pdo;    // PDO instance

    /**
     * Database constructor.
     * Connected to the database using the given input
     *
     * @param $config
     */
    public function __construct()
    {
        $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server   = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db       = substr($cleardb_url["path"],1);

        $this->pdo = new PDO("mysql:host=".$cleardb_server.";dbname=".$cleardb_db, $cleardb_username, $cleardb_password);
        // Throws an exception when error occurs
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Prepares a $sql query for PDO
     * HELPER to simplify code
     *
     * @param $sql
     * @return bool|\PDOStatement
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * Connects spotify account to ryeify user account by saving their spotify refresh token in DB for future usage
     * Sets spotify_connected in DB to true for given user
     *
     * @param $token
     * @param $id
     * @return bool|\PDOStatement
     */
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

    /**
     * Returns SQL select of whether user $id account is connected to spotify
     *
     * @param $id
     * @return mixed
     */
    public function getSpotifyConnection($id)
    {
        $statement = self::prepare("SELECT spotify_connected FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * Returns the spotify refresh token associated with given user account $id
     *
     * @param $id
     * @return mixed
     */
    public function getSpotifyRefreshToken($id)
    {
        $statement = self::prepare("SELECT spotify_refresh_token FROM users WHERE id = :id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * Updates the refresh token saved in the DB for the user $id with the $r_token
     *
     * @param $id
     * @param $r_token
     * @return mixed
     */
    public function updateSpotifyRefreshToken($id, $r_token)
    {
        $statement = self::prepare("UPDATE users SET spotify_refresh_token = :r_token WHERE id = :id");
        $statement->bindValue(":r_token", $r_token);
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch();
    }

}
