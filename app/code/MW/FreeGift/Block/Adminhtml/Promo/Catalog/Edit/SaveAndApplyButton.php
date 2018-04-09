<?php

namespace MW\FreeGift\Block\Adminhtml\Promo\Catalog\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveAndApplyButton extends \Magento\CatalogRule\Block\Adminhtml\Edit\GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     * @codeCoverageIgnore
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->canRender('save_apply')) {
            $data = [
                'label' => __('Save and Apply'),
                'class' => 'save',
                'on_click' => '',
                'sort_order' => 80,
                'data_attribute' => [
                    'mage-init' => [
                        'Magento_Ui/js/form/button-adapter' => [
                            'actions' => [
                                [
                                    'targetName' => 'mw_freegift_catalog_rule_form.catalog_rule_form_data_source',
                                    'actionName' => 'save',
                                    'params' => [
                                        [
                                            'attributes' => [
                                                'action' => $this->getUrl('*/*/save', ['_current' => true, 'auto_apply' => 1])
                                            ]
                                        ],
                                    ]
                                ]
                            ],
//                            'actions' => [
//                                [
//                                    'targetName' => 'catalog_rule_form.catalog_rule_form_data_js_component',
//                                    'actionName' => 'save',
//                                    'params' => [
//                                        true,
//                                        ['auto_apply' => 1],
//                                    ]
//                                ]
//                            ]
                        ]
                    ],
                ]
            ];
        }
        return $data;
    }
}
