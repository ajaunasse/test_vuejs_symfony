<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Offer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class OfferRepository implements OfferRepositoryInterface
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function findAll(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('offer')
            ->from(Offer::class, 'offer')
            ->orderBy('offer.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function save(Offer $offer): void
    {
        $this->entityManager->persist($offer);
        $this->entityManager->flush();
    }

    public function remove(Offer $offer): void
    {
        $this->entityManager->remove($offer);
        $this->entityManager->flush();
    }

    public function findById(int $id): Offer
    {
        $offer = $this->entityManager
            ->createQueryBuilder()
            ->select('offer')
            ->from(Offer::class, 'offer')
            ->where('offer.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

        if ($offer === null) {
            throw new NotFoundHttpException(sprintf('Offer with the %d id does not exist', $id));
        }

        return $offer;
    }
}
