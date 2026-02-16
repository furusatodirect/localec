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

namespace Customize\Controller\Mypage;

use Eccube\Controller\AbstractController;
use Eccube\Event\EccubeEvents;
use Eccube\Event\EventArgs;
use Customize\Form\Type\Front\EntryType;
use Eccube\Repository\CustomerRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ChangeController extends AbstractController
{
    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var UserPasswordHasherInterface
     */
    protected $passwordHasher;

    public function __construct(
        CustomerRepository $customerRepository,
        UserPasswordHasherInterface $passwordHasher,
        TokenStorageInterface $tokenStorage
    ) {
        $this->customerRepository = $customerRepository;
        $this->passwordHasher = $passwordHasher;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * 会員情報編集画面.
     *
     * @Route("/mypage/change", name="mypage_change", methods={"GET", "POST"})
     * @Template("Mypage/change.twig")
     */
    public function index(Request $request)
    {
        $Customer = $this->getUser();
        $LoginCustomer = clone $Customer;
        $this->entityManager->detach($LoginCustomer);

        $previous_password = $Customer->getPassword();
        $Customer->setPlainPassword($this->eccubeConfig['eccube_default_password']);

        /* @var $builder \Symfony\Component\Form\FormBuilderInterface */
        $builder = $this->formFactory->createBuilder(EntryType::class, $Customer);

        $event = new EventArgs(
            [
                'builder' => $builder,
                'Customer' => $Customer,
            ],
            $request
        );
        $this->eventDispatcher->dispatch($event, EccubeEvents::FRONT_MYPAGE_CHANGE_INDEX_INITIALIZE);

        /* @var $form \Symfony\Component\Form\FormInterface */
        $form = $builder->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            log_info('会員編集開始');

            // plain_password: 空・null・デフォルト(マスク値)なら変更なし、それ以外ならハッシュ化して設定
            $plainPassword = $Customer->getPlainPassword();
            if ($plainPassword !== '' && $plainPassword !== null && $plainPassword !== $this->eccubeConfig['eccube_default_password']) {
                $Customer->setPassword(
                    $this->passwordHasher->hashPassword($Customer, $Customer->getPlainPassword())
                );
            } else {
                $Customer->setPassword($previous_password);
            }

            // フォーム由来のSex/Job/Prefをマネージド実体に差し替え（flush用）
            if ($Customer->getSex()) {
                $Sex = $this->entityManager->getRepository('Eccube\Entity\Master\Sex')->find($Customer->getSex()->getId());
                if ($Sex) {
                    $Customer->setSex($Sex);
                }
            }
            if ($Customer->getJob()) {
                $Job = $this->entityManager->getRepository('Eccube\Entity\Master\Job')->find($Customer->getJob()->getId());
                if ($Job) {
                    $Customer->setJob($Job);
                }
            }
            if ($Customer->getPref()) {
                $Pref = $this->entityManager->getRepository('Eccube\Entity\Master\Pref')->find($Customer->getPref()->getId());
                if ($Pref) {
                    $Customer->setPref($Pref);
                }
            }
            if ($Customer->getMailMagazine() === null) {
                $Customer->setMailMagazine(false);
            }

            $this->entityManager->flush($Customer);

            log_info('会員編集完了');

            $event = new EventArgs(
                [
                    'form' => $form,
                    'Customer' => $Customer,
                ],
                $request
            );
            $this->eventDispatcher->dispatch($event, EccubeEvents::FRONT_MYPAGE_CHANGE_INDEX_COMPLETE);

            return $this->redirect($this->generateUrl('mypage_change_complete'));
        }

        $this->tokenStorage->getToken()->setUser($LoginCustomer);

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * 会員情報編集完了画面.
     *
     * @Route("/mypage/change_complete", name="mypage_change_complete", methods={"GET"})
     * @Template("Mypage/change_complete.twig")
     */
    public function complete(Request $request)
    {
        return [];
    }
}
