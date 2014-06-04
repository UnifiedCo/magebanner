<?php
class LogicSpot_BannerManager_Adminhtml_BannerController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->loadLayout()->_setActiveMenu("bannermanager/banner")->_addBreadcrumb(Mage::helper("adminhtml")->__("Banner  Manager"),Mage::helper("adminhtml")->__("Banner Manager"));
		return $this;
	}
	public function indexAction() 
	{
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Manager Banner"));

		$this->_initAction();
		$this->renderLayout();
	}
	public function editAction()
	{			    
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Banner"));
		$this->_title($this->__("Edit Item"));
		
		$id = $this->getRequest()->getParam("id");
		$model = Mage::getModel("bannermanager/banner")->load($id);
		if ($model->getId()) {
			Mage::register("banner_data", $model);
			$this->loadLayout();
			$this->_setActiveMenu("bannermanager/banner");
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Banner Manager"), Mage::helper("adminhtml")->__("Banner Manager"));
			$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Banner Description"), Mage::helper("adminhtml")->__("Banner Description"));
			$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
			$this->_addContent($this->getLayout()->createBlock("bannermanager/adminhtml_banner_edit"))->_addLeft($this->getLayout()->createBlock("bannermanager/adminhtml_banner_edit_tabs"));
			$this->renderLayout();
		} else {
			Mage::getSingleton("adminhtml/session")->addError(Mage::helper("bannermanager")->__("Item does not exist."));
			$this->_redirect("*/*/");
		}
	}

	public function newAction()
	{
		$this->_title($this->__("BannerManager"));
		$this->_title($this->__("Banner"));
		$this->_title($this->__("New Item"));

		$id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("bannermanager/banner")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("banner_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("bannermanager/banner");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Banner Manager"), Mage::helper("adminhtml")->__("Banner Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Banner Description"), Mage::helper("adminhtml")->__("Banner Description"));
	
		$this->_addContent($this->getLayout()->createBlock("bannermanager/adminhtml_banner_edit"))->_addLeft($this->getLayout()->createBlock("bannermanager/adminhtml_banner_edit_tabs"));

		$this->renderLayout();

	}
	public function saveAction()
	{
		$post_data = $this->getRequest()->getPost();

		if ($post_data) {
			try {
				//implode the multi-selects
				if($post_data['store_view'])
				{
					$post_data['store_view'] = implode(',',$post_data['store_view']);
				}else{
					Mage::getSingleton('adminhtml/session')->addWarning('No store view was selected. This is not a required option, however without a store view, your banner will not show.');
				}
				if($post_data['group_id'])
				{
					$post_data['group_id'] = implode(',',$post_data['group_id']);
				}else{
					Mage::getSingleton('adminhtml/session')->addWarning('No group was selected. This is not a required option, however without a group, your banner will not show.');
				}
				
				//change the date formats for db saving
				if($post_data['date_from'])
				{
					$post_data['date_from'] = $post_data['date_from'];
				}else{
					$post_data['date_from'] = '';
				}
				if($post_data['date_to'])
				{
					$post_data['date_to'] = $post_data['date_to'];
				}else{
					$post_data['date_to'] = '';
				}
				//save image
				try{
					if(isset($post_data['image']['delete']) && (bool)$post_data['image']['delete']==1)
					{
						$post_data['image']='';
					}elseif($_FILES['image']['size'] && $_FILES['image']['size'] <= 0)
					{
						unset($post_data['image']);
						Mage::getSingleton('adminhtml/session')->addError('Image is too big to be uploaded. Max size is ' . ini_get('upload_max_filesize'));
					}elseif($_FILES['image']['size']){
						if (isset($_FILES))
						{
							if ($_FILES['image']['name'])
							{
								if($this->getRequest()->getParam("id"))
								{
									$model = Mage::getModel("bannermanager/banner")->load($this->getRequest()->getParam("id"));
									if($model->getData('image'))
									{
											$io = new Varien_Io_File();
											$io->rm(Mage::getBaseDir('media') . DS . implode(DS,explode('/',$model->getData('image'))));	
									}
								}
								$path = Mage::getBaseDir('media') . DS . 'bannermanager' . DS . 'banner' . DS;
								$uploader = new Varien_File_Uploader('image');
								$uploader->setAllowedExtensions(array('jpg','jpeg','png','gif'));
								$uploader->setAllowRenameFiles(false);
								$uploader->setFilesDispersion(false);
								$destFile = $path . str_replace(' ', '_', preg_replace('/[^A-Za-z0-9\-.]/', '', $_FILES['image']['name']));
								$filename = $uploader->getNewFileName($destFile);
								$uploader->save($path, $filename);
								$post_data['image']='bannermanager/banner/'.$filename;
							}
						}
					}else{
						unset($post_data['image']);
					}
				} catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
					$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
					return;
				}
				
				$model = Mage::getModel("bannermanager/banner")
					->addData($post_data)
					->setId($this->getRequest()->getParam("id"))
					->save();

				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Banner was successfully saved"));
				Mage::getSingleton("adminhtml/session")->setBannerData(false);

				if ($this->getRequest()->getParam("back"))
				{
					$this->_redirect("*/*/edit", array("id" => $model->getId()));
					return;
				}
				
				$this->_redirect("*/*/");
				return;
			} catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				Mage::getSingleton("adminhtml/session")->setBannerData($this->getRequest()->getPost());
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
				$model = Mage::getModel("bannermanager/banner");
				$model->setId($this->getRequest()->getParam("id"))->delete();
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
				$this->_redirect("*/*/");
			} 
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
				$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
			}
		}
		$this->_redirect("*/*/");
	}

	public function massRemoveAction()
	{
		try {
			$ids = $this->getRequest()->getPost('banner_ids', array());
			foreach ($ids as $id) {
				$model = Mage::getModel("bannermanager/banner");
				$model->setId($id)->delete();
			}
			Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
		} catch (Exception $e) {
			Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
		}
		$this->_redirect('*/*/');
	}
}
