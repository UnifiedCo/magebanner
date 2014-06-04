<?php
class LogicSpot_BannerManager_Block_Adminhtml_Banner extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = "adminhtml_banner";
		$this->_blockGroup = "bannermanager";
		$this->_headerText = Mage::helper("bannermanager")->__("Banner Manager");
		$this->_addButtonLabel = Mage::helper("bannermanager")->__("Add New Banner");
		parent::__construct();	
	}
}