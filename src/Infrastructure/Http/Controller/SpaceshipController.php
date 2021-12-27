<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use App\Application\Service\SpaceshipService;
use App\Infrastructure\Http\InputBoundary\Spaceship\CreateValidator;
use App\Infrastructure\Http\OutputBoundary\OutputBoundary;
use App\Infrastructure\Http\OutputBoundary\SpaceshipOutputBoundary;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class SpaceshipController extends AbstractController
{
    protected SpaceshipService $service;

    public function __construct(SpaceshipService $service)
    {
        $this->service = $service;
    }

    #[Route('/spaceships', methods: 'GET')]
    public function index(): Response
    {
        $spaceship = $this->service->findAll();

        if (! $spaceship) {
            return $this->json(null, 404);
        }

        return $this->json(OutputBoundary::handle('Spaceships has been found with success', $spaceship));
    }

    #[Route('/spaceships/{guid}', methods: 'GET')]
    public function findByGuid(string $guid): Response
    {
        $spaceship = $this->service->findByGuid($guid);

        if (! $spaceship) {
            return $this->json([], 404);
        }

        return $this->json(OutputBoundary::handle('Spaceship has been found with success', $spaceship));
    }

    #[Route('/spaceships', methods: 'POST')]
    public function store(Request $request, CreateValidator $dto): Response
    {
        $data = $request->request->all();
        $errors = $dto->fromArray($data);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $spaceship = SpaceshipOutputBoundary::toArray($this->service->store($data));
        return $this->json(OutputBoundary::handle('Spaceship created with success', $spaceship), 201);
    }

    #[Route('/spaceships/{guid}', methods: 'PUT')]
    public function update(Request $request, CreateValidator $dto, string $guid): Response
    {
        $data = $request->request->all();
        $errors = $dto->fromArray($data);

        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }

        $spaceship = SpaceshipOutputBoundary::toArray($this->service->update($data, $guid));
        return $this->json(SpaceshipOutputBoundary::handle('Spaceship updated with success', $spaceship), 201);
    }

    #[Route('/spaceships/{guid}', methods: 'DELETE')]
    public function remove(string $guid): Response
    {
        try {
            $this->service->remove($guid);
        } catch (\Exception $e) {
            return $this->json(SpaceshipOutputBoundary::handle($e->getMessage()), $e->getCode());
        }
        return $this->json(null, 204);
    }
}
