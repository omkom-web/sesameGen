<?php

namespace Omkom\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Page
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="Omkom\SiteBundle\Entity\PageRepository")
 */
class Page
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="viewcount", type="integer", nullable=true)
     */
    private $viewcount;
    
    
    /**
     * @var \Boolean
     * @ORM\Column(type="boolean")
     */
    private $active;
    
    /**
    * @Gedmo\Slug(fields={"title"}, updatable=true)
    * @ORM\Column(length=64, unique=true)
    */
    private $slug;

    /**
    * @Assert\NotBlank(message="Titre obligatoire")
    * @ORM\Column(length=64)
    */
    private $title;

    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank(message="Accroche obligatoire")
    */
    private $excerpt;

    /**
    * @ORM\Column(type="text")
    * @Assert\NotBlank(message="Titre obligatoire")
    */  
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     * @Assert\NotBlank(message="Contenu obligatoire")
     */
    private $body;

    /**
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(type="date")
    */
    private $created;
    
    /**
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(type="date")
    */
    private $updated;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Gallery", cascade={"persist"})
     */
    private $gallery;
    
    /**
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"})
     */
    private $media;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->active = false;
    }
 

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set viewcount
     *
     * @param integer $viewcount
     * @return Page
     */
    public function setViewcount($viewcount)
    {
        $this->viewcount = $viewcount;

        return $this;
    }

    /**
     * Get viewcount
     *
     * @return integer 
     */
    public function getViewcount()
    {
        return $this->viewcount;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Page
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Page
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set excerpt
     *
     * @param string $excerpt
     * @return Page
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    /**
     * Get excerpt
     *
     * @return string 
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Page
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set body
     *
     * @param string $body
     * @return Page
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Page
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Page
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set gallery
     *
     * @param \Application\Sonata\MediaBundle\Entity\Gallery $gallery
     * @return Page
     */
    public function setGallery(\Application\Sonata\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Application\Sonata\MediaBundle\Entity\Gallery 
     */
    public function getGallery()
    {
        return $this->gallery;
    }

    /**
     * Set media
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $media
     * @return Page
     */
    public function setMedia(\Application\Sonata\MediaBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }
}
