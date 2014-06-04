<?php
class LogicSpot_BannerManager_Adminhtml_Model_System_Config_Source_Banners
{
    public function toOptionArray()
    {
		return Mage::helper('bannermanager/banners')->toOptionArray();
    }
}
