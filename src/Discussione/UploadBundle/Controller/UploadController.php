<?php

namespace Discussione\UploadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\HttpFoundation\Response;

class UploadController extends Controller
{
	public function uploadAction()
	{
		// TODO: Move to Service.
		$producer = $this->getUploadMaterialProducer();
		$producer->publish('hello');

		return new Response();
	}

	/**
	 * @return Producer
	 */
	private function getUploadMaterialProducer()
	{
		return $this->get('old_sound_rabbit_mq.upload_material_producer');
	}
}