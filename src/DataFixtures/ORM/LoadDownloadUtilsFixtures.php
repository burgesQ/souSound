<?php

namespace App\DataFixtures\ORM;

use App\Entity\Playlist;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\DownloadUtil;

class LoadDownloadUtilsFixtures extends AbstractFixture
{
    private $arrayType = [
        1 => 'youtube',
        2 => 'soundcloud'
    ];

    /**
     * Array of the different utils.
     *
     * @var array
     */
    private $utilsArray = [
        1 => [
            "name" => "youtube_like_1",
            "type"     => DownloadUtil::YOUTUBE,
            "url"      => "https://www.youtube.com/playlist?list=LL8BoiGKpm1cpDd_nvkMzdxw",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::YOUTUBE_URL
        ],
        2 => [
            "name"     => "soundcloud_like_1",
            "type"     => DownloadUtil::SOUNDCLOUD,
            "url"      => "https://www.soundcloud.com/letstayhigh",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::SOUNDCLOUD_LIKE
        ],
        3 => [
            "name"     => "soundcloud_playlist_1",
            "type"     => DownloadUtil::SOUNDCLOUD,
            "url"      => "https://www.soundcloud.com/letstayhigh",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::SOUNDCLOUD_PLAYLIST
        ],
        4 => [
            "name"     => "youtube_like_2",
            "type"     => DownloadUtil::YOUTUBE,
            "url"      => "https://www.youtube.com/channel/UC744F6lEVXqb1_-FeqCIdfg/videos?view=15&sort=dd&shelf_id=0",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::YOUTUBE_URL
        ],
        5 => [
            "name"     => "soundcloud_like_2",
            "type"     => DownloadUtil::SOUNDCLOUD,
            "url"      => "https://www.soundcloud.com/nicolasbtn",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::SOUNDCLOUD_LIKE
        ],
        6 => [
            "name"     => "soundcloud_playlist_2",
            "type"     => DownloadUtil::SOUNDCLOUD,
            "url"      => "https://www.soundcloud.com/nicolasbtn",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::SOUNDCLOUD_PLAYLIST
        ]

    ];

    /**
     * Load user according to the userArray.
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $em
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $em)
    {
        foreach ($this->utilsArray as $utilData) {

            /** @var DownloadUtil $util */
            $util = new DownloadUtil($utilData['name']);
            $util
                ->setType($utilData['type'])
                ->setUrl($utilData['url'])
                ->setMode($utilData['mode']);
            $this->addReference($utilData['name'], $util);
            $em->persist($util);

            $playlist = new Playlist($this->arrayType[$utilData['type']] . '_user_');
            $em->persist($playlist);
            $util->setPlaylist($playlist);

        }
        $em->flush();
    }

    /**
     * Loading order of the fixture.
     *
     * @return int
     */
    function getOrder()
    {
        return 1;
    }
}