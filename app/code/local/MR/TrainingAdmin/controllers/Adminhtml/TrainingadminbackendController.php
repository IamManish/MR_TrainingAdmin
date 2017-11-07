<?php
class MR_TrainingAdmin_Adminhtml_TrainingadminbackendController extends Mage_Adminhtml_Controller_Action
{

	protected function _isAllowed()
	{
		//return Mage::getSingleton('admin/session')->isAllowed('trainingadmin/trainingadminbackend');
		return true;
	}

	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Adminhtml Training Page"));
	   $this->renderLayout();
    }
}