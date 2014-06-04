<?php
class LogicSpot_BannerManager_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$data = '<div style="width:100%; height: 100%;text-align: center;"><img src="' .  Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . $row['image'] . '" style="max-width: 150px;max-height: 150px;padding:0;margin:0;" /></div>';
		return $data;
	}
}