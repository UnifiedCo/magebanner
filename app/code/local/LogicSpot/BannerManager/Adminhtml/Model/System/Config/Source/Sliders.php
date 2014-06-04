<?php
class LogicSpot_BannerManager_Adminhtml_Model_System_Config_Source_Sliders
{
    public function toOptionArray()
    {
		return Mage::helper('bannermanager/sliders')->toOptionArray();
    }
}
