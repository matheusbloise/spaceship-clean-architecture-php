<?php

namespace App\Test\Unit\Application\Exception;

use App\Application\Exception\EntityNotFound;
use PHPUnit\Framework\TestCase;

class EntityNotFoundTest extends TestCase
{

    public function testMessageAndCode()
    {
        self::expectException(EntityNotFound::class);
        self::expectExceptionMessage('Entity not found');
        self::expectExceptionCode(404);

        throw new EntityNotFound;
    }
}