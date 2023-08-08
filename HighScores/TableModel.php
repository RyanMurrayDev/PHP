<?php
/**
 * Created by PhpStorm.
 * User: gibsond
 * Date: 3/19/2019
 * Time: 11:45 AM
 */

class TableModel implements JsonSerializable
{
    protected $fields;

    public function __construct($array)
    {
        $this->fields = $array;
    }

    public function __get($key)
    {
        return $this->fields[$key];
    }

    public function __set($key, $value)
    {
        if( isset($this->fields[$key]) )
        {
            $this->fields[$key] = $value;
        }

    }


    public function jsonSerialize()
    {
        return $this->fields;
    }

}