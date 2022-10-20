<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Offer;
use App\Repository\OfferRepositoryInterface;
use App\Validator\ErrorsValidatorFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/offer')]
final class OfferController extends AbstractController
{
    public function __construct(
        private OfferRepositoryInterface $offerRepository,
        private ValidatorInterface $validator,
        private SerializerInterface $serializer,
    ) {
    }

    #[Route('/list', name: 'list')]
    public function get(): JsonResponse
    {
        $data = $this->serializer
            ->serialize(
                $this->offerRepository->findAll(),
                'json',
                ['json_encode_options' => JsonResponse::DEFAULT_ENCODING_OPTIONS],
            );

        return new JsonResponse($data);
    }

    #[Route('/add', name: 'add')]
    public function post(Request $request): JsonResponse
    {
        $data = (string) $request->getContent();
        $offer = Offer::fromApiData(json_decode($data, true));

        $errors = $this->validator->validate($offer);

        if ($errors->count() > 0) {
            return new JsonResponse(ErrorsValidatorFactory::formatErrors($errors), Response::HTTP_BAD_REQUEST);
        }

        $this->offerRepository->save($offer);

        return new JsonResponse(['status' => 'Offer created successfully'], Response::HTTP_CREATED);
    }

    #[Route('/delete/{id}', name: 'remove')]
    public function delete(int $id): JsonResponse
    {
        try {
            $offer = $this->offerRepository->findById($id);
        } catch (NotFoundHttpException $e) {
            return new JsonResponse(['message' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }

        $this->offerRepository->remove($offer);

        return new JsonResponse(['status' => 'Offer removed successfully'], Response::HTTP_OK);
    }
}
