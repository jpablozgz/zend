<?php
class Application_Form_Pet extends Zend_Form
{
    public function init()
    {
        $this->setName('pet');
        
        $idpet = new Zend_Form_Element_Hidden('idpet');
        $idpet->addFilter('Int');
        
        $pet = new Zend_Form_Element_Text('pet');
        $pet->setLabel('Pet')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($idpet, $pet, $submit));
    }
}