<?php

class MR_TrainingAdmin_Block_Adminhtml_Customcontact extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {
        $this->_controller = "adminhtml_customcontact";
        $this->_blockGroup = "trainingadmin";
        $this->_headerText = Mage::helper("trainingadmin")->__("Enquiry Manager");
        $this->_addButtonLabel = Mage::helper("trainingadmin")->__("Add New");
        parent::__construct();
    }

}