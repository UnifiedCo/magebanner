<?php
class LogicSpot_BannerManager_Block_Adminhtml_Renderer_Codes extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
	{
		$templateName = 'slider.phtml';
		
		$cmsCode = '{{block type="bannermanager/slider" name="' . $row['identifier'] . '" banner_group="' . $row['identifier'] . '" template="bannermanager/' . $templateName . '"}}';
		$xmlCode = '<block type="bannermanager/slider" name="' . $row['identifier'] . '" template="bannermanager/' . $templateName . '"><action method="setData"><name>banner_group</name><value>' . $row['identifier'] . '</value></action></block>';
		
		return '<div style="font-size: 0.7em;"><code>' . htmlspecialchars($cmsCode) . '</code><br/><code>' . htmlspecialchars($xmlCode) . '</code></div>';
	}
}