<?php
class MR_TrainingAdmin_Block_Adminhtml_Customcontact_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("customcontact_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("trainingadmin")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("trainingadmin")->__("Item Information"),
				"title" => Mage::helper("trainingadmin")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("trainingadmin/adminhtml_customcontact_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
