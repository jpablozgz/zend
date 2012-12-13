<?php

class LanguageController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		// action body
        $languages = new Application_Model_DbTable_Languages();
        $this->view->languages = $languages->fetchAll();
	}
 	
 	function addAction()
 	{
 		$form = new Application_Form_Language();
 	    $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $language = $form->getValue('language');
                $languages = new Application_Model_DbTable_Languages();
                $languages->addLanguage($language);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    function editAction()
    {
        $form = new Application_Form_Language();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $idlanguage = (int)$form->getValue('idlanguage');
                $language = $form->getValue('language');
                $languages = new Application_Model_DbTable_Languages();
                $languages->updateLanguage($idlanguage, $language);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $idlanguage = $this->_getParam('idlanguage', 0);
            if ($idlanguage > 0) {
                $languages = new Application_Model_DbTable_Languages();
                $form->populate($languages->getLanguage($idlanguage));
            }
        }
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') { 
                $idlanguage = $this->getRequest()->getPost('idlanguage');
                $languages = new Application_Model_DbTable_Languages();
                $languages->deleteLanguage($idlanguage);
            }
            $this->_helper->redirector('index');
        } else {
            $idlanguage = $this->_getParam('idlanguage', 0);
            $languages = new Application_Model_DbTable_Languages();
            $this->view->language = $languages->getLanguage($idlanguage);
        } 
    }
}
