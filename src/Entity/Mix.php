<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class Mix
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="mix")
 * @ORM\HasLifecycleCallbacks()
 */
class Mix
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
    private $mixName;

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
     *     targetEntity="App\Entity\Track"
     * )
     */
    private $tracks;

    # $labels
    # $albums
    # $tracks
    # $mixes
    # $homeCountry
    # $startDate
    # $events
    # $founder

    /**
     * Mix constructor.
     *
     * @param string $mixName
     */
    public function __construct(string $mixName = "")
    {
        $this->id           = -1;
        $this->mixName      = $mixName;
        $this->creationDate = new \Datetime();
        $this->updateDate   = new \Datetime();
        $this->artists      = new ArrayCollection();
        $this->tracks       = new ArrayCollection();
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
     * @return Mix
     */
    public function setCreationDate(\DateTime $creationDate): Mix
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
     * @return Mix
     */
    public function setUpdateDate(\DateTime $updateDate): Mix
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * Get mixName
     *
     * @return string
     */
    public function getMixName() : string
    {
        return $this->mixName;
    }

    /**
     * Set mixName
     *
     * @param string $mixName
     *
     * @return Mix
     */
    public function setMixName(string $mixName) : Mix
    {
        $this->mixName = $mixName;

        return $this;
    }

    /**
     * Add artist
     *
     * @param \App\Entity\Artist $artist
     *
     * @return Mix
     */
    public function addArtist(Artist $artist): Mix
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
     * Add track
     *
     * @param \App\Entity\Track $track
     *
     * @return Mix
     */
    public function addTrack(Track $track) : Mix
    {
        $this->tracks[] = $track;

        return $this;
    }

    /**
     * Remove track
     *
     * @param \App\Entity\Track $track
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
    public function getTracks() : ArrayCollection
    {
        return $this->tracks;
    }
}
