<?php

class MR_TrainingAdmin_Adminhtml_CustomcontactController extends Mage_Adminhtml_Controller_Action {

    protected function _isAllowed() {
        return Mage::getSingleton('admin/session')->isAllowed('trainingadmin/enquiry');
        //return true;
    }

    protected function _initAction() {
        $this->loadLayout()->_setActiveMenu("trainingadmin/enquiry")->_addBreadcrumb(Mage::helper("adminhtml")->__("Enquiry  Manager"), Mage::helper("adminhtml")->__("Enquiry Manager"));
        return $this;
    }

    public function indexAction() {
        $this->_title($this->__("TrainingAdmin"));
        $this->_title($this->__("Manager Enquiry"));
        
        $this->_initAction();
        $this->renderLayout();
    }

    public function editAction() {
        $this->_title($this->__("Training Admin"));
        $this->_title($this->__("Equiry"));
        $this->_title($this->__("Edit Item"));

        $id = $this->getRequest()->getParam("id");
        
        $model = Mage::getModel("myform/enquiry")->load($id);
        if ($model->getId()) {
            Mage::register("customcontact_data", $model);
            $this->loadLayout();
            $this->_setActiveMenu("trainingadmin/customcontact");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customcontact Manager"), Mage::helper("adminhtml")->__("Customcontact Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customcontact Description"), Mage::helper("adminhtml")->__("Customcontact Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("trainingadmin/adminhtml_customcontact_edit"))->_addLeft($this->getLayout()->createBlock("trainingadmin/adminhtml_customcontact_edit_tabs"));
            $this->renderLayout();
        } else {
            Mage::getSingleton("adminhtml/session")->addError(Mage::helper("trainingadmin")->__("Item does not exist."));
            $this->_redirect("*/*/");
        }
    }

    public function newAction() {

        $this->_title($this->__("TrainingAdmin"));
        $this->_title($this->__("Customcontact"));
        $this->_title($this->__("New Item"));

        $id = $this->getRequest()->getParam("id");
        $model = Mage::getModel("trainingadmin/customcontact")->load($id);

        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register("customcontact_data", $model);

        $this->loadLayout();
        $this->_setActiveMenu("trainingadmin/customcontact");

        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customcontact Manager"), Mage::helper("adminhtml")->__("Customcontact Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Customcontact Description"), Mage::helper("adminhtml")->__("Customcontact Description"));


        $this->_addContent($this->getLayout()->createBlock("trainingadmin/adminhtml_customcontact_edit"))->_addLeft($this->getLayout()->createBlock("trainingadmin/adminhtml_customcontact_edit_tabs"));

        $this->renderLayout();
    }

    public function saveAction() {

        $post_data = $this->getRequest()->getPost();
        //var_dump($post_data);die;
        if ($post_data) {
            try {
                $model = Mage::getModel("myform/enquiry")
                        ->addData($post_data)
                        ->setId($this->getRequest()->getParam("id"))
                        ->save();

                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Your record was successfully saved"));
                Mage::getSingleton("adminhtml/session")->setCustomcontactData(false);

                if ($this->getRequest()->getParam("back")) {
                    $this->_redirect("*/*/edit", array("id" => $model->getId()));
                    return;
                }
                $this->_redirect("*/*/");
                return;
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setCustomcontactData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;
            }
        }
        $this->_redirect("*/*/");
    }

    public function deleteAction() {
        if ($this->getRequest()->getParam("id") > 0) {
            try {
                $model = Mage::getModel("trainingadmin/customcontact");
                $model->setId($this->getRequest()->getParam("id"))->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
                $this->_redirect("*/*/");
            } catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        $this->_redirect("*/*/");
    }

    public function massRemoveAction() {
        try {
           
            $ids = $this->getRequest()->getPost('enquiry_ids', array());
            
            foreach ($ids as $id) {
                $model = Mage::getModel("myform/enquiry");
                $model->setId($id)->delete();
            }
            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
        } catch (Exception $e) {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }

    /**
     * Export order grid to CSV format
     */
    public function exportCsvAction() {
        $fileName = 'customcontact.csv';
        $grid = $this->getLayout()->createBlock('trainingadmin/adminhtml_customcontact_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction() {
        $fileName = 'customcontact.xml';
        $grid = $this->getLayout()->createBlock('trainingadmin/adminhtml_customcontact_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

}
