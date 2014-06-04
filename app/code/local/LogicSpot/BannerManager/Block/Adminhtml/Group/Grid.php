<?php
class LogicSpot_BannerManager_Block_Adminhtml_Group_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('groupGrid');
		$this->setDefaultSort('group_id');
		$this->setDefaultDir('ASC');
		$this->setSaveParametersInSession(true);
	}

	protected function _prepareCollection()
	{
		$collection = Mage::getModel('bannermanager/group')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}
	protected function _prepareColumns()
	{
		$this->addColumn('group_id', array(
			'header' => Mage::helper('bannermanager')->__('ID'),
			'align' =>'right',
			'width' => '50px',
			'type' => 'number',
			'index' => 'group_id',
		));
		
		$this->addColumn('identifier', array(
			'header' => Mage::helper('bannermanager')->__('Identifer'),
			'index' => 'identifier',
		));

		$this->addColumn('max_banners', array(
			'header' => Mage::helper('bannermanager')->__('Max number of banners'),
			'index' => 'max_banners',
		));
		
		$this->addColumn('indentifier', array(
			'header' => Mage::helper('bannermanager')->__('Auto generated code:'),
			'index' => 'indentifier',
			'renderer' => new LogicSpot_BannerManager_Block_Adminhtml_Renderer_Codes(),
		));

		return parent::_prepareColumns();
	}

	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('group_id');
		$this->getMassactionBlock()->setFormFieldName('group_ids');
		$this->getMassactionBlock()->setUseSelectAll(true);
		$this->getMassactionBlock()->addItem('remove_group', array(
				 'label'=> Mage::helper('bannermanager')->__('Remove Group'),
				 'url'  => $this->getUrl('*/adminhtml_group/massRemove'),
				 'confirm' => Mage::helper('bannermanager')->__('Are you sure?')
			));
		return $this;
	}
}