<?php

class MR_TrainingAdmin_Block_Adminhtml_Customcontact_Grid extends Mage_Adminhtml_Block_Widget_Grid {

    public function __construct() {
        parent::__construct();
        $this->setId("customcontactGrid");
        $this->setDefaultSort("enquiry_id");
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }
    
    

    protected function _prepareCollection() {
        $collection = Mage::getModel("myform/enquiry")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns() {
        $this->addColumn("enquiry_id", array(
            "header" => Mage::helper("trainingadmin")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "enquiry_id",
        ));

        $this->addColumn("title", array(
            "header" => Mage::helper("trainingadmin")->__("Title"),
            "index" => "title",
        ));
        
        $this->addColumn("content", array(
            "header" => Mage::helper("trainingadmin")->__("Feedback"),
            "index" => "content",
        ));
        
        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row) {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }

    protected function _prepareMassaction() {
        $this->setMassactionIdField('enquiry_id');
        $this->getMassactionBlock()->setFormFieldName('enquiry_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        
        $this->getMassactionBlock()->addItem('remove_customcontact', array(
            'label' => Mage::helper('trainingadmin')->__('Remove '),
            'url' => $this->getUrl('*/adminhtml_customcontact/massRemove'),
            'confirm' => Mage::helper('trainingadmin')->__('Are you sure?')
        ));
        
        return $this;
    }

}
