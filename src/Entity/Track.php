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
     *     inversedBy="tracks"
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
//
//    private $tracks;
//
//    private $event;

    # genre

    /**
     * Track constructor.
     *
     * @param string $trackName
     */
    public function __construct(string $trackName = "")
    {
        $this->id           = -1;
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
     * Get id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }

    /**
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Track
     */
    public function setCreationDate(\DateTime $creationDate): Track
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get updateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * Set updateDate
     *
     * @param \DateTime $updateDate
     *
     * @return Track
     */
    public function setUpdateDate(\DateTime $updateDate): Track
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getTrackName(): string
    {
        return $this->trackName;
    }

    /**
     * Set the trackName
     *
     * @param string $trackName
     *
     * @return Track
     */
    public function setTrackName(string $trackName): Track
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * Add artist
     *
     * @param \App\Entity\Artist $artist
     *
     * @return Track
     */
    public function addArtist(Artist $artist): Track
    {
        $this->artists[] = $artist;

        return $this;
    }

    /**
     * Remove artist
     *
     * @param \App\Entity\Artist $artist
     */
    public function removeArtist(Artist $artist)
    {
        $this->artists->removeElement($artist);
    }

    /**
     * Get artists
     *
     * @return ArrayCollection
     */
    public function getArtists(): ArrayCollection
    {
        return $this->artists;
    }

    /**
     * Add albume
     *
     * @param \App\Entity\Album $album
     *
     * @return Track
     */
    public function addAlbum(Album $album): Track
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album
     *
     * @param \App\Entity\Album $album
     */
    public function removeAlbum(Album $album)
    {
        $this->albums->removeElement($album);
    }

    /**
     * Get albums
     *
     * @return ArrayCollection
     */
    public function getAlbums(): ArrayCollection
    {
        return $this->albums;
    }

    /**
     * Get label
     *
     * @return \App\Entity\Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }

    /**
     * Set label
     *
     * @param \App\Entity\Label $label
     *
     * @return Track
     */
    public function setLabel(Label $label = null): Track
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Set releaseDate
     *
     * @param \DateTime $releaseDate
     *
     * @return Track
     */
    public function setReleaseDate(\DateTime $releaseDate) : Track
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate() : \DateTime
    {
        return $this->releaseDate;
    }
}
