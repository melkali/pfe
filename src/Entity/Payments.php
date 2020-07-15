<?php

namespace App\Entity;

use App\Repository\PaymentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PaymentsRepository::class)
 */
class Payments
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_payment;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $sum;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content_payment;

    /**
     * @ORM\OneToOne(targetEntity=Patients::class, mappedBy="payment_sum", cascade={"persist", "remove"})
     */
    private $patients;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="payments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePayment(): ?string
    {
        return $this->name_payment;
    }

    public function setNamePayment(string $name_payment): self
    {
        $this->name_payment = $name_payment;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSum(): ?int
    {
        return $this->sum;
    }

    public function setSum(int $sum): self
    {
        $this->sum = $sum;

        return $this;
    }

    public function getContentPayment(): ?string
    {
        return $this->content_payment;
    }

    public function setContentPayment(string $content_payment): self
    {
        $this->content_payment = $content_payment;

        return $this;
    }

    public function getPatients(): ?Patients
    {
        return $this->patients;
    }

    public function setPatients(?Patients $patients): self
    {
        $this->patients = $patients;

        // set (or unset) the owning side of the relation if necessary
        $newPayment_sum = null === $patients ? null : $this;
        if ($patients->getPaymentSum() !== $newPayment_sum) {
            $patients->setPaymentSum($newPayment_sum);
        }

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }
}
