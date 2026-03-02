<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * お問い合わせメニュー（4.1 より移植・4.3 最適化）
 */
class ContactmenuPageController extends AbstractController
{
    /**
     * @Route("/contactmenu", name="contactmenu", methods={"GET"})
     * @Template("contactmenu.twig")
     */
    public function index(Request $request)
    {
        return [];
    }
}
