<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     *     name="album",
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
     * @var Label
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\Label",
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

    # genre

    /**
     * User constructor.
     *
     * @param string $album
     */
    public function __construct(string $album = "")
    {
        $this->id           = -1;
        $this->album        = $album;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->tracks       = new ArrayCollection();
        $this->artistes     = new ArrayCollection();
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
     * @return Album
     */
    public function setCreationDate(\DateTime $creationDate): Album
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
     * @return Album
     */
    public function setUpdateDate(\DateTime $updateDate): Album
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get Album
     *
     * @return string
     */
    public function getAlbum(): string
    {
        return $this->album;
    }

    /**
     * Set Album
     *
     * @param string $album
     *
     * @return album
     */
    public function setAlbum(string $album): Album
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Add track
     *
     * @param Track $track
     *
     * @return Album
     */
    public function addTrack(Track $track): Album
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
     * @return Album
     */
    public function addArtiste(Artist $artiste) : Album
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
     * Set releaseDate
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
     * Get releaseDate
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set label
     *
     * @param \App\Entity\Label $label
     *
     * @return Album
     */
    public function setLabel(\App\Entity\Label $label = null) : Album
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return \App\Entity\Label
     */
    public function getLabel() : Label
    {
        return $this->label;
    }
}
