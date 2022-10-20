<?php

declare(strict_types=1);

namespace App\Tests\Unit\Entity;

use App\Entity\Offer;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class OfferTest extends TestCase
{
    /** @test */
    public function it_should_create_an_offer_from_array_data(): void
    {
        $arrayData = [
            'title' => 'My offer',
            'description' => 'Offer description',
            'contactEmail' => 'test@mail.fr',
            'contactPhone' => '0240404040',
        ];

        $offer = Offer::fromApiData($arrayData);

        self::assertInstanceOf(Offer::class, $offer);
        self::assertSame($arrayData['title'], $offer->getTitle());
        self::assertSame($arrayData['description'], $offer->getDescription());
        self::assertSame($arrayData['contactEmail'], $offer->getContactEmail());
        self::assertSame($arrayData['contactPhone'], $offer->getContactPhone());
    }
}
