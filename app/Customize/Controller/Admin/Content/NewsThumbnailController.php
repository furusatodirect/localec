<?php

namespace Customize\Controller\Admin\Content;

use Eccube\Controller\AbstractController;
use Eccube\Entity\News;
use Eccube\Repository\NewsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class NewsThumbnailController extends AbstractController
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    /**
     * サムネイル画像をその場で削除
     *
     * @Route("/%eccube_admin_route%/content/news/{id}/thumbnail/delete", requirements={"id" = "\d+"}, name="admin_content_news_thumbnail_delete", methods={"POST"})
     * @ParamConverter("News", options={"id" = "id"})
     */
    public function deleteThumbnail(News $News): RedirectResponse
    {
        $this->isTokenValid();

        if (method_exists($News, 'setNpThumbnailUrl')) {
            $News->setNpThumbnailUrl(null);
            $this->newsRepository->save($News);
            $this->addSuccess('サムネイル画像を削除しました。', 'admin');
        }

        return $this->redirectToRoute('admin_content_news_edit', ['id' => $News->getId()]);
    }
}
