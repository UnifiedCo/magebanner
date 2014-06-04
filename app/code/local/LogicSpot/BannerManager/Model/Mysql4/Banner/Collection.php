<?php
class LogicSpot_BannerManager_Model_Mysql4_Banner_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	public function _construct()
	{
		$this->_init("bannermanager/banner");
	}
	public function setRandomOrder()
	{
		$this->getSelect()->order(new Zend_Db_Expr('RAND()'));
		return $this;
	}
}