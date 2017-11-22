<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Label
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="label")
 * @ORM\HasLifecycleCallbacks()
 */
class Label
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
     *     name="label",
     *     type="string",
     *     nullable=false
     * )
     */
    private $label;

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
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Track",
     *     mappedBy="label",
     *     cascade={"persist"}
     * )
     */
    private $tracks;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Playlist"
     * )
     */
    private $albums;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="Artist"
     * )
     */
    private $artists;
//
//    /**
//     * @var \DateTime
//     * @ORM\Column(
//     *     name="release_date",
//     *     type="datetime",
//     *     nullable=true
//     * )
//     */
//    private $releaseDate;

    # $startDate
    # $events

    /**
     * User constructor.
     *
     * @param string $label
     */
    public function __construct(string $label = "")
    {
        $this->id           = -1;
        $this->label        = $label;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->tracks       = new ArrayCollection();
        $this->albums       = new ArrayCollection();
        $this->artists      = new ArrayCollection();
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
     * @return Label
     */
    public function setCreationDate(\DateTime $creationDate): Label
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
     * @return Label
     */
    public function setUpdateDate(\DateTime $updateDate): Label
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get Label
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Set Label
     *
     * @param string $label
     *
     * @return Label
     */
    public function setLabel(string $label): Label
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Add track
     *
     * @param Track $track
     *
     * @return Label
     */
    public function addTrack(Track $track): Label
    {
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * Remove track
     *
     * @param Track $track
     */
    public function removeTrack(Track $track)
    {
        $this->tracks->removeElement($track);
    }

    /**
     * Get tracks
     *
     * @return ArrayCollection
     */
    public function getTracks(): ArrayCollection
    {
        return $this->tracks;
    }

    /**
     * Add Artist
     *
     * @param \App\Entity\Artist $artist
     *
     * @return Label
     */
    public function addArtist(Artist $artist): Label
    {
        $this->artists[] = $artist;

        return $this;
    }

    /**
     * Remove Artist
     *
     * @param \App\Entity\Artist $artist
     */
    public function removeArtist(Artist $artist)
    {
        $this->artists->removeElement($artist);
    }

    /**
     * Get Artists
     *
     * @return ArrayCollection
     */
    public function getArtistes(): ArrayCollection
    {
        return $this->artists;
    }

    /**
     * Add album
     *
     * @param \App\Entity\Album $album
     *
     * @return Label
     */
    public function addAlbum(Album $album): Label
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
     * Get artists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtists()
    {
        return $this->artists;
    }
}
