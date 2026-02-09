<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class LpPageController extends AbstractController
{
    /**
     * @Route("/lp", name="lp")
     * @Template("lp.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}