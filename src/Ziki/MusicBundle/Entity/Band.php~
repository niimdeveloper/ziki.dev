<?php

namespace Ziki\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ziki\MusicBundle\Entity\Band
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Band
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    // -- Relationships --
    
    /**
     * Tracks - Albums (Owning side -> updates only here)
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="bands")
     * @ORM\JoinTable(name="band_artists")
     */
    private $artists;
    // -- End Relationships
    
    public function __toString(){
    	return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Band
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Band
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
     * Constructor
     */
    public function __construct()
    {
        $this->artists = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add artists
     *
     * @param Ziki\MusicBundle\Entity\Artist $artists
     * @return Band
     */
    public function addArtist(\Ziki\MusicBundle\Entity\Artist $artists)
    {
        $this->artists[] = $artists;
    
        return $this;
    }

    /**
     * Remove artists
     *
     * @param Ziki\MusicBundle\Entity\Artist $artists
     */
    public function removeArtist(\Ziki\MusicBundle\Entity\Artist $artists)
    {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }
}