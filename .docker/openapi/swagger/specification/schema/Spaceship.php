<?php declare(strict_types=1);

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Spaceship",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         example="f7d97079-118d-42f2-b836-3276ca30fd43",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         example="Swagger Spaceship",
 *         type="string"
 *     ),
 *     @OA\Property(
 *         property="engine",
 *         example="V12",
 *         type="string"
 *     )
 * )
 */
interface Spaceship
{

}