<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use App\Application\Service\SpaceshipService;
use App\Infrastructure\DTO\SpaceshipDTO;
use App\Infrastructure\Http\InputBoundary\Spaceship\CreateValidator;
use App\Infrastructure\Http\InputBoundary\Spaceship\UpdateValidator;
use App\Infrastructure\Http\OutputBoundary\OutputBoundary;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class SpaceshipController extends BaseController
{
    const SPACESHIPS_GUID = '/spaceships/{guid}';
    protected SpaceshipService $service;

    public function __construct(SpaceshipService $service)
    {
        $this->service = $service;
    }

    #[Route('/spaceships', methods: 'GET')]
    public function index(): JsonResponse
    {
        $spaceship = $this->service->findAll();

        if (count($spaceship) == 0) {
            return $this->toJson(status: 404);
        }

        return $this->toJson(OutputBoundary::handle('Spaceships has been found with success', $spaceship));
    }

    #[Route(self::SPACESHIPS_GUID, methods: 'GET')]
    public function findByGuid(string $guid): JsonResponse
    {
        $spaceship = $this->service->findByGuid($guid);

        if (count($spaceship) == 0) {
            return $this->toJson(status: 404);
        }

        return $this->toJson(OutputBoundary::handle('Spaceship has been found with success', $spaceship));
    }

    #[Route('/spaceships', methods: 'POST')]
    public function store(Request $request, CreateValidator $validator): JsonResponse
    {
        $data = $request->request->all();
        $errors = $validator->getErrors($data);

        if (count($errors)) {
            return $this->toJson($errors, 400);
        }

        $spaceship = SpaceshipDTO::toArray($this->service->store($data));
        return $this->toJson(OutputBoundary::handle('Spaceship created with success', $spaceship), 201);
    }

    #[Route(self::SPACESHIPS_GUID, methods: 'PUT')]
    public function update(Request $request, UpdateValidator $validator, string $guid): JsonResponse
    {
        $data = array_merge(['guid' => $guid], $request->request->all());
        $errors = $validator->getErrors($data);

        if (count($errors)) {
            return $this->toJson($errors, 400);
        }

        $spaceship = SpaceshipDTO::toArray($this->service->update($data, $guid));
        return $this->toJson(OutputBoundary::handle('Spaceship updated with success', $spaceship), 201);
    }

    #[Route(self::SPACESHIPS_GUID, methods: ['DELETE'])]
    public function remove(string $guid): JsonResponse
    {
        try {
            $this->service->remove($guid);
        } catch (Exception $e) {
            return $this->toJson(OutputBoundary::handle($e->getMessage()), $e->getCode());
        }
        return $this->toJson(status: 204);
    }

    #[Route(self::SPACESHIPS_GUID, methods: ['OPTIONS'])]
    public function options(): JsonResponse
    {
        return $this->toJson();
    }
}
