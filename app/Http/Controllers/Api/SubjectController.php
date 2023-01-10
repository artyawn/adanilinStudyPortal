<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Http\Resources\SubjectsResource;
use App\Models\Subject;

class SubjectController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/subjects",
     *     tags={"Subjects"},
     *     summary="Get subjects list",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="subjects",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="id",
     *                                 type="string",
     *                                 description="Group id"
     *                             ),
     *                             @OA\Property(
     *                                  property="name",
     *                                  type="string",
     *                                 description="Subject name"
     *                             ),
     *                               @OA\Property(
     *                                  property="created_at",
     *                                  type="date",
     *                                  description="Creating date"
     *                             ),
     *                               @OA\Property(
     *                                  property="updated_at",
     *                                  type="date",
     *                                  description="Updating date"
     *                             ),
     *                         ),
     *                     )
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     * )
     */
    public function index()
    {
        return SubjectsResource::collection(Subject::all());
    }

    /**
     * @OA\Post(
     *     path="/api/subjects",
     *     tags={"Subjects"},
     *     summary="Store subject",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Subject name"
     *                 ),
     *             )
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *)
     */
    public function store(StoreSubjectRequest $request)
    {
        $this->authorize('create', Subject::class);
        $subject = Subject::create($request->validated());

        return new SubjectsResource($subject);
    }

    /**
     * @OA\Get(
     *     path="/api/subjects/{subject}",
     *     tags={"Subjects"},
     *     summary="Show subject",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="subject",
     *         in="path",
     *         description="Subject id",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="subject",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="id",
     *                                 type="string",
     *                                 description="Subject id"
     *                             ),
     *                             @OA\Property(
     *                                  property="name",
     *                                  type="string",
     *                                 description="Subject name"
     *                             ),
     *                               @OA\Property(
     *                                  property="created_at",
     *                                  type="date",
     *                                  description="Creating date"
     *                             ),
     *                               @OA\Property(
     *                                  property="updated_at",
     *                                  type="date",
     *                                  description="Updating date"
     *                             ),
     *                         ),
     *                     )
     *                 )
     *             )
     *         }
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     * )
     */
    public function show(Subject $subject)
    {
        return new SubjectsResource($subject);
    }

    /**
     * @OA\Put(
     *     path="/api/subjects/{subject}",
     *     tags={"Subjects"},
     *     summary="Update subject",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="subject",
     *         in="path",
     *         description="Subject id",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Subject name"
     *                 ),
     *             )
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated"
     *     ),
     *)
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {
        $this->authorize('update', $subject);
        $subject->update($request->validated());

        return new SubjectsResource($subject);
    }

    /**
     * @OA\Delete (
     *     path="/api/subjects/{subject}",
     *     tags={"Subjects"},
     *     summary="Delete subject",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="subject",
     *         in="path",
     *         description="Subject id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *          @OA\JsonContent(
     *              @OA\Property (
     *                  property="status",
     *                  description="Successfully"
     *              )
     *          )
     *     ),
     * )
     */
    public function destroy(Subject $subject)
    {
        $this->authorize('delete', $subject);
        $subject->delete();

        return response()->json([
            'message' => 'Subject deleted',
        ]);
    }
}
