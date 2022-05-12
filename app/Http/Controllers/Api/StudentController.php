<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterStudentRequest;
use App\Http\Requests\StudentFilterRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\FileServices;

class StudentController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/students",
     *     description="Students list",
     *     tags={"students"},
     *      @OA\Response(
     *         response=200,
     *         description="Student list",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Student"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function index(StudentFilterRequest $request)
    {
        $this->authorize('viewAny', Student::class);

        $students = Student::filter($request)->paginate(10);

        return StudentResource::collection($students);
    }

    /**
     * @OA\Post (
     *     path="/api/students",
     *     description="Student create",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="first_name",
     *          description="First name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="last_name",
     *          description="Last name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="middle_name",
     *          description="Middle name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="group_id",
     *          description="Group",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="email",
     *          description="Email",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="city",
     *          description="City",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="street",
     *          description="Street",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="home",
     *          description="Home",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="birthday",
     *          description="Birthday",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="role_id",
     *          description="Role",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="password",
     *          description="Password",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="password_confirmation",
     *          description="Password Conformation",
     *          in="query",
     *     ),
     *     @OA\Response (
     *          response=200,
     *          description="Created student",
     *          @OA\JsonContent(
     *              @OA\Property (
     *                  property="student", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Student"),
     *              ),
     *          ),
     *     ),
     * ),
     */

    public function store(RegisterStudentRequest $request)
    {
        $this->authorize('store', [Student::class, $request]);

        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home,
        ];

        $user = Student::create($request->validated());
        $user->address = $address;
        $user->password = bcrypt($user->password);
        $user->save();

        return new StudentResource($user);
    }

    /**
     * @OA\Get(
     *     path="/api/students/{student}",
     *     description="Show student",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Student subject",
     *          in="path",
     *     ),

     *      @OA\Response(
     *         response=200,
     *         description="Student show sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Student"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function show(Student $student)
    {
        $this->authorize('view', [$student]);

        return new StudentResource($student);
    }

    /**
     * @OA\Put(
     *     path="/api/students/{student}",
     *     description="Student Update",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Object student",
     *          in="path",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="first_name",
     *          description="First name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="last_name",
     *          description="Last name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="middle_name",
     *          description="Middle name",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="group_id",
     *          description="Group",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="email",
     *          description="Email",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="city",
     *          description="City",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="street",
     *          description="Street",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="home",
     *          description="Home",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="birthday",
     *          description="Birthday",
     *          in="query",
     *     ),
     *     @OA\Parameter(
     *          required=true,
     *          name="role_id",
     *          description="Role",
     *          in="query",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Student update sucessfull",
     *         @OA\JsonContent(
     *              @OA\Property (
     *                  property="data", 
     *                  type="object",
     *                  @OA\Property (ref="#/components/schemas/Student"),
     *              ),
     *         )
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function update(Student $student, StudentRequest $request)
    {
        $this->authorize('update', [$student, $request]);

        $address = [
            'city' => $request->city,
            'street' => $request->street,
            'home' => $request->home,
        ];

        $student->address = $address;
        $student->update($request->validated());

        return new StudentResource($student);
    }

    /**
     * @OA\Delete(
     *     path="/api/students/{student}",
     *     description="Student delete",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Object student",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Student delete sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $student->subjects()->detach();
        $student->delete();

        return response()->json([
            'message' => 'Удаление завершено.',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/students/pdf/download",
     *     description="Student delete",
     *     tags={"students"},
     *      @OA\Response(
     *         response=200,
     *         description="Student link is ready",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function downloadList()
    {
        $this->authorize('create', Student::class);

        $students = Student::all();

        return FileServices::getStudentListLink($students);
    }

    /**
     * @OA\Post(
     *     path="/students/{student}/restore",
     *     description="Student restore",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Object student",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Student restore sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function restore(Student $student)
    {
        $this->authorize('restore', $student);

        $student->restore();

        return response()->json([
           'message' => 'Восстановление завершено.',
       ]);
    }

    /**
     * @OA\Post(
     *     path="/students/{student}/forceDelete",
     *     description="Student forceDelete",
     *     tags={"students"},
     *     @OA\Parameter(
     *          required=true,
     *          name="student",
     *          description="Object student",
     *          in="path",
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Student force delete sucessfull",
     *     ),
     *       @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function forceDelete(Student $student)
    {
        $this->authorize('forceDelete', $student);

        $student->subjects()->detach();
        $student->forceDelete();

        return response()->json([
            'message' => 'Полное удаление завершено.',
        ]);
    }
}
