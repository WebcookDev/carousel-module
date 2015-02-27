<?php

namespace AdminModule\CarouselModule;

/**
 * Description of
 *
 * @author Tomáš Voslař <tomas.voslar@webcook.cz>
 */
class CarouselPresenter extends BasePresenter {
	
	private $repository;
	
	private $carouselItem;
	
	/* @var \WebCMS\PageModule\Entity\Page */
	private $page;

    protected function startup() {
		parent::startup();
		
		$this->repository = $this->em->getRepository('WebCMS\CarouselModule\Entity\CarouselItem');
    }

    protected function beforeRender() {
		parent::beforeRender();

    }

    public function actionDefault($idPage){
    }

    public function renderDefault($idPage){
	$this->reloadContent();

	$this->template->idPage = $idPage;
    }
	
	protected function createComponentCarouselGrid($name){
		
		$grid = $this->createGrid($this, $name, 'WebCMS\CarouselModule\Entity\CarouselItem', array(array('by' => 'slideOrder', 'dir' => 'ASC')), array(
			'page = '.$this->actualPage->getId()
		));

		$grid->addColumnText('title', 'Name')->setSortable()->setFilterText();
		$grid->addColumnNumber('slideOrder', 'Order');

		$grid->addActionHref("updateSlide", 'Edit', 'updateSlide', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn' , 'btn-primary', 'ajax')));
		$grid->addActionHref("deleteSlide", 'Delete', 'deleteSlide', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-danger'), 'data-confirm' => 'Are you sure you want to delete this item?'));

		return $grid;
	}
	
	public function actionUpdateSlide($idPage, $id){
		$this->reloadContent();		
		
		if(is_numeric($id)){
			$this->carouselItem = $this->repository->find($id);
		}else{
			$this->carouselItem = new \WebCMS\CarouselModule\Entity\CarouselItem;
		}
	}
	
	public function renderUpdateSlide($idPage){
		
		$this->template->carouselItem = $this->carouselItem;
		$this->template->idPage = $idPage;
	}
	
	public function actionDeleteSlide($id){

		$act = $this->repository->find($id);
		$this->em->remove($act);
		$this->em->flush();
		
		$this->flashMessage('Slide has been removed.', 'success');
		
		if(!$this->isAjax()){
			$this->redirect('default', array(
				'idPage' => $this->actualPage->getId()
			));
		}
	}
	
	public function createComponentCarouselItemForm(){
		$form = $this->createForm();
		
		$form->addText('title', 'Title');
		$form->addText('slideOrder', 'Order')->setRequired('Fill in order.')
				->addRule($form::INTEGER, 'Order must be a number', '.*[0-9].*');;
		$form->addTextArea('text', 'Text')->setAttribute('class', array('editor'));
		
		$form->addSubmit('send', 'Save')->setAttribute('class', array('btn btn-success'));
		$form->onSuccess[] = callback($this, 'carouselItemFormSubmitted');

		$form->setDefaults($this->carouselItem->toArray());
		
		return $form;
	}
	
	public function carouselItemFormSubmitted($form){
		$values = $form->getValues();
		
		$this->page = $this->em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
			'id' => $this->actualPage->getId()
		));
		
		$this->carouselItem->setTitle($values->title);
		$this->carouselItem->setText($values->text);
		$this->carouselItem->setPage($this->page);
		$this->carouselItem->setSlideOrder($values->slideOrder);
		
		if(array_key_exists('files', $_POST)){
			$this->carouselItem->setPicturePath($_POST['files'][0]);
		}else{
			$this->carouselItem->setPicturePath(NULL);
		}
		
		if(!$this->carouselItem->getId()){
			$this->em->persist($this->carouselItem);
		}		
		
		$this->em->flush();
		
		$this->flashMessage('Slide has been saved.', 'success');
		$this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
	}
	
	
	
	
}