<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class MymenuPageController extends AbstractController
{
    /**
     * @Route("/mymenu", name="mymenu")
     * @Template("mymenu.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}