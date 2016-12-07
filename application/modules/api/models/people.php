<?php

class Application_Modules_API_Models_People
{
    protected $id;
    protected $firstName;
    protected $lastName;
    protected $favoriteFood;

    public function _set($name, $value);
    public function _get($name);

    public function setId($id);
    public function getId();

    public function setFirstName($firstName);
    public function getFirstName();

    public function setLastName($lastName);
    public function getLastName();

    public function setFavoriteFood($favoriteFood);
    public function getFavoriteFood();
}

class Application_Modules_API_Models_PeopleMapper
{
    public function save (Application_Modules_API_Models_People $people);
    public function find ($id);
    public function fetchAll();
}

?>