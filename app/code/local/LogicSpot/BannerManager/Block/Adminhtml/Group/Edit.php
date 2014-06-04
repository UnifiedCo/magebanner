<?php
	
class LogicSpot_BannerManager_Block_Adminhtml_Group_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	public function __construct()
	{
		parent::__construct();
		$this->_objectId = "group_id";
		$this->_blockGroup = "bannermanager";
		$this->_controller = "adminhtml_group";
		$this->_updateButton("save", "label", Mage::helper("bannermanager")->__("Save Group"));
		$this->_updateButton("delete", "label", Mage::helper("bannermanager")->__("Delete Group"));

		$this->_addButton("saveandcontinue", array(
			"label"     => Mage::helper("bannermanager")->__("Save And Continue Edit"),
			"onclick"   => "saveAndContinueEdit()",
			"class"     => "save",
		), -100);

		$this->_formScripts[] = "function saveAndContinueEdit(){ editForm.submit($('edit_form').action+'back/edit/'); }";
	}

	public function getHeaderText()
	{
		if( Mage::registry("group_data") && Mage::registry("group_data")->getId() ){
			return Mage::helper("bannermanager")->__("Edit Group '%s'", $this->htmlEscape(Mage::registry("group_data")->getId()));
		}else{
			 return Mage::helper("bannermanager")->__("Add Group");
		}
	}
}