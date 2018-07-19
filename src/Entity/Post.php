<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
    * @ORM\Column(type="string"))
    */
    private $title;

    /**
    * @ORM\Column(type="text"))
    */
    private $content;

    /**
    * @ORM\Column(type="boolean"))
    */
    private $published;


        /**
        * @param mixed $content
        */
        public function getContent()
        {
            return $this->content;
        }

        public function setContent($content)
        {
            $this->content = $content;
        }



        /**
        * @param mixed $published
        */
        public function getPublished()
        {
            return $this->published;
        }

        public function setPublished($published): void
        {
            $this->published = $published;
        }


        /**
        * @param mixed $title
        */
        public function getTitle()
        {
            return $this->title;
        }

        public function setTitle($title)
        {
            $this->price = $price;
        }


}
