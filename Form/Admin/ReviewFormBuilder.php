<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\ReviewBundle\Form\Admin;

use WellCommerce\Bundle\CoreBundle\Form\AbstractFormBuilder;
use WellCommerce\Component\Form\Elements\FormInterface;

/**
 * Class ReviewFormBuilder
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class ReviewFormBuilder extends AbstractFormBuilder
{
    public function getAlias(): string
    {
        return 'admin.review';
    }
    
    public function buildForm(FormInterface $form)
    {
        $mainData = $form->addChild($this->getElement('nested_fieldset', [
            'name'  => 'required_data',
            'label' => 'common.fieldset.general',
        ]));
        
        $mainData->addChild($this->getElement('checkbox', [
            'name'  => 'enabled',
            'label' => 'common.label.enabled',
        ]));
        
        $mainData->addChild($this->getElement('text_field', [
            'name'  => 'nick',
            'label' => 'review.label.nick',
        ]));
        
        $mainData->addChild($this->getElement('select', [
            'name'    => 'rating',
            'label'   => 'review.label.rating',
            'options' => $this->getRatingOptions(),
        ]));
        
        $mainData->addChild($this->getElement('text_area', [
            'name'  => 'review',
            'label' => 'review.label.review',
            'rows'  => 5,
            'cols'  => 10,
        ]));
        
        $form->addFilter($this->getFilter('no_code'));
        $form->addFilter($this->getFilter('trim'));
        $form->addFilter($this->getFilter('secure'));
    }
    
    private function getRatingOptions(): array
    {
        $rating = [];
        foreach (range(1, 5, 1) as $range) {
            $rating[$range] = $range;
        }
        
        return $rating;
    }
}
