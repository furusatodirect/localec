<?php

namespace Customize\Controller;

use Eccube\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * マイメニューページ（4.3版）
 */
class MymenuPageController extends AbstractController
{
    /**
     * @Route("/mymenu", name="mymenu", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->render('mymenu.twig', []);
    }
}