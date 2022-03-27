<?php

namespace App\Integration\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\Spaceship\CreateValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateValidatorTest extends WebTestCase
{
    private CreateValidator $validator;

    public function setUp(): void
    {
        self::bootKernel();
        $this->validator = new CreateValidator(static::getContainer()->get(ValidatorInterface::class));
    }

    public function testGetErrors(): void
    {
        $this->assertEquals([
            'name' => ['This value is not a valid for name field'],
            'engine' => ['This value is not a valid for engine field'],
        ], $this->validator->getErrors([]));
    }

    public function testGetErrorsWithValidInput(): void
    {
        $this->assertEquals([], $this->validator->getErrors(['name' => 'Space X', 'engine' => '4 VLV 4/4']));
    }

    /**
     * @dataProvider invalidEngineDataProvider
     * @return void
     */
    public function testGetErrorsWithInvalidInput($value)
    {
        $validation = $this->validator->getErrors(['engine' => $value]);
        $this->assertEquals($validation['engine'][0], 'This value is not a valid for engine field');
    }

    public function invalidEngineDataProvider(): array
    {
        return [
            'Empty' => [
                ''
            ],
            'NotNull' => [
                null
            ],
            'Falsy' => [
                0
            ]
        ];
    }
}
