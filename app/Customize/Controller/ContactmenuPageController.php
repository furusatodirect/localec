<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class ContactmenuPageController extends AbstractController
{
    /**
     * @Route("/contactmenu", name="contactmenu")
     * @Template("contactmenu.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}
