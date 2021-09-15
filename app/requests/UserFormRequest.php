<?php

namespace App\requests;

use App\cores\Rule;

class UserFormRequest
{
    protected $validatedData;
    protected $errorMessages;
    protected static $instance;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function validate($inputs)
    {
        $this->validatedData = [];
        $this->errorMessages = [];

        // iterate through each inputs
        foreach ($inputs as $input => $rules) {
            // if input is empty and nullable is not defined,
            // populate error messages with required field message
            // then continue to the next input
            if (empty($_POST[$input])) {
                if (!in_array('nullable', $rules)) {
                    $this->errorMessages = array_merge($this->errorMessages, [$input => $input . ' field is required']);
                }
                continue;
            }

            // iterate through each rules in input
            foreach ($rules as $rule) {
                // if rule class is found, instantiate rule object with input key and value
                if (class_exists($rule)) {
                    $rule = new $rule($input, $_POST[$input]);
                    // validate input value, if it returns false populate error messages and continue to next input
                    // else populate validated data arrays
                    if (!$rule->check()) {
                        $this->errorMessages = array_merge($this->errorMessages, [$input => $rule->getErrorMsg()]);
                        break;
                    } else {
                        $this->validatedData[$input] = $_POST[$input];
                    }
                }
            }
        }
        return $this;
    }

    public function errors(){
        return $this->errorMessages;
    }

    public function validatedData(){
        return $this->validatedData;
    }
}