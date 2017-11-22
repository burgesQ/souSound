<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

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
     * @var \App\Entity\User
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     *     inversedBy="playlists"
     * )
     */
    private $owner;

    # $labels
    # $releaseDate
    # genre
    # owner

    /**
     * User constructor.
     *
     * @param string $playlist
     */
    public function __construct(string $playlist = "")
    {
        $this->id           = -1;
        $this->playlist        = $playlist;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->tracks       = new ArrayCollection();
        $this->artistes     = new ArrayCollection();
        $this->isAlbum      = false;
        $this->owner        = null;
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
     * @return Playlist
     */
    public function setCreationDate(\DateTime $creationDate): Playlist
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
     * @return Playlist
     */
    public function setUpdateDate(\DateTime $updateDate): Playlist
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get Playlist
     *
     * @return string
     */
    public function getPlaylist(): string
    {
        return $this->playlist;
    }

    /**
     * Set Playlist
     *
     * @param string $playlist
     *
     * @return Playlist
     */
    public function setPlaylist(string $playlist): Playlist
    {
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * Add track
     *
     * @param Track $track
     *
     * @return Playlist
     */
    public function addTrack(Track $track): Playlist
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
     * Add artiste
     *
     * @param Artist $artiste
     *
     * @return Playlist
     */
    public function addArtiste(Artist $artiste) : Playlist
    {
        $this->artistes[] = $artiste;

        return $this;
    }

    /**
     * Remove artiste
     *
     * @param Artist $artiste
     */
    public function removeArtiste(Artist $artiste)
    {
        $this->artistes->removeElement($artiste);
    }

    /**
     * Get artistes
     *
     * @return ArrayCollection
     */
    public function getArtistes() : ArrayCollection
    {
        return $this->artistes;
    }

    /**
     * Set isAlbum
     *
     * @param boolean $isAlbum
     *
     * @return Playlist
     */
    public function setIsAlbum(bool $isAlbum) : Playlist
    {
        $this->isAlbum = $isAlbum;

        return $this;
    }

    /**
     * Get isAlbum
     *
     * @return boolean
     */
    public function getIsAlbum() : bool
    {
        return $this->isAlbum;
    }

    /**
     * Set owner
     *
     * @param \App\Entity\User $owner
     *
     * @return Playlist
     */
    public function setOwner(User $owner = null) : Playlist
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return \App\Entity\User
     */
    public function getOwner() : User
    {
        return $this->owner;
    }
}
