<?php

namespace App\Entity;

use App\Repository\PatientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PatientsRepository::class)
 */
class Patients
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
    private $name_patient;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname_patient;

    /**
     * @ORM\Column(type="integer")
     */
    private $phone;

    /**
     * @ORM\Column(type="date")
     */
    private $date_birth;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $doctor;

    /**
     * @ORM\OneToOne(targetEntity=Payments::class, inversedBy="patients", cascade={"persist", "remove"})
     */
    private $payment_sum;

    /**
     * @ORM\OneToOne(targetEntity=Reports::class, inversedBy="patients", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $report_patient;

    /**
     * @ORM\OneToOne(targetEntity=Results::class, inversedBy="patients", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $result_patient;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="patients")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=AnalysisCategories::class, mappedBy="patients")
     */
    private $analysiscategorie;

    /**
     * @ORM\ManyToOne(targetEntity=Room::class, inversedBy="patients")
     */
    private $room;

    public function __construct()
    {
        $this->analysis_type = new ArrayCollection();
        $this->analysiscategorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePatient(): ?string
    {
        return $this->name_patient;
    }

    public function setNamePatient(string $name_patient): self
    {
        $this->name_patient = $name_patient;

        return $this;
    }

    public function getFirstnamePatient(): ?string
    {
        return $this->firstname_patient;
    }

    public function setFirstnamePatient(string $firstname_patient): self
    {
        $this->firstname_patient = $firstname_patient;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDateBirth(): ?\DateTimeInterface
    {
        return $this->date_birth;
    }

    public function setDateBirth(\DateTimeInterface $date_birth): self
    {
        $this->date_birth = $date_birth;

        return $this;
    }

    public function getDoctor(): ?string
    {
        return $this->doctor;
    }

    public function setDoctor(string $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getPaymentSum(): ?Payments
    {
        return $this->payment_sum;
    }

    public function setPaymentSum(?Payments $payment_sum): self
    {
        $this->payment_sum = $payment_sum;

        return $this;
    }

    public function getReportPatient(): ?Reports
    {
        return $this->report_patient;
    }

    public function setReportPatient(Reports $report_patient): self
    {
        $this->report_patient = $report_patient;

        return $this;
    }

    public function getResultPatient(): ?Results
    {
        return $this->result_patient;
    }

    public function setResultPatient(Results $result_patient): self
    {
        $this->result_patient = $result_patient;

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

    /**
     * @return Collection|AnalysisCategories[]
     */
    public function getAnalysiscategorie(): Collection
    {
        return $this->analysiscategorie;
    }

    public function addAnalysiscategorie(AnalysisCategories $analysiscategorie): self
    {
        if (!$this->analysiscategorie->contains($analysiscategorie)) {
            $this->analysiscategorie[] = $analysiscategorie;
            $analysiscategorie->setPatients($this);
        }

        return $this;
    }

    public function removeAnalysiscategorie(AnalysisCategories $analysiscategorie): self
    {
        if ($this->analysiscategorie->contains($analysiscategorie)) {
            $this->analysiscategorie->removeElement($analysiscategorie);
            // set the owning side to null (unless already changed)
            if ($analysiscategorie->getPatients() === $this) {
                $analysiscategorie->setPatients(null);
            }
        }

        return $this;
    }

    public function getRoom(): ?Room
    {
        return $this->room;
    }

    public function setRoom(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }
}
