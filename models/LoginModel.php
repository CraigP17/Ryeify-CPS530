<?php


namespace app\models;


use app\core\Model;

class LoginModel extends Model
{
    public $email = '';
    public $password = '';

    public function rules()
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function login()
    {
        $user = RegisterModel::findOneUser(['email' => $this->email]);
        if (!$user)
        {
            $this->addPubError('email', 'User does not exist with this email');
            return false;
        }
        if (!password_verify($this->password, $user->password))
        {
            $this->addPubError('password', 'Incorrect Password!');
            return false;
        }

        return \Application::$app->login($user);
    }
}
