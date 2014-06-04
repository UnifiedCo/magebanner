<?php
class LogicSpot_BannerManager_Block_Adminhtml_Group extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_controller = "adminhtml_group";
		$this->_blockGroup = "bannermanager";
		$this->_headerText = Mage::helper("bannermanager")->__("Banner Groups");
		$this->_addButtonLabel = Mage::helper("bannermanager")->__("Add New Group");
		parent::__construct();	
	}
}