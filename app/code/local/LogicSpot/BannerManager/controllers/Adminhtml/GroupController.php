<?php

class LogicSpot_BannerManager_Adminhtml_GroupController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("bannermanager/group")->_addBreadcrumb(Mage::helper("adminhtml")->__("Group  Manager"),Mage::helper("adminhtml")->__("Group Manager"));
		return $this;
	}
	public function indexAction() 
	{
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Manager Group"));

		$this->_initAction();
		$this->renderLayout();
	}
	public function editAction()
	{			    
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Group"));
		$this->_title($this->__("Edit Item"));
		
		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("bannermanager/group")->load($id);
		if ($model->getId()) {
			Mage::register("group_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("bannermanager/group");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Group Manager"), Mage::helper("adminhtml")->__("Group Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Group Description"), Mage::helper("adminhtml")->__("Group Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("bannermanager/adminhtml_group_edit"))->_addLeft($this->getLayout()->createBlock("bannermanager/adminhtml_group_edit_tabs"));
			$this->renderLayout();
		} 
		else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("bannermanager")->__("Item does not exist."));
			$this->_redirect("*/*/");
		}
	}

	public function newAction()
	{
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Group"));
		$this->_title($this->__("New Item"));

		$id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("bannermanager/group")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("group_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("bannermanager/group");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Group Manager"), Mage::helper("adminhtml")->__("Group Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Group Description"), Mage::helper("adminhtml")->__("Group Description"));


		$this->_addContent($this->getLayout()->createBlock("bannermanager/adminhtml_group_edit"))->_addLeft($this->getLayout()->createBlock("bannermanager/adminhtml_group_edit_tabs"));

		$this->renderLayout();
	}

	public function saveAction()
	{
		$post_data=$this->getRequest()->getPost();
		if ($post_data)
		{
			try {
				$model = Mage::getModel("bannermanager/group")
				->addData($post_data)
				->setId($this->getRequest()->getParam("id"))
				->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Group was successfully saved"));
				Mage::getSingleton("adminhtml/session")->setGroupData(false);

				if ($this->getRequest()->getParam("back")) {
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				$this->_redirect("*/*/");
				return;
			} catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setGroupData($this->getRequest()->getPost());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
				return;
			}
		}
		$this->_redirect("*/*/");
	}
	
	public function deleteAction()
	{
		if( $this->getRequest()->getParam("id") > 0 ) {
			try {
				$model = Mage::getModel("bannermanager/group");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
				$this->_redirect("*/*/");
			} catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}

	public function massRemoveAction()
	{
		try {
			$ids = $this->getRequest()->getPost('group_ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("bannermanager/group");
				$model->setId($id)->delete();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
		}
		catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
}
