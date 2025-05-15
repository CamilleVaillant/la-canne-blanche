<?php

namespace App\Entity;

use App\Repository\TatooRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TatooRepository::class)]
class Tatoo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $tatoo = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'tatoos')]
    private ?User $User = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTatoo(): ?string
    {
        return $this->tatoo;
    }

    public function setTatoo(string $tatoo): static
    {
        $this->tatoo = $tatoo;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }
}
