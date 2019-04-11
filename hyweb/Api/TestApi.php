<?php
/**
 * @OA\Info(title="My First API", version="0.1")
 */

/**
 * @OA\Get(
 *     path="/api/resource.json",
 *     @OA\Response(response="200", description="An example resource")
 * )
 */
namespace hyweb\Api;

class TestApi {

    public function __construct()
    {
        header('Access-Control-Allow-Origin:*');
    }

    /**
     * @OA\Post(
     *     path="/index.php/Api/TestApi/index",
     *     summary="用户添加",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 example={"id": 10, "name": "Jessica Smith"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     )
     * )
     */
    public function index($ref, $id, $created_at) {
        echo $ref.$id.$created_at;
    }

    /**
     * @OA\Get(path="/index.php/Api/TestApi/getUser",
     *   operationId="查询用户",
     *   @OA\Parameter(name="username",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response="200",
     *     description="The User",
     *     @OA\JsonContent(ref=""),
     *     @OA\Link(link="userRepositories", ref="")
     *   )
     * )
     */
    public function getUser() {
        $username = $_GET['username'];
        echo $username;
    }
}