<?php

declare(strict_types=1);

namespace App\Unit\Infrastructure\Http\Controller;

use App\Infrastructure\Http\Controller\BaseController;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

/**
 * @internal
 * @coversNothing
 */
class BaseControllerTest extends TestCase
{
    public function testCors(): void
    {
        $reflectionClass = new ReflectionClass(BaseController::class);
        $reflectionClass = $reflectionClass->getMethod('cors');
        $reflectionClass->setAccessible(true);

        $this->assertEquals([
            'Access-Control-Allow-Origin' => 'http://localhost:81',
            'Access-Control-Allow-Methods' => 'DELETE, PUT',
        ], $reflectionClass->invoke(new BaseController()));
    }
}
