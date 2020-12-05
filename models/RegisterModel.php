<?php


namespace app\models;


use app\core\DBModel;

class RegisterModel extends DBModel
{
    // RegisterModel that extends Model class in core
    // Used for user registration to the app

    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * Returns table name corresponding to registration within the DB
     * Fulfils abstract method defined in Model->tableName()
     *
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    /**
     * Returns the DB column names that correspond to user registration
     * Fulfils abstract method defined in Model->attributes()
     *
     * @return string[]
     */
    public function attributes(): array
    {
        return ['fname', 'lname', 'email', 'password'];
    }

    /**
     * Registers the user to the DB and returns whether registration was successful
     * Hashes/Encrypts password and then uses Model->save()
     *
     * @return bool
     */
    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

    /**
     * Returns the rules to check for each input
     * Form contains 5 inputs. email: check it was entered (Required), email format (Email) and is unique (UNIQUE)
     * Fulfils abstract method defined in Model->rules()
     *
     * @return array[]|mixed
     */
    public function rules()
    {
        return [
            'fname' => [self::RULE_REQUIRED],
            'lname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'matchVal' => 'password']],
        ];
    }

    /**
     * Returns the primary key of the DB users (id)
     *
     * @return string
     */
    public function primaryKey(): string
    {
        return 'id';
    }

    /**
     * Returns the user's username which is their first name + last name
     * Used in navbar php file to echo a user's name when they are signed in
     *
     * @return string
     */
    public function userName()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
