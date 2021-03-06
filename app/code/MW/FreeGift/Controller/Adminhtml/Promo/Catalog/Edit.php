<?php
namespace MW\FreeGift\Controller\Adminhtml\Promo\Catalog;

use MW\FreeGift\Controller\Adminhtml\Promo\Catalog;

class Edit extends Catalog
{
    /**
     * @return void
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->ruleFactory->create();

        if ($id) {
            $model->load($id);
            if (!$model->getRuleId()) {
                $this->messageManager->addError(__('This rule no longer exists.'));
                $this->_redirect('*/*');
                return;
            }
        }

        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }

        $model->getConditions()->setJsFormObject('rule_conditions_fieldset');
        $model->getConditions()->setFormName('mw_freegift_catalog_rule_form');
        $model->getConditions()->setJsFormObject(
            $model->getConditionsFieldSetId($model->getConditions()->getFormName())
        );

        $this->_coreRegistry->register('current_promo_catalog_rule', $model);

        $this->_initAction();
        $this->_view->getPage()->getConfig()->getTitle()->prepend(__('Free Gift Rule'));
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            $model->getRuleId() ? $model->getName() : __('New Free Gift Rule')
        );

        $breadcrumb = $id ? __('Edit Rule') : __('New Rule');
        $this->_addBreadcrumb($breadcrumb, $breadcrumb);
        $this->_view->renderLayout();
    }
}
