<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class DownloadUtil
 *
 * @package App\Entity
 *
 * @ORM\Entity(repositoryClass="App\Repository\DownloadUtilRepository")
 * @ORM\Table(name="download_util")
 * @ORM\HasLifecycleCallbacks()
 */
class DownloadUtil
{
    const YOUTUBE    = 1;
    const SOUNDCLOUD = 2;

    const YOUTUBE_URL = 1;

    const SOUNDCLOUD_LIKE     = 1;
    const SOUNDCLOUD_PLAYLIST = 2;


    private $arrayCmd = [
        self::YOUTUBE    => [
            // -u email -p password url
            1 => "youtube-dl --download-archive .downloaded --ignore-errors --geo-bypass --proxy \"\" --yes-playlist --embed-thumbnail -x --audio-format mp3 -o \"%(title)s.%(ext)s\" ",
        ],
        self::SOUNDCLOUD => [
            // -l url
            1 => "scdl -f -c --debug -l ",
            2 => "scdl -p -c --debug -l ",
        ]
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     nullable=false
     * )
     */
    private $name;

    /**
     * @var int
     * @ORM\Column(
     *     name="type",
     *     type="integer",
     *     nullable=false
     * )
     */
    private $type;

    /**
     * @var int
     * @ORM\Column(
     *     name="mode",
     *     type="integer",
     *     nullable=false
     * )
     */
    private $mode;

    /**
     * @var \App\Entity\User
     * @ORM\ManyToOne(
     *     targetEntity="App\Entity\User",
     *     inversedBy="downloadUtils"
     * )
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(
     *     name="urls",
     *     type="string",
     *     nullable=false
     * )
     */
    private $url;

    /**
     * @@var string
     * @ORM\Column(
     *     name="email",
     *     type="string",
     *     nullable=true
     * )
     */
    private $email;

    /**
     * @@var string
     * @ORM\Column(
     *     name="password",
     *     type="string",
     *     nullable=true
     * )
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(
     *     name="output",
     *     type="text",
     *     nullable=true
     * )
     */
    private $output;

    /**
     * @var \App\Entity\Playlist
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Playlist",
     *     cascade={"persist"}
     * )
     */
    private $playlist;

    /**
     * DownloadUtil constructor.
     *
     * @param string $name
     */
    public function __construct(string $name = "")
    {
        $this->name = $name;
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Return the cmd to run
     *
     * @return string
     */
    public function getCmd()
    {
        // (($this->email && $this->password) ? ' -u ' . $this->email . ' -p ' . $this->password : '')
        return $this->arrayCmd[$this->type][$this->mode] . $this->url;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return DownloadUtil
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param integer $type
     *
     * @return DownloadUtil
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set mode
     *
     * @param integer $mode
     *
     * @return DownloadUtil
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return integer
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return DownloadUtil
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return DownloadUtil
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return DownloadUtil
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set user
     *
     * @param \App\Entity\User $user
     *
     * @return DownloadUtil
     */
    public function setUser(\App\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set output
     *
     * @param string $output
     *
     * @return DownloadUtil
     */
    public function setOutput($output)
    {
        $this->output = $output;

        return $this;
    }

    /**
     * Get output
     *
     * @return string|null
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Set playlist
     *
     * @param \App\Entity\Playlist $playlist
     *
     * @return DownloadUtil
     */
    public function setPlaylist(\App\Entity\Playlist $playlist = null)
    {
        $playlist->setDownloadUtil($this);
        $this->playlist = $playlist;

        return $this;
    }

    /**
     * Get playlist
     *
     * @return \App\Entity\Playlist
     */
    public function getPlaylist()
    {
        return $this->playlist;
    }
}
