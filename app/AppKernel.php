<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array_merge(
			$this->getApplicationBundles(),
			$this->getExternalBundles(),
			$this->getDefaultBundles()
		);

		if (in_array($this->getEnvironment(), array('dev', 'test'))) {
			$bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
			$bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
			$bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
		}

        return $bundles;
    }

	private function getApplicationBundles()
	{
		return array(
			new Discussione\UploadBundle\DiscussioneUploadBundle(),
			new Discussione\DocumentBundle\DiscussioneDocumentBundle(),
			new Discussione\MessageBundle\DiscussioneMessageBundle(),
			new Discussione\DiscussionBundle\DiscussioneDiscussionBundle(),
		);
	}

	private function getExternalBundles()
	{
		return array(
			new OldSound\RabbitMqBundle\OldSoundRabbitMqBundle(),
		);
	}

	private function getDefaultBundles()
	{
		return array(
			new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
			new Symfony\Bundle\SecurityBundle\SecurityBundle(),
			new Symfony\Bundle\TwigBundle\TwigBundle(),
			new Symfony\Bundle\MonologBundle\MonologBundle(),
			new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
			new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\MongoDBBundle\DoctrineMongoDBBundle(),
			new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
			new JMS\AopBundle\JMSAopBundle(),
			new JMS\DiExtraBundle\JMSDiExtraBundle($this),
			new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
		);
	}

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
