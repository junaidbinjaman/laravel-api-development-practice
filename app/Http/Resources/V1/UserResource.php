<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $verified_at
 * @property string $password
 * @property string $created_at
 * @property string $updated_at
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'users',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                $this->mergeWhen($request->routeIs('users.*'), [
                    'email_verified_at' => $this->verified_at,
                    'created_at' => $this->created_at,
                    'updated_at' => $this->updated_at,
                ])
            ],
            'include' => TicketResource::collection($this->whenLoaded('tickets')),
            'links' => [
                'self' => route('users.show', ['user' => $this->id])
            ]
        ];
    }
}
