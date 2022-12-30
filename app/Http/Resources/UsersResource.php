<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UsersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => (string)$this->id,
            "fio" => $this->fio,
            "birth_date" => $this->birth_date,
            "group_id" => (string)$this->group_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "address" => $this->address,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role,
            "avatar" => $this->avatar,
        ];
    }
}
