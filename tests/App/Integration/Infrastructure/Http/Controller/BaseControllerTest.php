<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\Http\Controller;

use App\Infrastructure\Http\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseControllerTest extends WebTestCase
{
    private BaseController $baseController;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();
    }

    public function setUp(): void
    {
        $this->baseController = static::getContainer()->get(BaseController::class);
    }

    public function testToJson(): void
    {
        $response = $this->baseController->toJson();
        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('{}', $response->getContent());
    }
}
