<?php

namespace Ziki\MusicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ziki\MusicBundle\Entity\Album
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Album
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
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var datetime $releasedAt
     *
     * @ORM\Column(name="releasedAt", type="date")
     */
    private $releasedAt;

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
        return 'uploads/albums';
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



    // -- Relationships -- 
    
    /**
     * Artists - Albums (Owning side -> updates only here)
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="albums")
     * @ORM\JoinTable(name="album_artists")
     */
    private $artists;
    
    /**
     * Tracks - Albums (Owning side -> updates only here)
     * @ORM\ManyToMany(targetEntity="Track", inversedBy="tracks")
     * @ORM\JoinTable(name="album_tracks")
     */
    private $tracks;
    
    // -- End Relationships
    
    public function __toString(){
    	return $this->title;
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
     * @return Album
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
     * Set description
     *
     * @param string $description
     * @return Album
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
     * Set releasedAt
     *
     * @param \DateTime $releasedAt
     * @return Album
     */
    public function setReleasedAt($releasedAt)
    {
        $this->releasedAt = $releasedAt;
    
        return $this;
    }

    /**
     * Get releasedAt
     *
     * @return \DateTime 
     */
    public function getReleasedAt()
    {
        return $this->releasedAt;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Album
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
     * Add artists
     *
     * @param \Ziki\MusicBundle\Entity\Artist $artists
     * @return Album
     */
    public function addArtist(\Ziki\MusicBundle\Entity\Artist $artists)
    {
        $this->artists[] = $artists;
    
        return $this;
    }

    /**
     * Remove artists
     *
     * @param \Ziki\MusicBundle\Entity\Artist $artists
     */
    public function removeArtist(\Ziki\MusicBundle\Entity\Artist $artists)
    {
        $this->artists->removeElement($artists);
    }

    /**
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Add tracks
     *
     * @param \Ziki\MusicBundle\Entity\Track $tracks
     * @return Album
     */
    public function addTrack(\Ziki\MusicBundle\Entity\Track $tracks)
    {
        $this->tracks[] = $tracks;
    
        return $this;
    }

    /**
     * Remove tracks
     *
     * @param \Ziki\MusicBundle\Entity\Track $tracks
     */
    public function removeTrack(\Ziki\MusicBundle\Entity\Track $tracks)
    {
        $this->tracks->removeElement($tracks);
    }

    /**
     * Get tracks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTracks()
    {
        return $this->tracks;
    }
}