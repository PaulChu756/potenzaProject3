<?php

class API_Model_States
{
    protected $_id;
    protected $_stateAbb;
    protected $_stateName;

    public function __construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if(('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid set states proptery');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;
        
        if(('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid get states proptery');
        }
        return $this->$method();
    }

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach($options as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if(in_array($method, $methods))
            {
                $this->$method($value);
            }
        }
        return $this;
    }

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setStateAbb($stateAbb)
    {
        $this->_stateAbb = (string) $stateAbb;
        return $this;
    }
    public function getStateAbb()
    {
        return $this->_stateAbb;
    }

    public function setStateName($stateName)
    {
        $this->_stateName = (string) $stateName;
        return $this;
    }
    public function getStateName()
    {
        return $this->_stateName;
    }
}


