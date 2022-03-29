<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectFilterRequest;
use App\Http\Requests\SubjectRequest;
use App\Http\Resources\SubjectResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Subject::class, 'subject');
    }

    /**
     * @OA\Get(
     *     path="/api/subjects",
     *     description="Subjects list",
     *     tags={"subject"},
     *      @OA\Response(
     *         response=200,
     *         description="Subjects list",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Subject"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function index(SubjectFilterRequest $request)
    {
        $subjects = Subject::filter($request)->paginate(10);

        return SubjectResource::collection($subjects);
    }

    /**
     * @OA\Post(
     *     path="/api/subjects/",
     *     description="Subject store",
     *     tags={"subject"},
     *     @OA\Parameter(
     *          required=true,
     *          name="name",
     *          description="Subject name",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Subject create sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Subject"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function store(SubjectRequest $request)
    {
        $subject = Subject::create($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @OA\Get(
     *     path="/api/subjects/{subject}",
     *     description="Show subject",
     *     tags={"subject"},
     *     @OA\Parameter(
     *          required=true,
     *          name="subject",
     *          description="Object subject",
     *          in="path",
     *     ),

     *      @OA\Response(
     *         response=200,
     *         description="subject show sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Subject"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function show(Subject $subject)
    {
        return new SubjectResource($subject);
    }

    /**
     * @OA\Put(
     *     path="/api/subjects/{subject}",
     *     description="Subject Update",
     *     tags={"subject"},
     *     @OA\Parameter(
     *          required=true,
     *          name="name",
     *          description="subject name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="subject",
     *          description="Object subject",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Subject update sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Subject"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        return new SubjectResource($subject);
    }

    /**
     * @OA\Delete(
     *     path="/api/subjects/{subject}",
     *     description="Subject delete",
     *     tags={"subject"},
     *     @OA\Parameter(
     *          required=true,
     *          name="subject",
     *          description="Object subject",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Subject delete sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);

    }
}
