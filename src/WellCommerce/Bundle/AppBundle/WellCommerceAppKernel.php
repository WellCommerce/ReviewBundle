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

namespace WellCommerce\Bundle\AppBundle;

use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;
use WellCommerce\Bundle\AppBundle\Locator\BundleLocator;

/**
 * Class WellCommerceAppKernel
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
class WellCommerceAppKernel extends Kernel
{
    public function registerBundles()
    {
        $applicationBundles = $this->getApplicationBundles();

        $bundles = [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \Bazinga\Bundle\JsTranslationBundle\BazingaJsTranslationBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \Ivory\LuceneSearchBundle\IvoryLuceneSearchBundle(),
            new \Knp\DoctrineBehaviors\Bundle\DoctrineBehaviorsBundle(),
            new WellCommerceAppBundle()
        ];

        foreach ($applicationBundles as $appBundle) {
            $bundles[] = new $appBundle;
        }

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new \Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

    /**
     * @return array
     */
    private function getApplicationBundles()
    {
        if (is_file($cache = $this->getCacheDir() . '/bundles.php')) {
            $bundles = require $cache;
        } else {
            $locator = new BundleLocator($this->rootDir . '/../src');
            $bundles = $locator->getBundles();
        }

        return $bundles;
    }
}
