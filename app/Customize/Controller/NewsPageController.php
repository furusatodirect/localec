<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Eccube\Entity\News;
use Eccube\Repository\NewsRepository;
use Eccube\Repository\PageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class NewsPageController extends AbstractController
{
    /**
     * @var NewsRepository
     */
    private $newsRepository;

    /**
     * @var PageRepository
     */
    private $pageRepository;

    public function __construct(NewsRepository $newsRepository, PageRepository $pageRepository)
    {
        $this->newsRepository = $newsRepository;
        $this->pageRepository = $pageRepository;
    }

    /**
     * 新着情報一覧
     *
     * @Route("/news", name="news_index", methods={"GET"})
     * @Route("/news/page/{page_no}", requirements={"page_no" = "\d+"}, name="news_index_page", methods={"GET"})
     * @Template("News/index.twig")
     */
    public function index(Request $request, PaginatorInterface $paginator, int $page_no = 1): array
    {
        $qb = $this->newsRepository->createQueryBuilder('n')
            ->where('n.publish_date <= :now')
            ->andWhere('n.visible = :visible')
            ->setParameter('now', new \DateTime())
            ->setParameter('visible', true)
            ->orderBy('n.publish_date', 'DESC')
            ->addOrderBy('n.id', 'DESC');

        $pagination = $paginator->paginate(
            $qb,
            $page_no,
            $this->eccubeConfig->get('eccube_default_page_count')
        );

        $route = $request->attributes->get('_route', 'news_index');
        $Page = $this->pageRepository->getPageByRoute($route);
        $Layout = $Page->getLayouts()[0] ?? null;
        if ($Layout === null) {
            $fallback = $this->pageRepository->getPageByRoute('homepage');
            $Layout = $fallback->getLayouts()[0] ?? null;
        }

        return [
            'pagination' => $pagination,
            'Page' => $Page,
            'Layout' => $Layout,
        ];
    }

    /**
     * 新着情報詳細
     *
     * @Route("/news/{id}", requirements={"id" = "\d+"}, name="news_detail", methods={"GET"})
     * @Template("News/detail.twig")
     */
    public function detail(Request $request, int $id): array
    {
        $News = $this->newsRepository->find($id);
        if (!$News) {
            throw new NotFoundHttpException();
        }
        if (!$News->isVisible()) {
            throw new NotFoundHttpException();
        }
        if ($News->getPublishDate() && $News->getPublishDate() > new \DateTime()) {
            throw new NotFoundHttpException();
        }

        $route = $request->attributes->get('_route', 'news_detail');
        $Page = $this->pageRepository->getPageByRoute($route);
        $Layout = $Page->getLayouts()[0] ?? null;
        if ($Layout === null) {
            $fallback = $this->pageRepository->getPageByRoute('homepage');
            $Layout = $fallback->getLayouts()[0] ?? null;
        }

        return [
            'news' => $News,
            'Page' => $Page,
            'Layout' => $Layout,
        ];
    }
}
