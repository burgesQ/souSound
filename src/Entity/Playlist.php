<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Playlist
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="playlist")
 * @ORM\HasLifecycleCallbacks()
 */
class Playlist
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
     *     name="playlist",
     *     type="string",
     *     nullable=false
     * )
     */
    private $playlist;

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
     *     targetEntity="App\Entity\Artist"
     * )
     */
    private $artistes;

    /**
     * @var bool
     * @ORM\Column(
     *     name="is_album",
     *     type="boolean",
     *     nullable=false
     * )
     */
    private $isAlbum;

    /**
     * @var \App\Entity\Album
     * @ORM\OneToOne(
     *     targetEntity="Album",
     *     cascade={"persist"}
     * )
     */
    private $album;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     *     inversedBy="playlists"
     * )
     */
    private $owner;

    /**
     * @var \App\Entity\DownloadUtil
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\DownloadUtil",
     *     cascade={"persist"}
     * )
     */
    private $downloadUtil;

    /**
     * Playlist constructor.
     *
     * @param string $playlist
     */
    public function __construct(string $playlist = "")
    {
        $this->playlist     = $playlist;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->tracks       = new ArrayCollection();
        $this->artistes     = new ArrayCollection();
        $this->isAlbum      = false;

        // $this->isAlbum
        // this->album
        // $this->owner
    }

    /**
     * To string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->playlist;
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
     * Get playlist.
     *
     * @return string
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }

    /**
     * Set playlist.
     *
     * @param string $playlist
     *
     * @return Playlist
     */
    public function setPlaylist($playlist)
    {
        $this->playlist = $playlist;

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
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Playlist
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

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
     * Set updateDate.
     *
     * @param \DateTime $updateDate
     *
     * @return Playlist
     */
    public function setUpdateDate($updateDate)
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get isAlbum.
     *
     * @return bool
     */
    public function getIsAlbum()
    {
        return $this->isAlbum;
    }

    /**
     * Set isAlbum.
     *
     * @param bool $isAlbum
     *
     * @return Playlist
     */
    public function setIsAlbum($isAlbum)
    {
        $this->isAlbum = $isAlbum;

        return $this;
    }

    /**
     * Add track.
     *
     * @param \App\Entity\Track $track
     *
     * @return Playlist
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
     * Add artiste.
     *
     * @param \App\Entity\Artist $artiste
     *
     * @return Playlist
     */
    public function addArtiste(\App\Entity\Artist $artiste)
    {
        $this->artistes[] = $artiste;

        return $this;
    }

    /**
     * Remove artiste.
     *
     * @param \App\Entity\Artist $artiste
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeArtiste(\App\Entity\Artist $artiste)
    {
        return $this->artistes->removeElement($artiste);
    }

    /**
     * Get artistes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArtistes()
    {
        return $this->artistes;
    }

    /**
     * Get album.
     *
     * @return \App\Entity\Album|null
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set album.
     *
     * @param \App\Entity\Album|null $album
     *
     * @return Playlist
     */
    public function setAlbum(\App\Entity\Album $album = null)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get owner.
     *
     * @return \App\Entity\User|null
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set owner.
     *
     * @param \App\Entity\User|null $owner
     *
     * @return Playlist
     */
    public function setOwner(\App\Entity\User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Set downloadUtil
     *
     * @param \App\Entity\DownloadUtil $downloadUtil
     *
     * @return Playlist
     */
    public function setDownloadUtil(\App\Entity\DownloadUtil $downloadUtil = null)
    {
        $this->downloadUtil = $downloadUtil;

        return $this;
    }

    /**
     * Get downloadUtil
     *
     * @return \App\Entity\DownloadUtil
     */
    public function getDownloadUtil()
    {
        return $this->downloadUtil;
    }
}
