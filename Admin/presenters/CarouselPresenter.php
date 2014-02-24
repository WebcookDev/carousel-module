<?php

namespace AdminModule\CarouselModule;

/**
 * Description of
 *
 * @author Tomáš Voslař <tomas.voslar@webcook.cz>
 */
class CarouselPresenter extends BasePresenter {

    protected function startup() {
	parent::startup();
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
}