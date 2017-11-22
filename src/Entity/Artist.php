<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Artist
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="artist")
 * @ORM\HasLifecycleCallbacks()
 */
class Artist
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
     *     name="artist",
     *     type="string",
     *     nullable=false
     * )
     */
    private $artist;

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
     *     targetEntity="App\Entity\Track"
     * )
     */
    private $tracks;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Album"
     * )
     */
    private $albums;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(
     *     targetEntity="App\Entity\Label"
     * )
     */
    private $signedLabel;

    # $homeCountry
    # $startDate
    # $events
    # $founder

    /**
     * User constructor.
     *
     * @param string $artist
     */
    public function __construct(string $artist = "")
    {
        $this->id           = -1;
        $this->artist       = $artist;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->tracks       = new ArrayCollection();
        $this->albums       = new ArrayCollection();
        $this->signedLabel  = new ArrayCollection();
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
     * @return Artist
     */
    public function setCreationDate(\DateTime $creationDate): Artist
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
     * @return Artist
     */
    public function setUpdateDate(\DateTime $updateDate): Artist
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist(): string
    {
        return $this->artist;
    }

    /**
     * Set artist
     *
     * @param string $artist
     *
     * @return Artist
     */
    public function setArtist(string $artist): Artist
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Add track
     *
     * @param Track $track
     *
     * @return Artist
     */
    public function addTrack(Track $track): Artist
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
     * Add album
     *
     * @param \App\Entity\Album $album
     *
     * @return Artist
     */
    public function addAlbum(Album $album): Artist
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
     * Add signedLabel
     *
     * @param \App\Entity\Playlist $signedLabel
     *
     * @return Artist
     */
    public function addSignedLabel(Playlist $signedLabel): Artist
    {
        $this->signedLabel[] = $signedLabel;

        return $this;
    }

    /**
     * Remove signedLabel
     *
     * @param \App\Entity\Playlist $signedLabel
     */
    public function removeSignedLabel(Playlist $signedLabel)
    {
        $this->signedLabel->removeElement($signedLabel);
    }

    /**
     * Get signedLabel
     *
     * @return ArrayCollection
     */
    public function getSignedLabel(): ArrayCollection
    {
        return $this->signedLabel;
    }
}
