<?php

namespace FrontendModule\CarouselModule;

/**
 * Description of
 *
 * @author Tomáš Voslař <tomas.voslar@webcook.cz>
 */
class CarouselPresenter extends \FrontendModule\BasePresenter{
	
	private $repository;
	
	private $carouselItems;
	
    protected function startup() {
		parent::startup();

		$this->repository = $this->em->getRepository('WebCMS\CarouselModule\Entity\CarouselItem');
    }

    protected function beforeRender() {
		parent::beforeRender();	
    }
	
    public function actionDefault($id){
		$this->carouselItems = $this->repository->findBy(array('page' => $id), array('slideOrder' => 'ASC'));
    }
	
    public function renderDefault($id){
		$this->template->carouselItems = $this->carouselItems;
		$this->template->id = $id;
    }
	
	public function carouselBox($context, $fromPage){
		
		$repository = $context->em->getRepository('WebCMS\CarouselModule\Entity\CarouselItem');
		
		$carouselItems = $repository->findBy(array(), array('slideOrder' => 'ASC'));
		
		$template = $context->createTemplate();
		$template->setFile('../app/templates/carousel-module/Carousel/box.latte');
		$template->carouselItems = $carouselItems;
		
		return $template;
	}
}