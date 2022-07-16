<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentUser as CommentUserResource;

class Comment extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'=>$this->id,
            'created_at'=>(string)$this->created_at,
            'updated_at'=>(string)$this->updated_at,
            'content'=>$this->content,
            'user'=> new CommentUserResource($this->whenLoaded('user')),//whenLoaded ne işe yarıyor?
        ];
    }
}
