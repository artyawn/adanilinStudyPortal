<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserSubjectRequest;
use App\Http\Requests\UpdateUserSubjectRequest;
use App\Http\Resources\UserSubjectsResource;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserSubjectController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/users/{user}/subjects",
     *     tags={"Scores"},
     *     summary="Get users scores list",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
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
     *                         property="scores",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="user_id",
     *                                 type="integer",
     *                                 description="User id"
     *                             ),
     *                             @OA\Property(
     *                                  property="score",
     *                                  type="integer",
     *                                 description="User score"
     *                             ),
     *                               @OA\Property(
     *                                  property="subject_id",
     *                                  type="integer",
     *                                  description="Subject id"
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
    public function index(User $user)
    {
        return UserSubjectsResource::collection($user->subjects);
    }

    /**
     * @OA\Post(
     *     path="/api/users/{user}/subjects",
     *     tags={"Scores"},
     *     summary="Store score",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="score",
     *                     type="integer",
     *                     description="Score"
     *                 ),
     *                   @OA\Property(
     *                     property="subject_id",
     *                     type="integer",
     *                     description="Subject id"
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
    public function store(StoreUserSubjectRequest $request, User $user)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->attach($request->validated('subject_id'), ['score' => $request->validated('score')]);

        return response()->json([
            'message' => 'Score created',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}/subjects/{subject}",
     *     tags={"Scores"},
     *     summary="Update user score",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
     *         required=true
     *     ),
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
     *                     property="score",
     *                     type="",
     *                     description="Score"
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
    public function update(UpdateUserSubjectRequest $request, User $user, Subject $subject)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->updateExistingPivot($subject->id, ['score' => $request->validated('score')]);

        return response()->json([
            'message' => 'Score updated',
        ]);
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{user}/subjects/{subject}",
     *     tags={"Scores"},
     *     summary="Delete score",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="subject",
     *         in="path",
     *         description="Subject id",
     *         required=true
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
    public function destroy(User $user, Subject $subject)
    {
        Gate::authorize('edit-score', $user);
        $user->subjects()->detach($subject->id);

        return response()->json([
            'message' => 'Score deleted',
        ]);
    }
}
