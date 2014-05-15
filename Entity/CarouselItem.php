<?php

namespace WebCMS\CarouselModule\Entity;

use Doctrine\ORM\Mapping as orm;

/**
 * @orm\Entity
 * @author Tomáš Voslař <tomas.voslar at webcook.cz>
 */
class CarouselItem extends \WebCMS\Entity\Entity {

    /**
     * @orm\Column
     */
    private $title;
    
    /**
     * @orm\Column(type="text")
     */
    private $text;

    /**
     * @orm\ManyToOne(targetEntity="WebCMS\Entity\Page")
     * @orm\JoinColumn(onDelete="CASCADE")
     */
    private $page;
    
    /**
     * @orm\Column(nullable=true)
     */
    private $picturePath;
    
    /**
     * @orm\Column(type="integer")
     */
    private $slideOrder;
    
    public function getText() {
	return $this->text;
    }

    public function setText($text) {
	$this->text = $text;
    }

    public function getPage() {
	return $this->page;
    }

    public function setPage($page) {
	$this->page = $page;
    }

    public function getTitle() {
	return $this->title;
    }

    public function getPicturePath() {
	return $this->picturePath;
    }

    public function getSlideOrder() {
	return $this->slideOrder;
    }

    public function setTitle($title) {
	$this->title = $title;
    }

    public function setPicturePath($picturePath) {
	$this->picturePath = $picturePath;
    }

    public function setSlideOrder($slideOrder) {
	$this->slideOrder = $slideOrder;
    }
}
