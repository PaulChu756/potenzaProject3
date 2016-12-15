<?php

class API_Model_Visits
{
    protected $_id;
    protected $_p_id;
    protected $_s_id;
    protected $_date_visited;

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
            throw new Exception('Invalid set visits proptery');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;

        if(('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid get visits proptery');
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

    public function setP_Id($p_id)
    {
        $this->_p_id = (int) $p_id;
        return $this;
    }
    public function getP_Id()
    {
        return $this->_p_id;
    }

    public function setS_Id($s_id)
    {
        $this->_s_id = (int) $s_id;
        return $this;
    }
    public function getS_Id()
    {
        return $this->_s_id;
    }

    public function setDate_Visited($date_visited)
    {
        $this->_date_visited = (string) $date_visited;
        return $this;
    }
    public function getDate_Visited()
    {
        return $this->_date_visited;
    }
}
