<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Users implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\OneToMany(targetEntity=AnalysisType::class, mappedBy="users")
     */
    private $analysistypes;

    /**
     * @ORM\OneToMany(targetEntity=Patients::class, mappedBy="users")
     */
    private $patients;

    /**
     * @ORM\OneToMany(targetEntity=Payments::class, mappedBy="users")
     */
    private $payments;

    /**
     * @ORM\OneToMany(targetEntity=Reports::class, mappedBy="users")
     */
    private $reports;

    /**
     * @ORM\OneToMany(targetEntity=Results::class, mappedBy="users")
     */
    private $results;

    public function __construct()
    {
        $this->analysistypes = new ArrayCollection();
        $this->patients = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->reports = new ArrayCollection();
        $this->results = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection|AnalysisType[]
     */
    public function getAnalysistypes(): Collection
    {
        return $this->analysistypes;
    }

    public function addAnalysistype(AnalysisType $analysistype): self
    {
        if (!$this->analysistypes->contains($analysistype)) {
            $this->analysistypes[] = $analysistype;
            $analysistype->setUsers($this);
        }

        return $this;
    }

    public function removeAnalysistype(AnalysisType $analysistype): self
    {
        if ($this->analysistypes->contains($analysistype)) {
            $this->analysistypes->removeElement($analysistype);
            // set the owning side to null (unless already changed)
            if ($analysistype->getUsers() === $this) {
                $analysistype->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Patients[]
     */
    public function getPatients(): Collection
    {
        return $this->patients;
    }

    public function addPatient(Patients $patient): self
    {
        if (!$this->patients->contains($patient)) {
            $this->patients[] = $patient;
            $patient->setUsers($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): self
    {
        if ($this->patients->contains($patient)) {
            $this->patients->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getUsers() === $this) {
                $patient->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Payments[]
     */
    public function getPayments(): Collection
    {
        return $this->payments;
    }

    public function addPayment(Payments $payment): self
    {
        if (!$this->payments->contains($payment)) {
            $this->payments[] = $payment;
            $payment->setUsers($this);
        }

        return $this;
    }

    public function removePayment(Payments $payment): self
    {
        if ($this->payments->contains($payment)) {
            $this->payments->removeElement($payment);
            // set the owning side to null (unless already changed)
            if ($payment->getUsers() === $this) {
                $payment->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reports[]
     */
    public function getReports(): Collection
    {
        return $this->reports;
    }

    public function addReport(Reports $report): self
    {
        if (!$this->reports->contains($report)) {
            $this->reports[] = $report;
            $report->setUsers($this);
        }

        return $this;
    }

    public function removeReport(Reports $report): self
    {
        if ($this->reports->contains($report)) {
            $this->reports->removeElement($report);
            // set the owning side to null (unless already changed)
            if ($report->getUsers() === $this) {
                $report->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Results[]
     */
    public function getResults(): Collection
    {
        return $this->results;
    }

    public function addResult(Results $result): self
    {
        if (!$this->results->contains($result)) {
            $this->results[] = $result;
            $result->setUsers($this);
        }

        return $this;
    }

    public function removeResult(Results $result): self
    {
        if ($this->results->contains($result)) {
            $this->results->removeElement($result);
            // set the owning side to null (unless already changed)
            if ($result->getUsers() === $this) {
                $result->setUsers(null);
            }
        }

        return $this;
    }
}
