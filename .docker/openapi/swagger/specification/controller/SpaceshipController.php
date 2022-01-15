<?php declare(strict_types=1);

use OpenApi\Annotations as OA;

interface SpaceshipController
{
    /**
     * @OA\Get(
     *   path="/spaceships",
     *   summary="find all",
     *   tags={"Spaceship"},
     *   @OA\Response(response=200, description="Spaceships has been found with success",
     *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Spaceship"))
     *   ),
     *   @OA\Response(response="404", description="{}")
     * )
     */
    public function index(): void;

    /**
     * @OA\Get(
     *   path="/spaceships/{guid}",
     *   summary="find by guid",
     *   tags={"Spaceship"},
     *   @OA\Parameter(in="path", name="guid", required=true),
     *   @OA\Response(response=200, description="Spaceship has been found with success",
     *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Spaceship"))
     *   ),
     *   @OA\Response(response="404", description="{}")
     * )
     */
    public function findByGuid(): void;

    /**
     * @OA\Post(
     *   path="/spaceships",
     *   summary="create",
     *   tags={"Spaceship"},
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(
     *               @OA\Property(
     *                   description="Name",
     *                   property="name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   description="Engine info",
     *                   property="engine",
     *                   type="string"
     *               ),
     *               required={"name", "engine"}
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Spaceship has been created with success",
     *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Spaceship"))
     *   ),
     *   @OA\Response(response="400", description="Invalid order")
     * )
     */
    public function store(): void;

    /**
     * @OA\Delete(
     *   path="/spaceships/{guid}",
     *   summary="delete by guid",
     *   tags={"Spaceship"},
     *   @OA\Parameter(in="path", name="guid", required=true),
     *   @OA\Response(response=200, description="{}"),
     *   @OA\Response(response="404", description="Entity not found")
     * )
     */
    public function remove(): void;

    /**
     * @OA\Put(
     *   path="/spaceships/{guid}",
     *   summary="update by guid",
     *   tags={"Spaceship"},
     *   @OA\Parameter(in="path", name="guid", required=true),
     *   @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/x-www-form-urlencoded",
     *           @OA\Schema(
     *               @OA\Property(
     *                   description="Name",
     *                   property="name",
     *                   type="string"
     *               ),
     *               @OA\Property(
     *                   description="Engine info",
     *                   property="engine",
     *                   type="string"
     *               ),
     *               required={"name", "engine"}
     *           )
     *       )
     *   ),
     *   @OA\Response(response=200, description="Spaceship has been updated with success",
     *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Spaceship"))
     *   ),
     *   @OA\Response(response="400", description="Invalid order"),
     *   @OA\Response(response="404", description="Entity not found")
     * )
     */
    public function update(): void;
}