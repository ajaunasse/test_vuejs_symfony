<?php

declare(strict_types=1);

namespace App\Tests\Helpers;

use App\Entity\Offer;
use App\Repository\OfferRepositoryInterface;
use ReflectionClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use function count;

final class InMemoryOfferRepository implements OfferRepositoryInterface
{
    private array $offers = [];

    public function __construct(Offer ...$offers)
    {
        foreach ($offers as $offer) {
            $this->save($offer);
        }
    }

    public function findAll(): array
    {
        return $this->offers;
    }

    public function findById(int $id): Offer
    {
        if (!isset($this->offers[$id])) {
            throw new NotFoundHttpException(sprintf('Offer with %d id does not exist', $id));
        }

        return $this->offers[$id];
    }

    public function save(Offer $offer): void
    {
        if ($offer->getId() === null) {
            $id = count($this->offers) + 1;
            $reflection = new ReflectionClass($offer);
            $property = $reflection->getProperty('id');
            $property->setAccessible(true);
            $property->setValue($offer, $id);
        }

        $this->offers[$offer->getId()] = $offer;
    }

    public function remove(Offer $offer): void
    {
        unset($this->offers[$offer->getId()]);
    }
}
