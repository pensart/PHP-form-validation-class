<?php

/**
 * Created: 19/09/2016
 * @author Guy Pensart
 * @link http://guypensart.be my personal site
*/

// todo: check min and max characters
// todo: check if string only has letters
// todo: check if email looks valid
// todo: convert email to lowercase
// todo: sanitize email
// todo: filter the given email
// todo: Check text-area and remove special characters

/**
 * Class helper to split all inputs into objects
 */
class splitToObject
{
    /**
     * splitToObject constructor.
     * @param array
     */
    function __construct($value)
    {
        $this->value = $value;
        $this->error = '';
        $this->valid = FALSE;
    }
}

/**
 * Class FormValidatorClass
 */
class FormValidatorClass
{
    public
    $value,
    $error,
    $valid,
    $nextRule = TRUE,
    $errorsFree = TRUE,
    $input,
    $currentInput;

    /**
     * FormValidatorClass constructor.
     * @param array $post
     */
    function __construct($post)
    {
        foreach ($post as $key => $value):
            $this->input[$key] = new splitToObject(trim($value));
        endforeach;
    }

    /**
     * Output the value of...
     * @param string $name
     * @return string value
     */
    function getValue($name)
    {
        if (isset($this->input[$name]))
            return $this->input[$name]->value;
        return '';
    }

    /**
     * Switch to validate object
     * @return $this
     */
    function setValid()
    {
        if ($this->nextRule)
            $this->currentInput->valid = TRUE;
        return $this;
    }

    /**
     * Output true if the input is validated
     * @param string $name
     * @return bool valid
     */
    function getValid($name)
    {
        if (isset($this->input[$name]))
            return $this->input[$name]->valid;
        return '';
    }

    /**
     * swap errorsFree and nextRule bool
     * @param $error
     * @return $this
     */
    function setError($error)
    {
        $this->currentInput->error = $error;
        $this->errorsFree = FALSE;
        $this->nextRule = FALSE;
        return $this;
    }

    /**
     * Output the error
     * @param $name
     * @return string
     */
    function getError($name)
    {
        if (isset($this->input[$name]))
            return $this->input[$name]->error;
        return '';
    }

    /**
     * set which error message to use
     * @param $errorMsg
     * @param $default
     * @param null $params
     */
    private function setErrorMsg($errorMsg, $default, $params=NULL)
    {
        $defaultString = $default;
        $this->errorsFree = FALSE;
        ($errorMsg == '')
            ? $this->currentInput->error = sprintf($defaultString, $params)
            : $this->currentInput->error = $errorMsg;
    }

    /**
     * Check if there are no errors
     * @return bool
     */
    function errorsFree()
    {
        return $this->errorsFree;
    }

    /**
     * Clear all inputs
     */
    function clearFields()
    {
        if ($this->errorsFree())
            foreach($this->input as $key=>$value):
                $this->input[$key]->value = '';
            endforeach;
    }

    /**
     * Temporary debugging info function
     * @return string $debug
     */
    function debug()
    {
        $debug = '';
        foreach($this->input as $key=>$value):
            $debug .= '<span class="debug-';
            $debug .= ($this->getValid($key)) ? 'passed' : 'error';
            $debug .= '">';
            $debug .= $key;
            $debug .= '</span>';
        endforeach;
        $debug .= '<span class="debug-';
        $debug .= ($this->errorsFree()) ? 'passed' : 'error';
        $debug .= '">';
        $debug .= 'Completed';
        $debug .= '</span>';
        return $debug;
    }

    //-----------------------------------------------------------
    // Validation rules, always start validating with input($name)
    //-----------------------------------------------------------

    /**
     * Set currentInput before other validations
     * @param string $name
     * @return $this
     */
    function item($name)
    {
        if (!isset($this->input[$name]))
            $this->input[$name] = new splitToObject('');
        $this->nextRule = TRUE;
        $this->currentInput = $this->input[$name];
        return $this;
    }

    /**
     * Mark field as required
     * @param null $errorMsg
     * @return $this
     */
    function required($errorMsg=NULL)
    {
        if ($this->nextRule)
        {
            $this->nextRule = ( $this->currentInput->value != '') ? TRUE : FALSE;
            if (!$this->nextRule)
                $this->setErrorMsg($errorMsg, 'This field is required');
        }
        return $this;
    }
}