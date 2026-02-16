<?php

namespace Customize\Form\Extension;

use Eccube\Form\Type\Front\NonMemberType;
use Eccube\Form\Type\Master\SexType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints as Assert;

class NonMemberTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // ルートの data が null のとき配列にしておく（handleRequest で配列アクセスエラーを防ぐ）
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function ($event) {
            if ($event->getData() === null) {
                $event->setData([]);
            }
        });

        $builder
            ->add('birth', BirthdayType::class, [
                'required' => true,
                'input' => 'datetime',
                'years' => range(date('Y'), date('Y') - 100),
                'widget' => 'choice',
                'placeholder' => ['year' => '----', 'month' => '--', 'day' => '--'],
                'empty_data' => null,
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\LessThanOrEqual([
                        'value' => new \DateTime('-1 day'),
                        'message' => 'form_error.select_is_future_or_now_date',
                    ]),
                ],
            ])
            ->add('sex', SexType::class, [
                'required' => false,
                'placeholder' => false,
                'empty_data' => null,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ])
            ->add('user_policy_check', CheckboxType::class, [
                'required' => true,
                'label' => null,
                'mapped' => false,
                'constraints' => [
                    new Assert\NotBlank(),
                ],
            ]);
    }

    public static function getExtendedTypes(): iterable
    {
        yield NonMemberType::class;
    }
}
