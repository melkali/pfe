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
     * @ORM\OneToMany(targetEntity=AnalysisType::class, mappedBy="patients")
     */
    private $analysis_type;

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

    public function __construct()
    {
        $this->analysis_type = new ArrayCollection();
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

    /**
     * @return Collection|AnalysisType[]
     */
    public function getAnalysisType(): Collection
    {
        return $this->analysis_type;
    }

    public function addAnalysisType(AnalysisType $analysisType): self
    {
        if (!$this->analysis_type->contains($analysisType)) {
            $this->analysis_type[] = $analysisType;
            $analysisType->setPatients($this);
        }

        return $this;
    }

    public function removeAnalysisType(AnalysisType $analysisType): self
    {
        if ($this->analysis_type->contains($analysisType)) {
            $this->analysis_type->removeElement($analysisType);
            // set the owning side to null (unless already changed)
            if ($analysisType->getPatients() === $this) {
                $analysisType->setPatients(null);
            }
        }

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
}
