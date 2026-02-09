<?php

namespace Customize\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Eccube\Controller\AbstractController;

class DonationPageController extends AbstractController
{
    /**
     * @Route("/donation", name="donation")
     * @Template("donation.twig")
     */
    public function index(Request $request)
    {
            return [];
    }
}