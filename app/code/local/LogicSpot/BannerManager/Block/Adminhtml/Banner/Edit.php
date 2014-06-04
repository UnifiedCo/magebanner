<?php
	
class LogicSpot_BannerManager_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = "banner_id";
		$this->_blockGroup = "bannermanager";
		$this->_controller = "adminhtml_banner";
		$this->_updateButton("save", "label", Mage::helper("bannermanager")->__("Save Banner"));
		$this->_updateButton("delete", "label", Mage::helper("bannermanager")->__("Delete Banner"));

		$this->_addButton("saveandcontinue", array(
			"label"     => Mage::helper("bannermanager")->__("Save And Continue Edit"),
			"onclick"   => "saveAndContinueEdit()",
			"class"     => "save",
		), -100);

		$this->_formScripts[] = "function saveAndContinueEdit(){ editForm.submit($('edit_form').action+'back/edit/');}";
	}

	public function getHeaderText()
	{
		if( Mage::registry("banner_data") && Mage::registry("banner_data")->getId() )
		{
			return Mage::helper("bannermanager")->__("Edit Banner '%s'", $this->htmlEscape(Mage::registry("banner_data")->getId()));
		}else{
			return Mage::helper("bannermanager")->__("Add Banner");
		}
	}
}