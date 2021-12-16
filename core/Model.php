<?php


namespace app\core;


abstract class Model
{
    // Model Class used for User registration
    // Checks whether user input in registration is validated and matches defined rule (valid email, min number of char)

    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public $errors = [];

    /**
     * Loads data input sent by user form, and assigns to model used for specific
     *
     * @param $data
     */
    public function loadData($data)
    {
        // Taking data and assigning it to properties of the model
        foreach ($data as $key => $value) {
            if (property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * Abstract function that each child Model must instantiate
     * Specific which rules must be followed by the user's input from the form
     * Model specifies which input contain which rules to be checked by $this->validate()
     *
     * @return mixed
     */
    abstract public function rules();

    /**
     * Called when form is passed to validate the input sent by user
     * Validates that each input follows the specific rule such as proper email, minimum number of characters
     * Returns whether validation is successful
     *
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach ($rules as $rule)
            {
                $ruleName = $rule;
                if (!is_string($ruleName))
                {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value)
                {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min'])
                {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max'])
                {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['matchVal']})
                {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE)
                {
                    // Checks whether input is unique, and does not already exist in the database (email)
                    $className = $rule['class'];                            // Rule for given class
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;    // Which attribute to check is unique
                    $tableName = $className::tableName();                   // Table name in DB of attribute from $class

                    // Execute DB call to select same attribute input
                    $sql = "SELECT * FROM $tableName WHERE $uniqueAttribute = :attr";
                    $statement = \Application::$app->db->prepare($sql);
                    $statement->bindValue(":attr", $value);
                    $statement->execute();

                    // If record in DB exists, the input is not unique
                    $record = $statement->fetchObject();
                    if ($record)
                    {
                        $this->addError($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * Called when a user input from form, does not pass the validate rule
     * Adds the error associated with the rule to return which inputs failed
     *
     * @param $attribute
     * @param $rule
     * @param array $params
     */
    private function addError($attribute, $rule, array $params = [])
    {
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value)
        {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * Adds error message of $attributes to user, when their input did not pass a given rule
     *
     * @param $attribute
     * @param $message
     */
    public function addPubError($attribute, $message)
    {
        $this->errors[$attribute][] = $message;
    }

    /**
     * List of error messages associated with breaking a rule
     *
     * @return string[]
     */
    private function errorMessages(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_EMAIL => 'This field must be a valid email address.',
            self::RULE_MIN => 'Minimum {min} characters.',
            self::RULE_MAX => 'Maximum {max} characters.',
            self::RULE_MATCH => 'This field must be the same as {matchVal}.',
            self::RULE_UNIQUE => 'Record with this {field} already exists.',
        ];
    }

    /**
     * Returns whether the input data has an error (did not pass a rule)
     *
     * @param $attribute
     * @return false|mixed
     */
    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    /**
     * Returns the first error message from user's input error messages
     * so user can only be given one error for each input
     *
     * @param $attribute
     * @return mixed|string
     */
    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }
}
