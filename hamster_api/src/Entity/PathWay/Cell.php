<?php

namespace App\Entity\PathWay;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
//*     normalizationContext={"groups"={"book"}}

/**
 * @ApiResource(

 *     )
 * @ORM\Entity(repositoryClass="App\Repository\PathWay\CellRepository")
 */
class Cell
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Cell:read", "Cell:write", "Path:read" })
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PathWay\Path", mappedBy="cell", cascade={"all"}, fetch="EAGER")
     * @Groups({"Cell:read", "Cell:write", "Path:read"})
     * @MaxDepth(2)
     */
    private $directions;

    public function __construct()
    {
        $this->directions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Path[]
     */
    public function getDirections(): Collection
    {
        return $this->directions;
    }

    public function addDirection(Path $direction): self
    {
        if (!$this->directions->contains($direction)) {
            $this->directions[] = $direction;
            $direction->setCell($this);
        }

        return $this;
    }

    public function removeDirection(Path $direction): self
    {
        if ($this->directions->contains($direction)) {
            $this->directions->removeElement($direction);
            // set the owning side to null (unless already changed)
            if ($direction->getCell() === $this) {
                $direction->setCell(null);
            }
        }

        return $this;
    }
}
