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

namespace Customize\Form\Type;

use Doctrine\ORM\EntityManagerInterface;
use Eccube\Entity\Master\ProductListMax;
use Eccube\Entity\Master\ProductListOrderBy;
use Eccube\Form\Type\Master\ProductListMaxType;
use Eccube\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProductType extends AbstractType
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    public function __construct(CategoryRepository $categoryRepository, EntityManagerInterface $entityManager)
    {
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $Categories = $this->categoryRepository
            ->getList(null, true);

        $ProductListOrderByRepo = $this->entityManager->getRepository(ProductListOrderBy::class);
        $ProductListOrderBys = $ProductListOrderByRepo->findBy([], ['sort_no' => 'ASC']);

        $ProductListMaxRepo = $this->entityManager->getRepository(ProductListMax::class);
        $ProductListMaxs = $ProductListMaxRepo->findBy([], ['sort_no' => 'ASC']);

        $builder->add('mode', HiddenType::class, [
            'data' => 'search',
        ]);
        $builder->add('category_id', EntityType::class, [
            'class' => 'Eccube\Entity\Category',
            'choice_label' => 'NameWithLevel',
            'choices' => $Categories,
            'placeholder' => 'common.select__all_products',
            'required' => false,
        ]);
        // todo multiple category search
        $builder->add('category_ids', EntityType::class, [
            'class' => 'Eccube\Entity\Category',
            'multiple' => true,
            'choices' => $Categories,
            'required' => false,
            'expanded' => false,
        ]);
        $builder->add('name', SearchType::class, [
            'required' => false,
            'attr' => [
                'maxlength' => 50,
            ],
        ]);
        $builder->add('min_price', HiddenType::class);
        $builder->add('max_price', HiddenType::class);
        $builder->add('operator_name', HiddenType::class);
        $builder->add('pageno', HiddenType::class, []);
        $builder->add('disp_number', ProductListMaxType::class, [
            'label' => false,
            'choices' => $ProductListMaxs,
        ]);
        // 4.3対応: ProductListOrderByType(MasterType/ChoiceLoader)はGETの整数値をobject期待のIdReaderに渡してエラーになるため、EntityTypeで明示的choicesを使用
        $builder->add('orderby', EntityType::class, [
            'class' => ProductListOrderBy::class,
            'choice_label' => 'name',
            'choices' => $ProductListOrderBys,
            'placeholder' => false,
            'required' => false,
            'label' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'search_product';
    }
}
