<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id ,
            'user_name'=>$this->user_name ,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'address'=>$this->address,
            'gender'=>$this->gender ,
            'status'=>$this->status ,
            'created_at'=>$this->created_at->format('Y-m-d') ,
        ];
    }
}
