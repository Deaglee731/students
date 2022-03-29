<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupFilterRequest;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupResource;
use App\Models\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Group::class, 'group');
    }

    /**
     * @OA\Get(
     *     path="/api/groups",
     *     description="Groups list",
     *     tags={"group"},
     *      @OA\Response(
     *         response=200,
     *         description="Group list",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Group"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function index(GroupFilterRequest $request)
    {
        $groups = Group::filter($request)->paginate(10);

        return GroupResource::collection($groups);
    }

    /**
     * @OA\Post(
     *     path="/api/groups/",
     *     description="Groups store",
     *     tags={"group"},
     *     @OA\Parameter(
     *          required=true,
     *          name="name",
     *          description="Group name",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Group create sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Group"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function store(GroupRequest $request)
    {
        Group::create($request->validated());

        return response()->json([
            'message' => 'Группа создана успешно',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/groups/{group}",
     *     description="Show group",
     *     tags={"group"},
     *     @OA\Parameter(
     *          required=true,
     *          name="group",
     *          description="Object group",
     *          in="path",
     *     ),

     *      @OA\Response(
     *         response=200,
     *         description="group show sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Group"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function show(Group $group)
    {
        return new GroupResource($group);
    }

    /**
     * @OA\Put(
     *     path="/api/groups/{group}",
     *     description="Group Update",
     *     tags={"group"},
     *     @OA\Parameter(
     *          required=true,
     *          name="name",
     *          description="group name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="group",
     *          description="Object group",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Group update sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Group"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->validated());

        return new GroupResource($group);
    }

    /**
     * @OA\Delete(
     *     path="/api/groups/{group}",
     *     description="Groups delete",
     *     tags={"group"},
     *     @OA\Parameter(
     *          required=true,
     *          name="group",
     *          description="Object group",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Group delete sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function destroy(Group $group)
    {
        $group->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);
    }
}
