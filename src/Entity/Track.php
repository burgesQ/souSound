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
     *     targetEntity="App\Entity\Mix"
     * )
     */
    private $mixes;

    # $labels
    # $albums
    # $tracks
    # $mixes
    # $homeCountry
    # $startDate
    # $events
    # $founder

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
        $this->mixes        = new ArrayCollection();
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
     * Add mix
     *
     * @param \App\Entity\Mix $mix
     *
     * @return Track
     */
    public function addMix(Mix $mix): Track
    {
        $this->mixes[] = $mix;

        return $this;
    }

    /**
     * Remove mix
     *
     * @param \App\Entity\Mix $mix
     */
    public function removeMix(Mix $mix)
    {
        $this->mixes->removeElement($mix);
    }

    /**
     * Get mixs
     *
     * @return ArrayCollection
     */
    public function getMixes(): ArrayCollection
    {
        return $this->mixes;
    }
}
