<?php

namespace FrontendModule\CarouselModule;

/**
 * Description of
 *
 * @author Tomáš Voslař <tomas.voslar@webcook.cz>
 */
class CarouselPresenter extends \FrontendModule\BasePresenter{
	
    protected function startup() {
	parent::startup();
    }

    protected function beforeRender() {
	parent::beforeRender();	
    }
	
    public function actionDefault($id){

    }
	
    public function renderDefault($id){

	$this->template->id = $id;
    }
}