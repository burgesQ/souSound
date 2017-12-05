<?php

namespace App\DataFixtures\ORM;

use App\Entity\DownloadUtil;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDownloadUtils extends AbstractFixture
{
    /**
     * Array of the different utils.
     *
     * @var array
     */
    private $utilsArray = [
        1 => [
            "name"     => "youtube_like",
            "type"     => DownloadUtil::YOUTUBE,
            "url"      => "https://www.youtube.com/playlist?list=LL8BoiGKpm1cpDd_nvkMzdxw",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::YOUTUBE_URL
        ],
        2 => [
            "name"     => "soundcloud_like",
            "type"     => DownloadUtil::SOUNDCLOUD,
            "url"      => "https://www.soundcloud.com/letstayhigh",
            "username" => "",
            "password" => "",
            "mode"     => DownloadUtil::SOUNDCLOUD_LIKE
        ],
        3 => [
            "name"     => "soundcloud_playlist",
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
     */
    public function load(ObjectManager $em)
    {
        foreach ($this->utilsArray as $oneDlTools) {

            /** @var DownloadUtil $util */
            $util = new DownloadUtil($oneDlTools['name']);
            $util
                ->setType($oneDlTools['type'])
                ->setUrl($oneDlTools['url'])
                ->setMode($oneDlTools['mode']);
            $this->addReference($oneDlTools['name'], $util);
            $em->persist($util);

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