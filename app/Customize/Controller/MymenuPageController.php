<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * マイメニューページ（4.1 より移植・4.3 最適化）
 */
class MymenuPageController extends AbstractController
{
    /**
     * @Route("/mymenu", name="mymenu", methods={"GET"})
     * @Template("mymenu.twig")
     */
    public function index(Request $request)
    {
        return [];
    }
}