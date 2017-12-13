<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrackMetadataRepository")
 */
class TrackMetadata
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \App\Entity\Track
     * @ORM\OneToOne(
     *     targetEntity="App\Entity\Track",
     *     cascade={"persist"}
     * )
     */
    private $track;

    /**
     * @var string
     * @ORM\Column(
     *     name="file_name",
     *     type="string",
     *     nullable=false,
     *     unique=true
     * )
     */
    private $fileName;

    /**
     * @var string
     * @ORM\Column(
     *     name="file_location",
     *     type="string",
     *     nullable=false,
     * )
     */
    private $fileLocation;

    /**
     * @var string
     * @ORM\Column(
     *     name="base_path",
     *     type="string",
     *     nullable=false,
     * )
     */
    private $basePath;

    /**
     * Track constructor.
     *
     * @param string $fileName
     * @param string $path
     * @param string $basePath
     */
    public function __construct(string $fileName = "", string $path, string $basePath)
    {
        $this->fileLocation = $path;
        $this->fileName     = $fileName;
        $this->basePath     = $basePath;
    }

    /**
     * Return absolute path of a track on the server.
     *
     * @return string
     */
    public function getTrackFullPath() : string
    {
        return $this->fileLocation . '/../' . $this->basePath . $this->fileName;
    }

    /**
     * Return url path of a track.
     *
     * @return string
     */
    public function getTrackPath() : string
    {
        return  $this->basePath . $this->fileName;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return \App\Entity\Track
     */
    public function getTrack(): Track
    {
        return $this->track;
    }

    /**
     * Set Track
     *
     * @param \App\Entity\Track $track
     *
     * @return TrackMetadata
     */
    public function setTrack(\App\Entity\Track $track): TrackMetadata
    {
        $this->track = $track;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return TrackMetadata
     */
    public function setFileName(string $fileName): TrackMetadata
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileLocation(): string
    {
        return $this->fileLocation;
    }

    /**
     * @param string $fileLocation
     * @return TrackMetadata
     */
    public function setFileLocation(string $fileLocation): TrackMetadata
    {
        $this->fileLocation = $fileLocation;

        return $this;
    }

    /**
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     *
     * @return \App\Entity\TrackMetadata
     */
    public function setBasePath(string $basePath): TrackMetadata
    {
        $this->basePath = $basePath;

        return $this;
    }
}
