<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ResultsRepository::class)
 */
class Results
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
    private $name_result;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $content_result;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToOne(targetEntity=Patients::class, mappedBy="result_patient", cascade={"persist", "remove"})
     */
    private $patients;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="results")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameResult(): ?string
    {
        return $this->name_result;
    }

    public function setNameResult(string $name_result): self
    {
        $this->name_result = $name_result;

        return $this;
    }

    public function getContentResult(): ?string
    {
        return $this->content_result;
    }

    public function setContentResult(string $content_result): self
    {
        $this->content_result = $content_result;

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
        if ($patients->getResultPatient() !== $this) {
            $patients->setResultPatient($this);
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
