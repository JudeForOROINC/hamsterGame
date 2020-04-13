<?php

namespace App\Entity\PathWay;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ApiResource(
 *
 *     normalizationContext={"groups"={"Path:read"}},
 *     denormalizationContext={"groups"={"Path:write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\PathWay\PathRepository")
 */
class Path
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Path:read", "Path:write", "Cell:read", "Cell:write"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"Path:read", "Path:write", "Cell:read", "Cell:write"})
     */
    private $direction;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PathWay\Cell")
     * @Groups({"Path:read", "Path:write", "Cell:read"})
     */
    private $toCell;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups({"Path:read", "Path:write", "Cell:read", "Cell:write"})
     */
    private $movecost;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PathWay\Cell", inversedBy="directions")
     * @Groups({"Path:read", "Path:write"})
     */
    private $cell;

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


    public function getToCell(): ?int
    {
        return $this->toCell;
    }

    public function setToCell(?int $toCell): self
    {
        $this->toCell = $toCell;

        return $this;
    }

    public function getMovecost(): ?int
    {
        return $this->movecost;
    }

    public function setMovecost(?int $movecost): self
    {
        $this->movecost = $movecost;

        return $this;
    }

    public function getCell(): ?Cell
    {
        return $this->cell;
    }

    public function setCell(?Cell $cell): self
    {
        $this->cell = $cell;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param mixed $direction
     */
    public function setDirection($direction): void
    {
        $this->direction = $direction;
    }
}
