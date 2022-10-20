<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Offer;

interface OfferRepositoryInterface
{
    /** @return Offer[] */
    public function findAll(): array;

    public function findById(int $id): Offer;

    public function save(Offer $offer): void;

    public function remove(Offer $offer): void;
}
