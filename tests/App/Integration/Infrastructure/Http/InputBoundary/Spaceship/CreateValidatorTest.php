<?php

namespace App\Integration\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\Spaceship\CreateValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateValidatorTest extends WebTestCase
{
    private static CreateValidator $validator;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();
        self::$validator = new CreateValidator(static::getContainer()->get(ValidatorInterface::class));
    }

    public function testGetErrors(): void
    {
        $validator = new CreateValidator(static::getContainer()->get(ValidatorInterface::class));
        $errors = self::$validator->getErrors(['name' => 'Space X', 'engine' => '4 VLV 4/4']);
        $this->assertEquals([], $errors);
    }

    public function testGetErrorsWithValidInput(): void
    {
        $this->assertEquals([], self::$validator->getErrors(['name' => 'Space X', 'engine' => '4 VLV 4/4']));
    }
}
