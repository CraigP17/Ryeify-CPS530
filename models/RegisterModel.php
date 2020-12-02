<?php


namespace app\models;


use app\core\DBModel;

class RegisterModel extends DBModel
{
    public $fname;
    public $lname;
    public $email;
    public $password;
    public $confirmPassword;

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return ['fname', 'lname', 'email', 'password'];
    }

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return $this->save();
    }

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

    public function primaryKey(): string
    {
        return 'id';
    }

    public function userName()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
