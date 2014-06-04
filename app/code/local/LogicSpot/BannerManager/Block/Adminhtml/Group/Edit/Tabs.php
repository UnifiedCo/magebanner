<?php
class LogicSpot_BannerManager_Block_Adminhtml_Group_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
	public function __construct()
	{
		parent::__construct();
		$this->setId("group_tabs");
		$this->setDestElementId("edit_form");
		$this->setTitle(Mage::helper("bannermanager")->__("Group Information"));
	}
	protected function _beforeToHtml()
	{
		$this->addTab("form_section", array(
		"label" => Mage::helper("bannermanager")->__("Group Information"),
		"title" => Mage::helper("bannermanager")->__("Group Information"),
		"content" => $this->getLayout()->createBlock("bannermanager/adminhtml_group_edit_tab_form")->toHtml(),
		));
		return parent::_beforeToHtml();
	}
}
