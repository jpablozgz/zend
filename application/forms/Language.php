<?php
class Application_Form_Language extends Zend_Form
{
    public function init()
    {
        $this->setName('language');
        
        $idlanguage = new Zend_Form_Element_Hidden('idlanguage');
        $idlanguage->addFilter('Int');
        
        $language = new Zend_Form_Element_Text('language');
        $language->setLabel('Language')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($idlanguage, $language, $submit));
    }
}