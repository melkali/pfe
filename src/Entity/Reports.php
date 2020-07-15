<?php

namespace App\Entity;

use App\Repository\ReportsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportsRepository::class)
 */
class Reports
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
    private $name_report;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToOne(targetEntity=Patients::class, mappedBy="report_patient", cascade={"persist", "remove"})
     */
    private $patients;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="reports")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameReport(): ?string
    {
        return $this->name_report;
    }

    public function setNameReport(string $name_report): self
    {
        $this->name_report = $name_report;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPatients(): ?Patients
    {
        return $this->patients;
    }

    public function setPatients(Patients $patients): self
    {
        $this->patients = $patients;

        // set the owning side of the relation if necessary
        if ($patients->getReportPatient() !== $this) {
            $patients->setReportPatient($this);
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
