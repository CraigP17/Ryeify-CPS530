<?php


namespace app\core;


abstract class DBModel extends Model
{
    abstract public function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

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

    public function findOneUser($where)
    {
        $tableName = static::tableName();

        $statement = self::prepare("SELECT * FROM $tableName WHERE email = :email");
        $statement->bindValue(":email", $where['email']);
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

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
