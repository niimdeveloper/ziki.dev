<?php

namespace Ziki\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ziki\MusicBundle\Entity\Track
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Track
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $duration
     *
     * @ORM\Column(name="duration", type="string", length=255)
     */
    private $duration;
    
    // -- Relattionships --
     
    /**
     * @ORM\ManyToMany(targetEntity="Album", mappedBy="tracks")
     */
    private $albums;
    
//     /**
//      * @ORM\ManyToMany(targetEntity="Genre", mappedBy="tracks")
//      */
//     private $genres;
	
    /**
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="tracks")
     *  
     */
    private $genre;
    
    
    // -- End Relationships
    
    public function __toString(){
    	return $this->title;
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
     * Set title
     *
     * @param string $title
     * @return Track
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
     * Set duration
     *
     * @param string $duration
     * @return Track
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albums = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add albums
     *
     * @param Ziki\MusicBundle\Entity\Album $albums
     * @return Track
     */
    public function addAlbum(\Ziki\MusicBundle\Entity\Album $albums)
    {
        $this->albums[] = $albums;
    
        return $this;
    }

    /**
     * Remove albums
     *
     * @param Ziki\MusicBundle\Entity\Album $albums
     */
    public function removeAlbum(\Ziki\MusicBundle\Entity\Album $albums)
    {
        $this->albums->removeElement($albums);
    }

    /**
     * Get albums
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * Add genres
     *
     * @param Ziki\MusicBundle\Entity\Genre $genres
     * @return Track
     */
    public function addGenre(\Ziki\MusicBundle\Entity\Genre $genres)
    {
        $this->genres[] = $genres;
    
        return $this;
    }

    /**
     * Remove genres
     *
     * @param Ziki\MusicBundle\Entity\Genre $genres
     */
    public function removeGenre(\Ziki\MusicBundle\Entity\Genre $genres)
    {
        $this->genres->removeElement($genres);
    }

    /**
     * Get genres
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * Get genre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set genre
     *
     * @param \Ziki\MusicBundle\Entity\Genre $genre
     * @return Track
     */
    public function setGenre(\Ziki\MusicBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;
    
        return $this;
    }
}