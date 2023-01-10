<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupsResource;
use App\Models\Group;

class GroupController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/groups",
     *     tags={"Groups"},
     *     summary="Get groups list",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         content={
     *             @OA\MediaType(
     *                 mediaType="application/json",
     *                 @OA\Schema(
     *                      @OA\Property(
     *                         property="groups",
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
     *                                 description="Group name"
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
       return GroupsResource::collection(Group::all());
    }

    /**
     * @OA\Post(
     *     path="/api/groups",
     *     tags={"Groups"},
     *     summary="Store group",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Group name"
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
    public function store(StoreGroupRequest $request)
    {
        $this->authorize('create', Group::class);
        $group = Group::create($request->validated());

        return new GroupsResource($group);
    }

    /**
     * @OA\Get(
     *     path="/api/groups/{group}",
     *     tags={"Groups"},
     *     summary="Show group",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="group",
     *         in="path",
     *         description="Group id",
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
     *                         property="group",
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
     *                                 description="Group name"
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
    public function show(Group $group)
    {
        return new GroupsResource($group);
    }

    /**
     * @OA\Put(
     *     path="/api/groups/{group}",
     *     tags={"Groups"},
     *     summary="Update group",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="group",
     *         in="path",
     *         description="Group id",
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="name",
     *                     type="string",
     *                     description="Group name"
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
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $this->authorize('update', $group);
        $group->update($request->validated());

        return new GroupsResource($group);
    }

    /**
     * @OA\Delete (
     *     path="/api/groups/{group}",
     *     tags={"Groups"},
     *     summary="Delete group",
     *     security={{"bearerAuth":{}}},
     *      @OA\Parameter(
     *         name="group",
     *         in="path",
     *         description="Group id",
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
    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);
        $group->delete();

        return response()->json([
            'message' => 'Group deleted',
        ]);
    }
}
