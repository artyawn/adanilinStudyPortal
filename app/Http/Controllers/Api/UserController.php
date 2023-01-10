<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UsersResource;
use App\Models\User;
use App\Services\FileService;

class UserController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Get users list",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="users",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="id",
     *                                 type="string",
     *                                 description="User id"
     *                             ),
     *                             @OA\Property(
     *                                  property="fio",
     *                                  type="string",
     *                                 description="User fio"
     *                             ),
     *                             @OA\Property(
     *                                  property="birth_date",
     *                                  type="string",
     *                                 description="User birth date"
     *                             ),
     *                              @OA\Property(
     *                                  property="group_id",
     *                                  type="string",
     *                                  description="User group id"
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
     *                              @OA\Property(
     *                                  property="address",
     *                                  type="string",
     *                                 description="User address"
     *                             ),
     *                               @OA\Property(
     *                                  property="email",
     *                                  type="string",
     *                                 description="User email"
     *                             ),
     *                                 @OA\Property(
     *                                  property="password",
     *                                  type="string",
     *                                  description="User password"
     *                             ),
     *                              @OA\Property(
     *                                  property="role",
     *                                  type="string",
     *                                 description="User role"
     *                             ),
     *                                  @OA\Property(
     *                                  property="avatar",
     *                                  type="string",
     *                                 description="User avatar path"
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
        return UsersResource::collection(User::all());
    }

    /**
     * @OA\Post(
     *     path="/api/users",
     *     tags={"Users"},
     *     summary="Store user",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="fio",
     *                     type="string",
     *                     description="User fio"
     *                 ),
     *                 @OA\Property(
     *                     property="birth_date",
     *                     type="date",
     *                     description="User birth day"
     *                 ),
     *                 @OA\Property(
     *                     property="group_id",
     *                     type="integer",
     *                     description="User group id"
     *                 ),
     *                 @OA\Property(
     *                     property="role",
     *                     type="integer",
     *                     description="User role"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="json",
     *                     description="User address"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="User email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User password"
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
    public function store(StoreUserRequest $request)
    {
        $this->authorize('store', [User::class, $request]);
        $user = User::create($request->validated());

        return new UsersResource($user);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Show user",
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
     *                         property="users",
     *                         type="array",
     *                         @OA\Items(
     *                             @OA\Property(
     *                                 property="id",
     *                                 type="string",
     *                                 description="User id"
     *                             ),
     *                             @OA\Property(
     *                                  property="fio",
     *                                  type="string",
     *                                 description="User fio"
     *                             ),
     *                             @OA\Property(
     *                                  property="birth_date",
     *                                  type="string",
     *                                 description="User birth date"
     *                             ),
     *                              @OA\Property(
     *                                  property="group_id",
     *                                  type="string",
     *                                  description="User group id"
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
     *                              @OA\Property(
     *                                  property="address",
     *                                  type="string",
     *                                 description="User address"
     *                             ),
     *                               @OA\Property(
     *                                  property="email",
     *                                  type="string",
     *                                 description="User email"
     *                             ),
     *                                 @OA\Property(
     *                                  property="password",
     *                                  type="string",
     *                                  description="User password"
     *                             ),
     *                              @OA\Property(
     *                                  property="role",
     *                                  type="string",
     *                                 description="User role"
     *                             ),
     *                                  @OA\Property(
     *                                  property="avatar",
     *                                  type="string",
     *                                 description="User avatar path"
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
    public function show(User $user)
    {
        return new UsersResource($user);
    }

    /**
     * @OA\Put(
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Update user",
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
     *                     property="fio",
     *                     type="string",
     *                     description="User fio"
     *                 ),
     *                 @OA\Property(
     *                     property="birth_date",
     *                     type="date",
     *                     description="User birth day"
     *                 ),
     *                 @OA\Property(
     *                     property="group_id",
     *                     type="integer",
     *                     description="User group id"
     *                 ),
     *                 @OA\Property(
     *                     property="role",
     *                     type="integer",
     *                     description="User role"
     *                 ),
     *                 @OA\Property(
     *                     property="address",
     *                     type="json",
     *                     description="User address"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                     description="User email"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string",
     *                     description="User password"
     *                 ),
     *                 @OA\Property(
     *                     property="password_confirmation",
     *                     type="string",
     *                     description="Confirm password"
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
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update', [User::class, $request]);
        $user->update($request->validated());

        return new UsersResource($user);
    }

    /**
     * @OA\Get(
     *     path="/api/users/{user}/export",
     *     tags={"Users"},
     *     summary="Export pdf file",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *          @OA\JsonContent(
     *              @OA\Property (
     *                  property="url",
     *                  type="string",
     *                  description="Url to downloading pdf"
     *              )
     *          )
     *     ),
     * )
     */
    public function export(FileService $service, User $user)
    {
        $this->authorize('export', $user);

        return response()->json([
            'link' => $service->getLink($user),
        ]);
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{user}",
     *     tags={"Users"},
     *     summary="Delete user",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
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
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/users/{user}/restore",
     *     tags={"Users"},
     *     summary="Restore user",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
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
    public function restore(User $user)
    {
        $this->authorize('restore', $user);
        $user->restore();

        return response()->json([
            'message' => 'User restored',
        ]);
    }

    /**
     * @OA\Delete (
     *     path="/api/users/{user}/force_delete",
     *     tags={"Users"},
     *     summary="Force delete user",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="user",
     *         in="path",
     *         description="User id",
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
    public function forceDelete(User $user)
    {
        $this->authorize('forceDelete', $user);
        $user->forceDelete();

        return response()->json([
            'message' => 'User deleted',
        ]);
    }
}
