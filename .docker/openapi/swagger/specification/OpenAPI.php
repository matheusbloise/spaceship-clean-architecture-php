<?php declare(strict_types=1);

namespace Documentation;

use OpenApi\Annotations as OA;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Spaceship Clean Architecture",
 *         @OA\Contact(
 *             name="Matheus Bloise",
 *             url="https://www.linkedin.com/in/matheus-b-9609b885/",
 *             email="matheusbloisev@hotmail.com"
 *         )
 *     ),
 *     @OA\Server(url="http://localhost:80", description="Local environment"),
 *     @OA\Server(url="https://your-domain.ms.qa", description="Homologation environment"),
 *     @OA\Server(url="https://your-domain.ms.prod", description="Production environment")
 * )
 */
interface OpenAPI
{

}