<?php
/**
 * Created by PhpStorm.
 * User: Olf
 * Date: 12.01.2018
 * Time: 20:25
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class Order
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var User|null
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user_id", nullable=true, onDelete="CASCADE")
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $count;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal", precision=20, scale=2)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, options={"default": ""})
     * @Assert\NotBlank(groups={"completeOrder"})
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     * Assert\NotBlank(groups={"completeOrder"})
     * @Assert\Regex("/^\+?[ -\(\)\d]+$/", groups={"completeOrder"})
     * @Assert\Length(min=10,
     *     minMessage="Введите номер с кодом города или оператора",
     *     groups={"completeOrder"}
     *     )
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     * Assert\NotBlank(groups={"completeOrder"})
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * Assert\NotBlank(groups={"completeOrder"})
     */
    private $adress;

    const STATUS_DRAFT = 0;
    const STATUS_ORDERED = 1;
    const STATUS_SENT = 2;
    const STATUS_RECEIVED = 3;
    const STATUS_COMPLETED = 4;

    static public $statuses = [
        self::STATUS_DRAFT => 'draft',
        self::STATUS_ORDERED => 'ordered',
        self::STATUS_SENT => 'sent',
        self::STATUS_RECEIVED => 'received',
        self::STATUS_COMPLETED => 'completed',
        ];

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    private $isPaid;

    /**
     * @var OrderItem[]|Collection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="order")
     */
    private $items;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->count = 0;
        $this->amount = 0;
        $this->customerName = '';
        $this->phone = '';
        $this->email = '';
        $this->status = self::STATUS_DRAFT;
        $this->isPaid = false;
        $this->items = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return Order
     */
    public function setUser(?User $user): Order
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     * @return Order
     */
    public function setCreatedAt(\DateTime $createdAt): Order
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return Order
     */
    public function setCount(int $count): Order
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return Order
     */
    public function setAmount(float $amount): Order
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCustomerName(): string
    {
        return $this->customerName;
    }

    /**
     * @param string $customerName
     * @return Order
     */
    public function setCustomerName(string $customerName): Order
    {
        $this->customerName = $customerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return Order
     */
    public function setPhone(string $phone): Order
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Order
     */
    public function setEmail(string $email): Order
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param null|string $adress
     * @return Order
     */
    public function setAdress(?string $adress): Order
    {
        $this->adress = $adress;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    public function getStatusLabel(): string
    {
        return self::$statuses[$this->status];
    }

    /**
     * @param int $status
     * @return Order
     */
    public function setStatus(int $status): Order
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return bool
     */
    public function isPaid(): bool
    {
        return $this->isPaid;
    }

    /**
     * @param bool $isPaid
     * @return Order
     */
    public function setIsPaid(bool $isPaid): Order
    {
        $this->isPaid = $isPaid;
        return $this;
    }

    /**
     * @return OrderItem[]|ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param OrderItem[]|ArrayCollection $items
     * @return Order
     */
    public function setItems($items): Collection
    {
        return $this->$items;
    }

    /**
     * @return OrderItem[]|ArrayCollection
     */
    public function getItem(): ArrayCollection
    {
        return $this->items;
    }

    /**
     * @param OrderItem $item
     * @return $this
     */
    public function addItems(OrderItem $item)
    {
        $this->items->add($item);
        $item->setOrder($this);
        $this->recalculateItems();

        return $this;
    }

    /**
     * @param OrderItem $item
     * @return $this
     */
    public function removeElement(OrderItem $item)
    {
        $this->items-removeItems($item);
        $this->recalculateItems();

        return $this;
    }

    public function recalculateItems()
    {
        $this->count = 0;
        $this->amount = 0;

        foreach ($this->items as $item){
            $this->count += $item->getCount();
            $this->amount += $item->getAmount();
        }
    }
}