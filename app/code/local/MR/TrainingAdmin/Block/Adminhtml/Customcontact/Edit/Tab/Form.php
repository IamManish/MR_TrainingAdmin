<?php

class MR_TrainingAdmin_Block_Adminhtml_Customcontact_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("trainingadmin_form", array("legend" => Mage::helper("trainingadmin")->__("Item information")));


        $fieldset->addField("title", "text", array(
            "label" => Mage::helper("trainingadmin")->__("Title"),
            "name" => "title",
        ));

        $fieldset->addField("content", "textarea", array(
            "label" => Mage::helper("trainingadmin")->__("Comment"),
            "name" => "content",
        ));


        if (Mage::getSingleton("adminhtml/session")->getCustomcontactData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getCustomcontactData());
            Mage::getSingleton("adminhtml/session")->setCustomcontactData(null);
        } elseif (Mage::registry("customcontact_data")) {
            $form->setValues(Mage::registry("customcontact_data")->getData());
        }
        return parent::_prepareForm();
    }

}
