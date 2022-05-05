<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\Spaceship\CreateValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @internal
 * @coversNothing
 */
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
     */
    public function testGetErrorsWithInvalidInput(mixed $value)
    {
        $validation = $this->validator->getErrors(['engine' => $value]);
        $this->assertEquals('This value is not a valid for engine field', $validation['engine'][0]);
    }

    public function invalidEngineDataProvider(): array
    {
        return [
            'Empty' => [
                '',
            ],
            'NotNull' => [
                null,
            ],
            'Falsy' => [
                0,
            ],
        ];
    }
}
