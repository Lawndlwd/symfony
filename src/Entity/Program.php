<?php

namespace App\Entity;

use App\Repository\ProgramRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgramRepository::class)
 */
class Program
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poster;

    /**
     * @ORM\OneToMany(targetEntity=Season::class, mappedBy="program_id")
     */
    private $season_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }
    /**
     * @return Collection|Season[]
     */
    public function getSeasonId(): Collection
    {
        return $this->season_id;
    }

    public function addSeasonId(Season $seasonId): self
    {
        if (!$this->season_id->contains($seasonId)) {
            $this->season_id[] = $seasonId;
            $seasonId->setProgramId($this);
        }

        return $this;
    }

    public function removeSeasonId(Season $seasonId): self
    {
        if ($this->season_id->contains($seasonId)) {
            $this->season_id->removeElement($seasonId);
            // set the owning side to null (unless already changed)
            if ($seasonId->getProgramId() === $this) {
                $seasonId->setProgramId(null);
            }
        }

        return $this;
    }
}
