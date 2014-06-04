<?php
class LogicSpot_BannerManager_Model_Banner extends Mage_Core_Model_Abstract
{
    protected function _construct()
	{
       $this->_init("bannermanager/banner");
    }
	public function getImage()
	{
        return  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $this->_getData('image');
	}
}