<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * ふるさと納税特集LP（4.1 より移植・4.3 最適化）
 */
class Lp_sb01PageController extends AbstractController
{
    /**
     * @Route("/lp_sb01", name="lp_sb01", methods={"GET"})
     * @Template("lp_sb01.twig")
     */
    public function index(Request $request)
    {
        return [];
    }
}