<?php

declare(strict_types=1);

namespace App\Integration\Infrastructure\Http\InputBoundary\Spaceship;

use App\Infrastructure\Http\InputBoundary\Spaceship\UpdateValidator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UpdateValidatorTest extends WebTestCase
{
    private static UpdateValidator $validator;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();
        self::$validator = new UpdateValidator(static::getContainer()->get(ValidatorInterface::class));
    }

    public function testGetErrors(): void
    {
        $errors = self::$validator->getErrors([]);
        $this->assertEquals([
            'guid' => ['This value is not a valid for id field'],
            'name' => ['This value is not a valid for name field'],
            'engine' => ['This value is not a valid for engine field'],
        ], $errors);
    }

    /**
     * @dataProvider invalidGuidDataProvider
     */
    public function testGetErrorsInvalidGuid(mixed $input, mixed $message): void
    {
        $errors = self::$validator->getErrors(['guid' => $input]);
        $this->assertEquals([
            'guid' => [$message],
            'name' => ['This value is not a valid for name field'],
            'engine' => ['This value is not a valid for engine field'],
        ], $errors);
    }

    public function testGetErrorsWithValidInput(): void
    {
        $parameters = ['guid' => 'f7d97079-118d-42f2-b836-3276ca30fd43', 'name' => 'Space X', 'engine' => '4 VLV 4/4'];
        $this->assertEquals([], self::$validator->getErrors($parameters));
    }

    public function invalidGuidDataProvider(): array
    {
        return [
            'Invalid UUID' => [
                'invalid uuid', 'This is not a valid UUID.',
            ],
            'NotNull' => [
                null, 'This value is not a valid for id field',
            ],
        ];
    }
}
