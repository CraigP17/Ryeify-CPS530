<?php


namespace app\core;


abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    public $errors = [];

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

    abstract public function rules();

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
                    $className = $rule['class'];
                    $uniqueAttribute = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = \Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttribute = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
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

    private function addError($attribute, $rule, $params = [])
    {
        $message = isset($this->errorMessages()[$rule]) ? $this->errorMessages()[$rule] : '';
        foreach ($params as $key => $value)
        {
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    public function addPubError($attribute, $message)
    {
        $this->errors[$attribute][] = $message;
    }

    private function errorMessages()
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

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? '';
    }
}
