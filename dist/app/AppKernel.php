<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Config\FileLocator;
use WMC\DirectoryLoaderBundle\Loader\DependencyInjection\DirectoryFileLoader;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
            new Sp\BowerBundle\SpBowerBundle(),

            new JMS\AopBundle\JMSAopBundle,
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle,
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),

            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle,

            new FOS\UserBundle\FOSUserBundle(),

            new WMC\CommonBundle\WMCCommonBundle,
            new WMC\DoctrineBundle\WMCDoctrineBundle,
            new WMC\DirectoryLoaderBundle\WMCDirectoryLoaderBundle,

            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    protected function getContainerLoader(ContainerInterface $container)
    {
        $loader = parent::getContainerLoader($container);
        $locator = new FileLocator($this);

        // Add additional loader to the resolver
        $resolver = $loader->getResolver();
        $resolver->addLoader(new DirectoryFileLoader($container, $locator));

        return $loader;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
        $loader->load(__DIR__.'/config/config/' . $this->getEnvironment() . '/');
    }
}
