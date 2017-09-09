<?php
/**
 * Created by PhpStorm.
 * User: ustil
 * Date: 10.09.2017
 * Time: 0:02
 */
//application/controllers/GuestbookController.php
class GuestbookController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $guestbook = new Application_Model_Guestbook();
        $this->view->entries = $guestbook->fetchAll();
    }
    // snipping indexAction()...
    public function signAction()
    {
        $request = $this->getRequest();
        $form    = new Application_Form_Guestbook();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $model = new Application_Model_Guestbook($form->getValues());
                $model->save();
                return $this->_helper->redirector('index');
            }
        }
        $this->view->form = $form;
    }
}