<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 08.01.2018
 * Time: 17:04
 */

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Vich\UploaderBundle\Form\Type\VichImageType;
class ProductAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isTop')
            ->add('imageFile', VichImageType::class, ['required' => false])
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isTop')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('category')
            ->addIdentifier('name')
            ->addIdentifier('price')
            ->add('isTop')
        ;
    }
}