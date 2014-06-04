<?php
class LogicSpot_BannerManager_Helper_Groups extends Mage_Core_Helper_Abstract
{
	public function toOptionArray()
	{
		$optionsArray = array();
		
		$groups = Mage::getModel('bannermanager/group')->getCollection();
		foreach($groups as $group){
			$optionsArray[] = array('value' => $group->getGroupId(), 'label' => $group->getIdentifier());
		}
		
		return $optionsArray;
	}
}
