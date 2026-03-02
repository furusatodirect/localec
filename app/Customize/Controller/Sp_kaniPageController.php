<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * カニ特集ページ（4.1 より移植・4.3 最適化）
 */
class Sp_kaniPageController extends AbstractController
{
    /**
     * @Route("/sp_kani", name="sp_kani", methods={"GET"})
     * @Template("sp_kani.twig")
     */
    public function index(Request $request)
    {
        return [];
    }
}