<?php
class LogicSpot_BannerManager_Block_Adminhtml_Banner_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
	protected function _prepareForm()
	{
		$form = new Varien_Data_Form();
		$this->setForm($form);
		$fieldset = $form->addFieldset("bannermanager_form", array("legend"=>Mage::helper("bannermanager")->__("Banner Information")));
		
		$fieldset->addField('image', 'image', array(
			'label' => Mage::helper('bannermanager')->__('Image'),
			'name' => 'image',
			'note' => '(*.jpg, *.png, *.gif) Max file size: ' . ini_get('upload_max_filesize'),
		));

		$dateFormatIso = Mage::app()->getLocale()->getDateTimeFormat(
			Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM
		);

		$fieldset->addField('date_from', 'date', array(
			'label' => Mage::helper('bannermanager')->__('Date From'),
			'name' => 'date_from',
			'time' => true,
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
			'format' => Varien_date::DATETIME_INTERNAL_FORMAT,
			'input_format' => Varien_date::DATETIME_INTERNAL_FORMAT,
		));

		$fieldset->addField('date_to', 'date', array(
			'label' => Mage::helper('bannermanager')->__('Date To'),
			'name' => 'date_to',
			'time' => true,
			'image' => $this->getSkinUrl('images/grid-cal.gif'),
			'format' => Varien_date::DATETIME_INTERNAL_FORMAT,
			'input_format' => Varien_date::DATETIME_INTERNAL_FORMAT,
		));

		$fieldset->addField("title", "text", array(
			"label" => Mage::helper("bannermanager")->__("Title"),
			"name" => "title",
		));
	
		$fieldset->addField("content", "textarea", array(
			"label" => Mage::helper("bannermanager")->__("Content"),
			"name" => "content",
		));
	
		if(Mage::getStoreConfig('logicspot/bannermanager/show_colour_options'))
		{
			$fieldset->addField("primary_colour", "text", array(
				"label" => Mage::helper("bannermanager")->__("Primary Colour"),
				"name" => "primary_colour",
				"class" => 'color',
			));
	
			$fieldset->addField("secondary_colour", "text", array(
				"label" => Mage::helper("bannermanager")->__("Secondary Colour"),
				"name" => "secondary_colour",
				"class" => 'color',
			));
		}
		$fieldset->addField('store_view', 'multiselect', array(
			'label' => Mage::helper('bannermanager')->__('Store'),
			'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(false, true),
			'name' => 'store_view',
		));
		
		$fieldset->addField('group_id', 'multiselect', array(
			'label' => Mage::helper('bannermanager')->__('Display Group'),
			'values' => LogicSpot_BannerManager_Block_Adminhtml_Banner_Grid::getValueArray11(),
			'name' => 'group_id',
		));
		
		$fieldset->addField("link", "text", array(
			"label" => Mage::helper("bannermanager")->__("Link"),
			"name" => "link",
		));
		
		$fieldset->addField("priority", "text", array(
			"label" => Mage::helper("bannermanager")->__("Priority"),
			"name" => "priority",
		));

		if (Mage::getSingleton("adminhtml/session")->getBannerData())
		{
			$form->setValues(Mage::getSingleton("adminhtml/session")->getBannerData());
			Mage::getSingleton("adminhtml/session")->setBannerData(null);
		}elseif(Mage::registry("banner_data")){
			$form->setValues(Mage::registry("banner_data")->getData());
		}
		return parent::_prepareForm();
	}
}
