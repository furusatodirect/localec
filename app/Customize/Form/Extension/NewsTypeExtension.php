<?php

namespace Customize\Form\Extension;

use Eccube\Form\Type\Admin\NewsType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class NewsTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('np_thumbnail_data', FileType::class, [
            'label' => 'サムネイル画像',
            'required' => false,
            'eccube_form_options' => [
                'auto_render' => true,
            ],
            'mapped' => false,
        ]);

        $builder->add('np_thumbnail_url', HiddenType::class, [
            'required' => false,
            'eccube_form_options' => [
                'auto_render' => true,
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function getExtendedTypes(): iterable
    {
        yield NewsType::class;
    }
}
