<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern="/^(?=.*[a-z])/",
     *     message="password.lowercase"
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*[A-Z])/",
     *     message="password.uppercase"
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*\d)/",
     *     message="password.number"
     * )
     * @Assert\Regex(
     *     pattern="/^(?=.*\W)/",
     *     message="password.exotic"
     * )
     * @Assert\NotBlank()
     * @Assert\Length(min=8)
     */
    protected $plainPassword;

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
     * @var string
     * @ORM\Column(
     *     name="first_name",
     *     type="string",
     *     nullable=false
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="first_name.number_in_name"
     * )
     * @Assert\Regex(
     *     pattern="/\W/",
     *     match=false,
     *     message="first_name.exotic"
     * )
     */
    private $firstName;

    /**
     * @var string
     * @ORM\Column(
     *     name="last_name",
     *     type="string",
     *     nullable=false
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="last_name.number_in_name"
     * )
     * @Assert\Regex(
     *     pattern="/\W/",
     *     match=false,
     *     message="last_name.exotic"
     * )
     */
    private $lastName;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\Playlist",
     *     mappedBy="owner",
     *     cascade={"persist"}
     * )
     */
    private $playlists;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(
     *     targetEntity="App\Entity\DownloadUtil",
     *     mappedBy="user"
     * )
     */
    private $downloadUtils;

    /**
     * User constructor.
     *
     * @param string $fName
     * @param string $lName
     */
    public function __construct(string $fName = "", string $lName = "")
    {
        parent::__construct();

        $this->firstName     = $fName;
        $this->lastName      = $lName;
        $this->creationDate  = new \Datetime();
        $this->updateDate    = new \Datetime();
        $this->playlists     = new ArrayCollection();
        $this->downloadUtils = new ArrayCollection();
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
     * get Id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email): User
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    /**
     * Get UpdateDate
     *
     * @return \DateTime
     */
    public function getUpdateDate(): \DateTime
    {
        return $this->updateDate;
    }

    /**
     * SEt UpdateDate
     *
     * @param \DateTime $updateDate
     *
     * @return User
     */
    public function setUpdateDate(\DateTime $updateDate): User
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    /**
     * get FirstName
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Set FirstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * get LastName
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Set LastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): User
    {
        $this->lastName = $lastName;

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
     * @return User
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Add playlist.
     *
     * @param \App\Entity\Playlist $playlist
     *
     * @return User
     */
    public function addPlaylist(\App\Entity\Playlist $playlist)
    {
        $playlist->setOwner($this);
        $this->playlists[] = $playlist;

        return $this;
    }

    /**
     * Remove playlist.
     *
     * @param \App\Entity\Playlist $playlist
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removePlaylist(\App\Entity\Playlist $playlist)
    {
        return $this->playlists->removeElement($playlist);
    }

    /**
     * Get playlists.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }

    /**
     * Add downloadUtil
     *
     * @param \App\Entity\DownloadUtil $downloadUtil
     *
     * @return User
     */
    public function addDownloadUtil(\App\Entity\DownloadUtil $downloadUtil)
    {
        $this->downloadUtils[] = $downloadUtil;
        $downloadUtil->setUser($this);

        return $this;
    }

    /**
     * Remove downloadUtil
     *
     * @param \App\Entity\DownloadUtil $downloadUtil
     */
    public function removeDownloadUtil(\App\Entity\DownloadUtil $downloadUtil)
    {
        $this->downloadUtils->removeElement($downloadUtil);
        $downloadUtil->setUser(null);
    }

    /**
     * Get downloadUtils
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDownloadUtils()
    {
        return $this->downloadUtils;
    }
}
