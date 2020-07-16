<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomRepository::class)
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $availibityStatus;

    /**
     * @ORM\OneToMany(targetEntity=Patients::class, mappedBy="room")
     */
    private $patients;

    /**
     * @ORM\ManyToOne(targetEntity=Users::class, inversedBy="rooms")
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_room;

    public function __construct()
    {
        $this->patients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvailibityStatus(): ?bool
    {
        return $this->availibityStatus;
    }

    public function setAvailibityStatus(bool $availibityStatus): self
    {
        $this->availibityStatus = $availibityStatus;

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
            $patient->setRoom($this);
        }

        return $this;
    }

    public function removePatient(Patients $patient): self
    {
        if ($this->patients->contains($patient)) {
            $this->patients->removeElement($patient);
            // set the owning side to null (unless already changed)
            if ($patient->getRoom() === $this) {
                $patient->setRoom(null);
            }
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

    public function getNameRoom(): ?string
    {
        return $this->name_room;
    }

    public function setNameRoom(string $name_room): self
    {
        $this->name_room = $name_room;

        return $this;
    }
}
