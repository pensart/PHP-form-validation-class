<?php

/**-------------------------------------------|
Created: 19/09/2016
Author: Guy Pensart
URL: http://guypensart.be
|-------------------------------------------**/

/**
 * Class split all inputs to objects
 */
class splitToObject
{
    /**
     * splitToObject constructor.
     * @param $value
     */
    function __construct($value)
    {
        $this->value = $value;
        $this->error = '';
        $this->valid = FALSE;
    }
}


class FormValidatorClass
{
    public
    $value,
    $error,
    $valid;

    /**
     * FormValdatorClass constructor.
     * @param $post
     */
    function __construct($post)
    {
        foreach ($post as $key => $value):
            $this->input[$key] = new splitToObject(trim($value));
        endforeach;
    }
}