<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{

    public function toArray($request)
    {
        return [
           'id'=> $this->id ,
           'name'=> $this->name ,
           'guard_name'=> $this->guard_name ,
           'status'=> $this->status ,
           'created_at'=> date_format($this->created_at,'Y-m-d : H-m') ,
        ];
    }
}
