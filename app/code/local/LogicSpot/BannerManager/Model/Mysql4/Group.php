<?php
class LogicSpot_BannerManager_Model_Mysql4_Group extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("bannermanager/group", "group_id");
    }
}