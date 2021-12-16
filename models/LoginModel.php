<?php


namespace app\models;


use app\core\Model;
use Application;

class LoginModel extends Model
{
    // LoginModel that extends Model class in core
    // Used for user login to the app

    public $email = '';
    public $password = '';

    /**
     * Returns the rules to check for each input
     * Form contains 2 inputs: email and password. Email, check that it was entered (Required) and email format (Email)
     * Fulfils abstract method defined in Model->rules()
     *
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    /**
     * Returns whether login is successful where:
     *      email exists
     *      password matches and is correct
     *
     * @return bool
     */
    public function login(): bool
    {
        // Find if there is a user existing with entered email
        $user = (new RegisterModel)->findOneUser(['email' => $this->email]);

        if (!$user)
        {
            $this->addPubError('email', 'User does not exist with this email');
            return false;
        }

        // Verify whether password matches the found user's password
        if (!password_verify($this->password, $user->password))
        {
            $this->addPubError('password', 'Incorrect Password!');
            return false;
        }

        return Application::$app->login($user);
    }
}
