<?php

class API_Model_People
{
    protected $_id;
    protected $_firstName;
    protected $_lastName;
    protected $_favoriteFood;

/*
    public function construct(array $options = null)
    {
        if(is_array($options))
        {
            $this->setOptions($options);
        }
    }
*/

    public function _set($name, $value)
    {
        $method = 'set' . $name;
        if(('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid people proptery');
        }
        $this->$method($value);
    }

    public function _get($name)
    {
        $method = 'get' . $name;
        
        if(('mapper' == $name) || !method_exists($this, $method))
        {
            throw new Exception('Invalid people proptery');
        }
        $this->$method();
    }

/*
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
*/

    public function setId($id)
    {
        $this->_id = (int) $id;
        return $this;
    }
    public function getId()
    {
        return $this->_id;
    }

    public function setFirstName($firstName)
    {
        $this->_firstName = (string) $firstName;
        return $this;
    }
    public function getFirstName()
    {
        return $this->_firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = (string) $lastName;
        return $this;
    }
    public function getLastName()
    {
        return $this->_lastName;
    }

    public function setFavoriteFood($favoriteFood)
    {
        $this->_favoriteFood = (string) $favoriteFood;
        return $this;
    }
    public function getFavoriteFood()
    {
        return $this->_favoriteFood;
    }
}

?>