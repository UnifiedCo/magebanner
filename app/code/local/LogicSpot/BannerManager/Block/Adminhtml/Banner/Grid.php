<?php
class LogicSpot_BannerManager_Block_Adminhtml_Banner_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId("bannerGrid");
		$this->setDefaultSort("banner_id");
		$this->setDefaultDir("DESC");
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel("bannermanager/banner")->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	
	protected function _prepareColumns()
	{
		$this->addColumn("banner_id", array(
			"header" => Mage::helper("bannermanager")->__("ID"),
			"align" =>"right",
			"width" => "50px",
			"type" => "number",
			"index" => "banner_id",
		));
		
		$this->addColumn('image', array(
			'header'    => Mage::helper('bannermanager')->__('Image'),
			'index'     => 'image',
			'renderer' => new LogicSpot_BannerManager_Block_Adminhtml_Renderer_Image(),
		));
		
		$this->addColumn('date_from', array(
			'header'    => Mage::helper('bannermanager')->__('Date From'),
			'index'     => 'date_from',
			'type'      => 'datetime',
		));
		
		$this->addColumn('date_to', array(
			'header'    => Mage::helper('bannermanager')->__('Date To'),
			'index'     => 'date_to',
			'type'      => 'datetime',
		));

		$this->addColumn("title", array(
			"header" => Mage::helper("bannermanager")->__("Title"),
			"index" => "title",
		));
		
		if(Mage::getStoreConfig('logicspot/bannermanager/show_colour_options'))
		{
			$this->addColumn("primary_colour", array(
				"header" => Mage::helper("bannermanager")->__("Primary Colour"),
				"index" => "primary_colour",
			));

			$this->addColumn("secondary_colour", array(
				"header" => Mage::helper("bannermanager")->__("Secondary Colour"),
				"index" => "secondary_colour",
			));
		}
		
		$this->addColumn("link", array(
			"header" => Mage::helper("bannermanager")->__("Link"),
			"index" => "link",
		));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl("*/*/edit", array("id" => $row->getId()));
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('banner_id');
		$this->getMassactionBlock()->setFormFieldName('banner_ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('remove_banner', array(
			'label'=> Mage::helper('bannermanager')->__('Remove Banner'),
			'url'  => $this->getUrl('*/adminhtml_banner/massRemove'),
			'confirm' => Mage::helper('bannermanager')->__('Are you sure?')
		));
		return $this;
	}

	static public function getBannerGroups()
	{
		$data_array=array();
		$bannerGroups = Mage::getModel('bannermanager/group')->getCollection();
		foreach($bannerGroups as $bannerGroup)
		{
			$data_array[$bannerGroup->getGroupId()] = $bannerGroup->getIdentifier();
		}
		return($data_array);
	}

	static public function getValueArray11()
	{
		$data_array=array();
		foreach(LogicSpot_BannerManager_Block_Adminhtml_Banner_Grid::getBannerGroups() as $key => $value)
		{
		   $data_array[] = array('value' => $key, 'label' => $value);		
		}
		return($data_array);
	}
}