<?php
class LogicSpot_BannerManager_Helper_Banners extends Mage_Core_Helper_Abstract
{
	public function toOptionArray()
	{
		$optionsArray = array();
		
		$banners = Mage::getModel('bannermanager/banner')->getCollection();
		foreach($banners as $banner){
			$optionsArray[] = array('value' => $banner->getBannerId(), 'label' => $banner->getTitle() . ' - ' . $banner->getLink());
		}
		
		return $optionsArray;
	}
}
