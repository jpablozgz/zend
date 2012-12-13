<?php
class Application_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setName('user');
        
        $iduser = new Zend_Form_Element_Hidden('iduser');
        $iduser->addFilter('Int');
        
        $name = new Zend_Form_Element_Text('name');
        $name->setLabel('Name')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('E-mail')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty')
              ->addValidator('EmailAddress');
        
        $password = new Zend_Form_Element_Text('password');
        $password->setLabel('Password')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');

        $description = new Zend_Form_Element_Textarea('description');
        $description->setLabel('Description')
              ->setRequired(false)
              ->addFilter('StripTags')
              ->addFilter('StringTrim');

        $pets = new Zend_Form_Element_Multiselect('pets');
        $pets->setLabel('Pets')
               ->setRequired(true)
               ->setMultiOptions(array(1=>'Cat', 2=>'Dog', 3=>'Tiger'))
               ->addValidator('NotEmpty');

        $city = new Zend_Form_Element_Select('cities_idcity');
        $city->setLabel('City')
               ->setRequired(true)
               ->setMultiOptions(array(1=>'zgz', 2=>'bcn', 3=>'mad'))
               ->addValidator('NotEmpty');

        $coders = new Zend_Form_Element_Radio('coders');
        $coders->setLabel('Coders')
               ->setRequired(true)
               ->setMultiOptions(array(1=>'php', 2=>'java'))
               ->addValidator('NotEmpty');
        
        $languages = new Zend_Form_Element_MultiCheckbox('languages');
        $languages->setLabel('Languages')
               ->setRequired(true)
               ->setMultiOptions(array(1=>'English', 2=>'Spanish', 3=>'Dutch'))
               ->addValidator('NotEmpty');

        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Photo')
               ->addValidator('NotEmpty')
               ->setDestination(APPLICATION_PATH.'/../public/uploads');
/*            ->addValidator('Count', false, 1)
              ->addValidator('Extension', false, 'jpg,png,gif')
              ->setRequired(true);
*/
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($iduser, $name, $email, $password, $description,
                                 $pets, $city, $coders, $languages, $photo, $submit));
    }
}