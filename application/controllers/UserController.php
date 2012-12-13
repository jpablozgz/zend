<?php

class UserController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
        $users = new Application_Model_DbTable_Users();
        $this->view->users = $users->fetchAll();
	}
 	
 	function addAction()
 	{
 	    $model = new Application_Model_User();
 		$form = new Application_Form_User();
 	    $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
	        $newname = $model->renameImage($form->getValue('photo'));
//	        Zend_Debug::dump($newname);die;
	        
	        // Hay que deshabilitar la subida automatica de la foto
	        // pues si se llama igual que una que ya habia la sobreescribiria
	        // Tenemos que utilizar el nuevo nombre e inyectarlo en el formulario
	        $form->photo->setFilename($newname);
        
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $name = $form->getValue('name');
                $email = $form->getValue('email');
                $password = $form->getValue('password');
                $description = $form->getValue('description');
                
                if(!$form->photo->receive())
                    die("Error cargando la imagen");
                $photo = $form->getValue('photo');

                $coders = $form->getValue('coders');
                $cities_idcity = $form->getValue('cities_idcity');

                $users = new Application_Model_DbTable_Users();
                $users->addUser($name, $email, $password, $description,
                        		$photo, $coders, $cities_idcity/*, $roles_idrole*/);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    function editAction()
    {
 	    $model = new Application_Model_User();
        $form = new Application_Form_User();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        $newname = $model->renameImage($form->getValue('photo'));
        Zend_Debug::dump($newname);
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $iduser = (int)$form->getValue('iduser');
                $name = $form->getValue('name');
                $email = $form->getValue('email');
                $password = $form->getValue('password');
                $description = $form->getValue('description');
                $photo = $form->getValue('photo');
                $coders = $form->getValue('coders');
//                $cities_idcity = $form->getValue('cities_idcity');
//                $roles_idrole = $form->getValue('roles_idrole');
                $users = new Application_Model_DbTable_Users();
                $users->updateUser($iduser, $name, $email, $password, $description,
                        		$photo, $coders/*, $cities_idcity, $roles_idrole*/);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $iduser = $this->_getParam('iduser', 0);
            if ($iduser > 0) {
                $users = new Application_Model_DbTable_Users();
                $form->populate($users->getUser($iduser));
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') { 
                $iduser = $this->getRequest()->getPost('iduser');
                $users = new Application_Model_DbTable_Users();
                $users->deleteUser($iduser);
            }
            $this->_helper->redirector('index');
        } else {
            $iduser = $this->_getParam('iduser', 0);
            $users = new Application_Model_DbTable_Users();
            $this->view->user = $users->getUser($iduser);
        } 
    }
}
