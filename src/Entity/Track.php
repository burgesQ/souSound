<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Track
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="track")
 * @ORM\HasLifecycleCallbacks()
 */
class Track
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(
     *     name="track_name",
     *     type="string",
     *     nullable=false
     * )
     */
    private $trackName;

    /**
     * @var \DateTime
     * @ORM\Column(
     *     name="creation_date",
     *     type="datetime",
     *     nullable=false
     * )
     */
    private $creationDate;

    /**
     * @var \DateTime
     * @ORM\Column(
     *     name="update_date",
     *     type="datetime",
     *     nullable=false
     * )
     */
    private $updateDate;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Artist"
     * )
     */
    private $artists;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Playlist"
     * )
     */
    private $albums;

    /**
     * @var Label
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Label",
     *     inversedBy="tracks",
     *     cascade={"persist"}
     * )
     */
    private $label;

    /**
     * @var \DateTime
     * @ORM\Column(
     *     name="release_date",
     *     type="datetime",
     *     nullable=true
     * )
     */
    private $releaseDate;

//    private $isMix;
//    private $tracksInMix;
//    private $event;

    # genre

    /**
     * Track constructor.
     *
     * @param string $trackName
     */
    public function __construct(string $trackName = "")
    {
        $this->trackName    = $trackName;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->artists      = new ArrayCollection();
        $this->albums       = new ArrayCollection();
        $this->label        = null;
        $this->releaseDate  = null;
    }

    /**
     * @ORM\PreUpdate
     */
    public function updateDate()
    {
        $this->setUpdateDate(new \Datetime());
    }

    /**
     * @Assert\Callback
     * @param ExecutionContextInterface $context
     */
    public function isValidate(ExecutionContextInterface $context)
    {
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set trackName.
     *
     * @param string $trackName
     *
     * @return Track
     */
    public function setTrackName($trackName)
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * Get trackName.
     *
     * @return string
     */
    public function getTrackName()
    {
        return $this->trackName;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Track
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate.
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set updateDate.
     *
     * @param \DateTime $updateDate
     *
     * @return Track
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get updateDate.
     *
     * @return \DateTime
     */
    public function getUpdateDate()
    {
        return $this->updateDate;
    }

    /**
     * Set releaseDate.
     *
     * @param \DateTime|null $releaseDate
     *
     * @return Track
     */
    public function setReleaseDate($releaseDate = null)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate.
     *
     * @return \DateTime|null
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Add artist.
     *
     * @param \App\Entity\Artist $artist
     *
     * @return Track
     */
    public function addArtist(\App\Entity\Artist $artist)
    {
        $this->artists[] = $artist;

        return $this;
    }

    /**
     * Remove artist.
     *
     * @param \App\Entity\Artist $artist
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArtist(\App\Entity\Artist $artist)
    {
        return $this->artists->removeElement($artist);
    }

    /**
     * Get artists.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * Add album.
     *
     * @param \App\Entity\Playlist $album
     *
     * @return Track
     */
    public function addAlbum(\App\Entity\Playlist $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album.
     *
     * @param \App\Entity\Playlist $album
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAlbum(\App\Entity\Playlist $album)
    {
        return $this->albums->removeElement($album);
    }

    /**
     * Get albums.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAlbums()
    {
        return $this->albums;
    }

    /**
     * Set label.
     *
     * @param \App\Entity\Label|null $label
     *
     * @return Track
     */
    public function setLabel(\App\Entity\Label $label = null)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return \App\Entity\Label|null
     */
    public function getLabel()
    {
        return $this->label;
    }
}
