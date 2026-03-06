<?php

namespace Customize\EventSubscriber;

use Eccube\Common\EccubeConfig;
use Eccube\Entity\News;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Repository\NewsRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class NewsEditEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var EccubeConfig
     */
    private $eccubeConfig;

    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(EccubeConfig $eccubeConfig, NewsRepository $newsRepository)
    {
        $this->eccubeConfig = $eccubeConfig;
        $this->newsRepository = $newsRepository;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            EccubeEvents::ADMIN_CONTENT_NEWS_EDIT_COMPLETE => 'onNewsEditComplete',
        ];
    }

    /**
     * サムネイル画像アップロード処理
     */
    public function onNewsEditComplete(EventArgs $event): void
    {
        $form = $event->getArgument('form');
        /** @var News $News */
        $News = $event->getArgument('News');

        if (!method_exists($News, 'setNpThumbnailUrl')) {
            return;
        }

        /** @var UploadedFile|null $thumbnailFile */
        $thumbnailFile = $form->get('np_thumbnail_data')->getData();
        if ($thumbnailFile instanceof UploadedFile && $thumbnailFile->isValid()) {
            $extension = $thumbnailFile->getClientOriginalExtension() ?: 'jpg';
            $filename = date('mdHis') . uniqid('_') . '.' . $extension;
            $saveDir = $this->eccubeConfig->get('eccube_save_image_dir');
            $thumbnailFile->move($saveDir, $filename);
            $News->setNpThumbnailUrl($filename);
            $this->newsRepository->save($News);
        }
    }
}
