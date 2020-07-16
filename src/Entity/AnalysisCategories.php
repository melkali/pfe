<?php

namespace App\Entity;

use App\Repository\AnalysisCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnalysisCategoriesRepository::class)
 */
class AnalysisCategories
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
    private $analysis_name;

    /**
     * @ORM\ManyToOne(targetEntity=Patients::class, inversedBy="analysiscategorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $patients;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="analysiscategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnalysisName(): ?string
    {
        return $this->analysis_name;
    }

    public function setAnalysisName(string $analysis_name): self
    {
        $this->analysis_name = $analysis_name;

        return $this;
    }

    public function getPatients(): ?Patients
    {
        return $this->patients;
    }

    public function setPatients(?Patients $patients): self
    {
        $this->patients = $patients;

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
