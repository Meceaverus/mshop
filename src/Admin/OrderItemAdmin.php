<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 24.01.2018
 * Time: 14:46
 */

namespace App\Admin;

use App\Entity\Order;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\Filter\ChoiceType;

class OrderItemAdmin extends AbstractAdmin
{
    public function getParentAssociationMapping()
    {
        return 'order';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('product')
            ->add('count')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product')
            ->add('count')
            ->add('amount')
            ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('product')
            ->add('count')
            ->add('amount')
        ;
    }
}