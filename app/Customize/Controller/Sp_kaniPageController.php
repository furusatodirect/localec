<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class Sp_kaniPageController extends AbstractController
{
    /**
     * @Route("/sp_kani", name="sp_kani")
     * @Template("sp_kani.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}