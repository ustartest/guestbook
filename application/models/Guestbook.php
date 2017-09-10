<?php
/**
 * Created by PhpStorm.
 * User: ustil
 * Date: 09.09.2017
 * Time: 23:55
 */
//application/models/Guestbook.php
class Application_Model_Guestbook
{
    protected $_comment;
    protected $_created;
    protected $_email;
    protected $_username;
    protected $_userip;
    protected $_id;
    protected $_mapper;
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Неправильное свойство');
        }
        $this->$method($value);
    }
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Неправильное свойство');
        }
        return $this->$method();
    }
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    public function setUserIp($text)
    {
        $this->_userip = (string) $text;
        return $this;
    }
    public function getUserIp()
    {
        return $this->_userip;
    }
    public function setComment($text)
    {
        $this->_comment = (string) $text;
        return $this;
    }
    public function getComment()
    {
        return $this->_comment;
    }
    public function setEmail($email)
    {
        $this->_email = (string) $email;
        return $this;
    }
    public function getEmail()
    {
        return $this->_email;
    }
    public function setUsername($username)
    {
        $this->_username = (string) $username;
        return $this;
    }
    public function getUsername()
    {
        return $this->_username;
    }
    public function setCreated($ts)
    {
        $this->_created = $ts;
        return $this;
    }
    public function getCreated()
    {
        return $this->_created;
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
    public function setMapper($mapper)
    {
        $this->_mapper = $mapper;
        return $this;
    }
    public function getMapper()
    {
        if (null === $this->_mapper) {
            $this->setMapper(new Application_Model_GuestbookMapper());
        }
        return $this->_mapper;
    }
    public function save()
    {
        $this->getMapper()->save($this);
    }
    public function find($id)
    {
        $this->getMapper()->find($id, $this);
        return $this;
    }
    public function fetchAll()
    {
        return $this->getMapper()->fetchAll();
    }
}