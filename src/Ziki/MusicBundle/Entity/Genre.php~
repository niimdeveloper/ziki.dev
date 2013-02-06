<?php

namespace Ziki\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ziki\MusicBundle\Entity\Genre
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Genre
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
     * @var string $genre
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    // -- Relationships --
    
//     /**
//      * Tracks - Albums (Owning side -> updates only here)
//      * @ORM\ManyToMany(targetEntity="Track", inversedBy="genres")
//      * @ORM\JoinTable(name="genre_tracks")
//      */
//     private $tracks;

    /**
     * @ORM\OneToMany(targetEntity="Track", mappedBy="genre")
     */
    private $tracks;
    // -- End Relationships
    
    public function __toString(){
    	return $this->genre;
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
     * Set genre
     *
     * @param string $genre
     * @return Genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;
    
        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Genre
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
        $this->tracks = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add artists
     *
     * @param Ziki\MusicBundle\Entity\Artist $artists
     * @return Genre
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

    /**
     * Add tracks
     *
     * @param Ziki\MusicBundle\Entity\Track $tracks
     * @return Genre
     */
    public function addTrack(\Ziki\MusicBundle\Entity\Track $tracks)
    {
        $this->tracks[] = $tracks;
    
        return $this;
    }

    /**
     * Remove tracks
     *
     * @param Ziki\MusicBundle\Entity\Track $tracks
     */
    public function removeTrack(\Ziki\MusicBundle\Entity\Track $tracks)
    {
        $this->tracks->removeElement($tracks);
    }

    /**
     * Get tracks
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Set tracks
     *
     * @param \Ziki\MusicBundle\Entity\Track $tracks
     * @return Genre
     */
    public function setTracks(\Ziki\MusicBundle\Entity\Track $tracks = null)
    {
        $this->tracks = $tracks;
    
        return $this;
    }
}