<?php
class LogicSpot_BannerManager_Block_Adminhtml_Group_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("bannermanager_form", array("legend"=>Mage::helper("bannermanager")->__("Group Information")));

		
		$fieldset->addField("identifier", "text", array(
			"label" => Mage::helper("bannermanager")->__("Identifer"),					
			"class" => "required-entry",
			"required" => true,
			"name" => "identifier",
		));
		
		$fieldset->addField("init_script", "textarea", array(
			"label" => Mage::helper("bannermanager")->__("Slider Config Settings"),
			"name" => "init_script",
		));
		
		$fieldset->addField("sort_type", "select", array(
			"label" => Mage::helper("bannermanager")->__("Method to sort banners"),
			"name" => "sort_type",
			"values" => LogicSpot_BannerManager_Model_Source_SortOrder::toOptionArray(),
		));
		
		$fieldset->addField("max_banners", "text", array(
			"label" => Mage::helper("bannermanager")->__("Max number of banners"),
			"name" => "max_banners",
		));
		
		if (Mage::getSingleton("adminhtml/session")->getGroupData())
		{
			$form->setValues(Mage::getSingleton("adminhtml/session")->getGroupData());
			Mage::getSingleton("adminhtml/session")->setGroupData(null);
		}elseif(Mage::registry("group_data")){
			$form->setValues(Mage::registry("group_data")->getData());
		}
		
		return parent::_prepareForm();
	}
}
