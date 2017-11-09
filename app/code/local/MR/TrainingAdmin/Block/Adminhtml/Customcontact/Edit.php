<?php

class MR_TrainingAdmin_Block_Adminhtml_Customcontact_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {

    public function __construct() {

        parent::__construct();
        $this->_objectId = "contact_id";
        $this->_blockGroup = "trainingadmin";
        $this->_controller = "adminhtml_customcontact";
        $this->_updateButton("save", "label", Mage::helper("trainingadmin")->__("Save Item"));
        $this->_updateButton("delete", "label", Mage::helper("trainingadmin")->__("Delete Item"));

        $this->_addButton("saveandcontinue", array(
            "label" => Mage::helper("trainingadmin")->__("Save And Continue Edit"),
            "onclick" => "saveAndContinueEdit()",
            "class" => "save",
                ), -100);

        $this->_formScripts[] = "function saveAndContinueEdit(){
		editForm.submit($('edit_form').action+'back/edit/');
		}
	";
    }

    public function getHeaderText() {
        if (Mage::registry("customcontact_data") && Mage::registry("customcontact_data")->getId()) {
            return Mage::helper("trainingadmin")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("customcontact_data")->getTitle()));
        } else {
            return Mage::helper("trainingadmin")->__("Add Item");
        }
    }

}
