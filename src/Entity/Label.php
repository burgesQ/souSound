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
     * @var \DateTime
     * @ORM\Column(
     *     name="start_date",
     *     type="datetime",
     *     nullable=true
     * )
     */
    private $startDate;

    /**
     * @var \App\Entity\Playlist
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Track",
     *     mappedBy="label",
     *     cascade={"persist"}
     * )
     */
    private $tracks;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Album",
     *     mappedBy="label",
     *     cascade={"persist"}
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

    /**
     * @var Artist
     * @ORM\OneToOne(
     *     targetEntity="Artist"
     * )
     */
    private $producer;

    /**
     * Label constructor.
     *
     * @param string $label
     */
    public function __construct(string $label = "")
    {
        $this->id           = -1;
        $this->label        = $label;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();

        // $this->startDate
        // $this->tracks
        // $this->albums
        // $this->artists
        // this->producer
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
     * Set label.
     *
     * @param string $label
     *
     * @return Label
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Label
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
     * @return Label
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
     * Set startDate.
     *
     * @param \DateTime|null $startDate
     *
     * @return Label
     */
    public function setStartDate($startDate = null)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate.
     *
     * @return \DateTime|null
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Add track.
     *
     * @param \App\Entity\Track $track
     *
     * @return Label
     */
    public function addTrack(\App\Entity\Track $track)
    {
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * Remove track.
     *
     * @param \App\Entity\Track $track
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeTrack(\App\Entity\Track $track)
    {
        return $this->tracks->removeElement($track);
    }

    /**
     * Get tracks.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Add album.
     *
     * @param \App\Entity\Album $album
     *
     * @return Label
     */
    public function addAlbum(\App\Entity\Album $album)
    {
        $this->albums[] = $album;

        return $this;
    }

    /**
     * Remove album.
     *
     * @param \App\Entity\Album $album
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAlbum(\App\Entity\Album $album)
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
     * Add artist.
     *
     * @param \App\Entity\Artist $artist
     *
     * @return Label
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
     * Set producer.
     *
     * @param \App\Entity\Artist|null $producer
     *
     * @return Label
     */
    public function setProducer(\App\Entity\Artist $producer = null)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer.
     *
     * @return \App\Entity\Artist|null
     */
    public function getProducer()
    {
        return $this->producer;
    }
}
