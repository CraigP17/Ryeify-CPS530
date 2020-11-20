<?php


namespace app\core;


use Application;
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

    public function applyMigrations()
    {
        $this->createMigrationTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        $newMigrations = [];

        foreach ($toApplyMigrations as $migration)
        {
            if ($migration === '.' || $migration === '..')
            {
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            // var_dump($className);

            $instance = new $className();

            echo "Applying migration $migration".PHP_EOL;
            $instance->up();
            echo "Applied migrations $migration".PHP_EOL;

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations))
        {
            $this->saveMigrations($newMigrations);
        }
        else
        {
            echo "All migrations applied";
        }
    }

    private function createMigrationTable()
    {
        $this->pdo->exec("");
    }

    private function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    private function saveMigrations($migrations)
    {
        $migs = [];
        foreach ($migrations as $key => $value)
        {
            $migs[] = "('" . $value . "')";
        }
        $str_migs = implode(',', $migs);

        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $str_migs");

        $statement->execute();
    }
}
