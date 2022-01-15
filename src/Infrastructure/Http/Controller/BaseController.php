<?php declare(strict_types=1);

namespace App\Infrastructure\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends AbstractController
{
    public function toJson(array $content = null, int $status = 200): JsonResponse
    {
        return $this->json($content, $status, headers: $this->cors());
    }

    private function cors(): array
    {
        return [
            'Access-Control-Allow-Origin' => getenv('CLIENT_AUTHORIZED') ?: 'http://localhost:81',
            'Access-Control-Allow-Methods' => 'DELETE, PUT'
        ];
    }
}