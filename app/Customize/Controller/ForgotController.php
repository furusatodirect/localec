<?php

/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Customize\Controller;

use Eccube\Controller\ForgotController as BaseForgotController;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Eccube\Form\Type\Front\PasswordResetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception as HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;

class ForgotController extends BaseForgotController
{
    /**
     * パスワード再発行実行画面.
     * 有効期限切れ・無効URLの場合は404ではなく forgot へリダイレクトしてメッセージ表示.
     *
     * @Route("/forgot/reset/{reset_key}", name="forgot_reset", methods={"GET", "POST"})
     * @Template("Forgot/reset.twig")
     */
    public function reset(Request $request, $reset_key)
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw new HttpException\NotFoundHttpException();
        }

        $errors = $this->validator->validate(
            $reset_key,
            [
                new Assert\NotBlank(),
                new Assert\Regex(
                    [
                        'pattern' => '/^[a-zA-Z0-9]+$/',
                    ]
                ),
            ]
        );

        if (count($errors) > 0) {
            $this->addFlash('forgot_reset_error', trans('front.forgot.reset_error'));
            return $this->redirectToRoute('forgot');
        }

        $Customer = $this->customerRepository
            ->getRegularCustomerByResetKey($reset_key);

        if (null === $Customer) {
            $this->addFlash('forgot_reset_error', trans('front.forgot.reset_error'));
            return $this->redirectToRoute('forgot');
        }

        $builder = $this->formFactory
            ->createNamedBuilder('', PasswordResetType::class);

        $form = $builder->getForm();
        $form->handleRequest($request);
        $error = null;

        if ($form->isSubmitted() && $form->isValid()) {
            $Customer = $this->customerRepository
                ->getRegularCustomerByResetKey($reset_key, $form->get('login_email')->getData());
            if ($Customer) {
                $password = $this->passwordHasher->hashPassword($Customer, $form->get('password')->getData());
                $Customer->setPassword($password);
                $Customer->setResetKey(null);

                $this->entityManager->persist($Customer);
                $this->entityManager->flush();

                $event = new EventArgs(
                    [
                        'Customer' => $Customer,
                    ],
                    $request
                );
                $this->eventDispatcher->dispatch($event, EccubeEvents::FRONT_FORGOT_RESET_COMPLETE);

                $this->addFlash('password_reset_complete', trans('front.forgot.reset_complete'));
                return $this->redirectToRoute('mypage_login');
            } else {
                $error = trans('front.forgot.reset_not_found');
            }
        }

        return [
            'error' => $error,
            'form' => $form->createView(),
        ];
    }
}
