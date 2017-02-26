<?php
/**
 * WellCommerce Open-Source E-Commerce Platform
 *
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\ReviewBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use WellCommerce\Bundle\AppBundle\DataFixtures\AbstractDataFixture;

/**
 * Class LoadReviewData
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class LoadReviewData extends AbstractDataFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        if (!$this->isEnabled()) {
            return;
        }
        
        $this->createLayoutBoxes($manager, [
            'review' => [
                'type' => 'Review',
                'name' => 'Product reviews',
            ],
        ]);
        
        $manager->flush();
    }
}
