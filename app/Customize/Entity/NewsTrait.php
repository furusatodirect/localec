<?php

namespace Customize\Entity;

use Doctrine\ORM\Mapping as ORM;
use Eccube\Annotation as Eccube;

/**
 * @Eccube\EntityExtension("Eccube\Entity\News")
 */
trait NewsTrait
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="np_thumbnail_url", type="string", length=255, nullable=true)
     */
    private $np_thumbnail_url;

    /**
     * @return string|null
     */
    public function getNpThumbnailUrl()
    {
        return $this->np_thumbnail_url;
    }

    /**
     * @param string|null $np_thumbnail_url
     *
     * @return $this
     */
    public function setNpThumbnailUrl($np_thumbnail_url = null)
    {
        $this->np_thumbnail_url = $np_thumbnail_url;

        return $this;
    }
}
