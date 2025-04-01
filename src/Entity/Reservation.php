<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_resa = null;

    #[ORM\Column(length: 255)]
    private ?string $station_dep = null;

    #[ORM\Column(length: 255)]
    private ?string $station_fin = null;

    #[ORM\Column(length: 255)]
    private ?string $type_velo = null;

    #[ORM\Column]
    private ?float $distance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): static
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getDateResa(): ?\DateTimeInterface
    {
        return $this->date_resa;
    }

    public function setDateResa(\DateTimeInterface $date_resa): static
    {
        $this->date_resa = $date_resa;

        return $this;
    }

    public function getStationDep(): ?string
    {
        return $this->station_dep;
    }

    public function setStationDep(string $station_dep): static
    {
        $this->station_dep = $station_dep;

        return $this;
    }

    public function getStationFin(): ?string
    {
        return $this->station_fin;
    }

    public function setStationFin(string $station_fin): static
    {
        $this->station_fin = $station_fin;

        return $this;
    }

    public function getTypeVelo(): ?string
    {
        return $this->type_velo;
    }

    public function setTypeVelo(string $type_velo): static
    {
        $this->type_velo = $type_velo;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): static
    {
        $this->distance = $distance;

        return $this;
    }
}
