<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class Lp_sb01PageController extends AbstractController
{
    /**
     * @Route("/lp_sb01", name="lp_sb01")
     * @Template("lp_sb01.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}