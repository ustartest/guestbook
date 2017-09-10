<?php
/**
 * Created by PhpStorm.
 * User: ustil
 * Date: 10.09.2017
 * Time: 0:28
 */
//application/forms/Guestbook.php
class Application_Form_Guestbook extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');

        // Add the username
        $this->addElement('text', 'username', array(
            'label'      => 'Имя пользователя:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 16))
            )
        ));

        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'Почтовый ящик:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array('EmailAddress',)
        ));

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label'      => 'Введите 5 цифр, которвые вы видите снизу:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));

        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label'      => 'Комментарий:',
            'required'   => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 180))
            )
        ));

        // Add the comment
        $this->addElement('submit', 'add', array(
            'ignore'   => true,
            'label'    => 'Sign Guestbook',
        ));
        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}