<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Album
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="album")
 * @ORM\HasLifecycleCallbacks()
 */
class Album
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
    private $album;

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
//
//    /**
//     * @var \App\Entity\Playlist
//     * @ORM\OneToOne(
//     *     targetEntity="App\Entity\Playlist",
//     *     cascade={"persist"}
//     * )
//     */
//    private $tracks;
//
    /**
     * @var Label
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Label",
     *     inversedBy="albums",
     *     cascade={"persist"}
     * )
     */
    private $label;

    /**
     * @var \DateTime
     * @ORM\Column(
     *     name="release_date",
     *     type="datetime",
     *     nullable=false
     * )
     */
    private $releaseDate;

    # genre
    # artist
    # guest

    /**
     * Album constructor.
     *
     * @param string $album
     */
    public function __construct(string $album = "")
    {
        $this->album        = $album;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();

//        $this->tracks;
//        $this->releaseDate;
//        $this->genres;
//        $this->artists;
//        $this->guest;

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
     * Set album.
     *
     * @param string $album
     *
     * @return Album
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Get album.
     *
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Set creationDate.
     *
     * @param \DateTime $creationDate
     *
     * @return Album
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
     * @return Album
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
     * @param \DateTime $releaseDate
     *
     * @return Album
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get releaseDate.
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set tracks.
     *
     * @param \App\Entity\Playlist|null $tracks
     *
     * @return Album
     */
    public function setTracks(\App\Entity\Playlist $tracks = null)
    {
        $this->tracks = $tracks;

        return $this;
    }

    /**
     * Get tracks.
     *
     * @return \App\Entity\Playlist|null
     */
    public function getTracks()
    {
        return $this->tracks;
    }

    /**
     * Set label.
     *
     * @param \App\Entity\Label|null $label
     *
     * @return Album
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
