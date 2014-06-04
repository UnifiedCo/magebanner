<?php

class LogicSpot_BannerManager_Model_Source_SortOrder
{
	static function toOptionArray()
	{
		return array(
			array('value' => 1, 'label' => Mage::helper('bannermanager')->__('Random')),
			array('value' => 2, 'label' => Mage::helper('bannermanager')->__('Priority')),
		);
	}
}