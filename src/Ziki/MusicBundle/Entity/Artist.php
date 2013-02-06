<?php

namespace Ziki\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ziki\MusicBundle\Entity\Artist
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ziki\MusicBundle\Entity\ArtistRepository")
 *
 * @ORM\HasLifecycleCallbacks
 */
class Artist
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
     * Alternative Name
     * @var string $alias
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    private $alias;

    /**
     * Type: eg person, Band, group
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;
    
    /**
     * @var string $location
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;
    
    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;
    
    /**
     * @var datetime $createdAt
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;
    
    
    //--- Start File upload
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
     public $image;
    
     /**
     * @Assert\File(maxSize="6000000")
     */
     public $file;
    
    
     public function getAbsoluteImage()
     {
     return null === $this->image
     ? null
     	: $this->getUploadRootDir().'/'.$this->image;
    }
    
    public function getWebImage()
    {
    		return null === $this->image
    		? null
    		: $this->getUploadDir().'/'.$this->image;
    }
    
    protected function getUploadRootDir()
    {
    // the absolute directory image where uploaded
    // documents should be saved
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    protected function getUploadDir()
    {
    // get rid of the __DIR__ so it doesn't screw up
    	// when displaying uploaded doc/image in the view.
    	return 'uploads/artists';
    }
    
    
    	/**
    	* @ORM\PrePersist()
    	* @ORM\PreUpdate()
    	*/
    	public function preUpload()
    	{
    	if (null !== $this->file) {
    	// do whatever you want to generate a unique name
    	$filename = sha1(uniqid(mt_rand(), true));
    	$this->image = $filename.'.'.$this->file->guessExtension();
    	}
    	}
    
    	/**
    	* @ORM\PostPersist()
    		* @ORM\PostUpdate()
    		*/
    		public function upload()
    		{
    		if (null === $this->file) {
    		return;
    	}
    	// if there is an error when moving the file, an exception will
    	// be automatically thrown by move(). This will properly prevent
    	// the entity from being persisted to the database on error
    	$this->file->move($this->getUploadRootDir(), $this->image);
    	unset($this->file);
    	}
    	/**
    	* @ORM\PostRemove()
    	*/
    	public function removeUpload()
    	{
    	if ($file = $this->getAbsoluteImage()) {
    	unlink($file);
    	}
    	}
    	//--- End File Upload
    	
    	//-- Choices
    	public static function getTypes()
    	{
    		return array('solo-artist' => 'Solo Artist', 'group-artist' => 'Belongs to a group');
    	}
    	
    	public static function getTypeValues()
    	{
    		return array_keys(self::getTypes());
    	}
    	//-- End Choices
    
    
    // -- Relattionships --
     
    /**
     * @ORM\ManyToMany(targetEntity="Album", mappedBy="artists")
     */
    private $albums;
    
    /**
     * @ORM\ManyToMany(targetEntity="Band", mappedBy="artists")
     */
    private $bands;
    
    // -- End Relationships
    
    
    public function __toString(){
    	return $this->alias;
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
     * Set alias
     *
     * @param string $alias
     * @return Artist
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Artist
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Artist
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Artist
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->albums = new \Doctrine\Common\Collections\ArrayCollection();
        $this->createdAt = $this->updatedAt = new \DateTime();
    }
    
    /**
     * Add albums
     *
     * @param Ziki\MusicBundle\Entity\Album $albums
     * @return Artist
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
     * Add artists
     *
     * @param Ziki\MusicBundle\Entity\Album $artists
     * @return Artist
     */
    public function addArtist(\Ziki\MusicBundle\Entity\Album $artists)
    {
        $this->artists[] = $artists;
    
        return $this;
    }

    /**
     * Remove artists
     *
     * @param Ziki\MusicBundle\Entity\Album $artists
     */
    public function removeArtist(\Ziki\MusicBundle\Entity\Album $artists)
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
     * Add bands
     *
     * @param Ziki\MusicBundle\Entity\Band $bands
     * @return Artist
     */
    public function addBand(\Ziki\MusicBundle\Entity\Band $bands)
    {
        $this->bands[] = $bands;
    
        return $this;
    }

    /**
     * Remove bands
     *
     * @param Ziki\MusicBundle\Entity\Band $bands
     */
    public function removeBand(\Ziki\MusicBundle\Entity\Band $bands)
    {
        $this->bands->removeElement($bands);
    }

    /**
     * Get bands
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getBands()
    {
        return $this->bands;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Artist
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Artist
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Artist
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
}