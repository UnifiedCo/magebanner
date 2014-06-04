<?php
class LogicSpot_BannerManager_Adminhtml_Model_System_Config_Source_Groups
{
    public function toOptionArray()
    {
		return Mage::helper('bannermanager/groups')->toOptionArray();
    }
}
