<?php

namespace WebCMS\CarouselModule;

/**
 * Description of Page
 *
 * @author Tomáš Voslař <tomas.voslar@webcook.cz>
 */
class Carousel extends \WebCMS\Module {
    
    protected $name = 'Carousel';

    protected $author = 'Tomáš Voslař';

    protected $presenters = array(
	    array(
		    'name' => 'Carousel',
		    'frontend' => TRUE,
		    'parameters' => FALSE
		    ),
	    array(
		    'name' => 'Settings',
		    'frontend' => FALSE
		    )
    );

    public function __construct(){
		$this->addBox('Carousel box', 'Carousel', 'carouselBox');
    }

    public function cloneData($em, $oldLang, $newLang, $transform){
	return false;
    }

    public function translateData($em, $language, $from, $to, \Webcook\Translator\ITranslator $translator){
	return false;
    }
}