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
     *     targetEntity="App\Entity\Playlist"
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set artist.
     *
     * @param string $artist
     *
     * @return Artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Get artist.
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Artist
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
     * @return Artist
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
     * Add track.
     *
     * @param \App\Entity\Track $track
     *
     * @return Artist
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
     * @param \App\Entity\Playlist $album
     *
     * @return Artist
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
     * Add signedLabel.
     *
     * @param \App\Entity\Label $signedLabel
     *
     * @return Artist
     */
    public function addSignedLabel(\App\Entity\Label $signedLabel)
    {
        $this->signedLabel[] = $signedLabel;

        return $this;
    }

    /**
     * Remove signedLabel.
     *
     * @param \App\Entity\Label $signedLabel
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSignedLabel(\App\Entity\Label $signedLabel)
    {
        return $this->signedLabel->removeElement($signedLabel);
    }

    /**
     * Get signedLabel.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSignedLabel()
    {
        return $this->signedLabel;
    }
}
