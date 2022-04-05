<?php

namespace App\Unit\Infrastructure\Http\Controller;

use PHPUnit\Framework\TestCase;
use ReflectionClass;
use App\Infrastructure\Http\Controller\BaseController;

class BaseControllerTest extends TestCase
{
    public function testCors(): void
    {
        $reflectionClass = new ReflectionClass(BaseController::class);
        $reflectionClass = $reflectionClass->getMethod('cors');
        $reflectionClass->setAccessible(true);

        $this->assertEquals($reflectionClass->invoke(new BaseController), [
            'Access-Control-Allow-Origin' => 'http://localhost:81',
            'Access-Control-Allow-Methods' => 'DELETE, PUT'
        ]);
    }
}