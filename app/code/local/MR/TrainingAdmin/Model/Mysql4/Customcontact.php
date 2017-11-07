<?php
class MR_TrainingAdmin_Model_Mysql4_Customcontact extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("trainingadmin/customcontact", "contact_id");
    }
}