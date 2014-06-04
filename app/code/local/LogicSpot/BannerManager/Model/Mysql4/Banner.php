<?php
class LogicSpot_BannerManager_Model_Mysql4_Banner extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("bannermanager/banner", "banner_id");
    }
}