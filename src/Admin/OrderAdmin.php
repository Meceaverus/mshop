<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 23.01.2018
 * Time: 19:16
 */

namespace App\Admin;

use App\Entity\Order;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\DoctrineORMAdminBundle\Filter\ChoiceFilter;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class OrderAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('user')
            ->add('createdAt')
            ->add('customerName')
            ->add('phone')
            ->add('email')
            ->add('adress')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'draft' => Order::STATUS_DRAFT,
                    'ordered' => Order::STATUS_ORDERED,
                    'sent' => Order::STATUS_SENT,
                    'received' => Order::STATUS_RECEIVED,
                    'completed' => Order::STATUS_COMPLETED,
                ]
            ])
            ->add('isPaid')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('user')
            ->add('createdAt')
            ->add('count')
            ->add('amount')
            ->add('customerName')
            ->add('phone')
            ->add('email')
            ->add('adress')
            ->add('status', null, [], ChoiceType::class, [
                'choices' => [
                    'draft' => Order::STATUS_DRAFT,
                    'ordered' => Order::STATUS_ORDERED,
                    'sent' => Order::STATUS_SENT,
                    'received' => Order::STATUS_RECEIVED,
                    'completed' => Order::STATUS_COMPLETED,
                ],
            ])
            ->add('isPaid')
        ;
    }
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('user')
            ->addIdentifier('createdAt')
            ->addIdentifier('count')
            ->addIdentifier('amount')
            ->addIdentifier('customerName')
            ->addIdentifier('phone')
            ->addIdentifier('email')
            ->addIdentifier('adress')
            ->add('status', 'choice', [
                'editable' => true,
                'choices' => [
                    Order::STATUS_DRAFT => 'draft',
                    Order::STATUS_ORDERED => 'ordered',
                    Order::STATUS_SENT => 'sent',
                    Order::STATUS_RECEIVED => 'received',
                    Order::STATUS_COMPLETED => 'completed',
                ],
                'catalogue' => 'messages',
            ])
            ->add('isPaid', null, ['editable' => true])
        ;
    }
    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }
        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');
        if ($this->isGranted('EDIT')) {
            $menu->addChild('Edit Order', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }
        if ($this->isGranted('LIST')) {
            $menu->addChild('Manage Items', [
                'uri' => $admin->generateUrl('admin.order_item.list', ['id' => $id])
            ]);
        }
    }
}