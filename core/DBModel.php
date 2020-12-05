<?php


namespace app\core;


abstract class DBModel extends Model
{
    // DBModel login class that extends Model class
    // Performs login of user by checking if user email exists in database

    /**
     * Abstract of table name to query into in DB
     * @return string
     */
    abstract public function tableName(): string;

    /**
     * Abstract of which attributes to query from DB
     * @return array
     */
    abstract public function attributes(): array;

    /**
     * Abstract of what the primary key in the DB is
     * @return string
     */
    abstract public function primaryKey(): string;

    /**
     * Used in user registration to Insert user data into the DB
     * @return bool
     */
    public function save()
    {
        $tablename = $this->tableName();
        $attributes = $this->attributes();

//        \Application::$app->db->pdo->prepare();
        $statement = $this->prepare("INSERT INTO $tablename (". implode(',', $attributes) . ")
                                        VALUES(:". implode(',:', $attributes) ." )");

//        var_dump($statement, $attributes);

        foreach ($attributes as $attribute)
        {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();
        return true;
    }

    /**
     * Returns one user from DB by querying by the given email entered
     *
     * @param $where
     * @return mixed
     */
    public function findOneUser($where)
    {
        $tableName = static::tableName();

        $statement = self::prepare("SELECT * FROM $tableName WHERE email = :email");
        $statement->bindValue(":email", $where['email']);
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    /**
     * Returns one user from DB by querying by their primary key 'id' in DB
     *
     * @param $key
     * @return mixed
     */
    public function findUserByKey($key)
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE id = :id");
        $statement->bindValue(":id", $key['id']);
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return \Application::$app->db->pdo->prepare($sql);
    }
}
