<?php

class LogicSpot_BannerManager_Block_Widget_Banner
extends Mage_Core_Block_Template
implements Mage_Widget_Block_Interface {

	public function getBanner(){
		$bannerId = $this->getData('banner_single');
		if($bannerId){
			return $bannerData = Mage::getModel('bannermanager/banner')->load($bannerId);
		}
		return false;
	}

}