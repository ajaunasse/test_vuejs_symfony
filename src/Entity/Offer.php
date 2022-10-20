<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity()]
#[ORM\Index(columns: ['title'])]
#[ORM\Index(columns: ['contact_email'])]
final class Offer
{
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[Groups(['list_offer'])]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    #[Assert\NotBlank]
    #[Groups(['list_offer'])]
    private string $title;

    #[ORM\Column(type: 'text', nullable: false)]
    #[Assert\NotBlank]
    #[Groups(['list_offer'])]
    private string $description;

    #[ORM\Column(type: 'string', length: 100, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Email]
    #[Groups(['list_offer'])]
    private string $contactEmail;

    #[ORM\Column(type: 'string', length: 20, nullable: false)]
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$^', message: 'Number only')]
    #[Assert\Length(
        min: 8,
        max: 20,
        minMessage: 'Your phone number must be at least {{ limit }} characters long',
        maxMessage: 'Your phone number cannot be longer than {{ limit }} characters',
    )]
    #[Groups(['list_offer'])]
    private string $contactPhone;

    public function __construct()
    {
    }

    /**
     * @param array<string, string> $data
     */
    public static function fromApiData(array $data): self
    {
        $product = new self();
        $product->setTitle($data['title']);
        $product->setDescription($data['description']);
        $product->setContactEmail($data['contactEmail']);
        $product->setContactPhone($data['contactPhone']);

        return $product;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getContactEmail(): string
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail): void
    {
        $this->contactEmail = $contactEmail;
    }

    public function getContactPhone(): string
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone): void
    {
        $this->contactPhone = $contactPhone;
    }
}
