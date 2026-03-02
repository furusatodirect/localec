<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * 応援寄付ページ（4.1 より移植・4.3 最適化）
 */
class DonationPageController extends AbstractController
{
    /**
     * @Route("/donation", name="donation", methods={"GET"})
     * @Template("donation.twig")
     */
    public function index(Request $request)
    {
        return [];
    }
}