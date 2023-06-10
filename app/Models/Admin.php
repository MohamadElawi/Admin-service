<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory ,HasRoles;

    protected $fillable = [
        'name','email','phone','password','status','type'
    ];

    protected $appends =['all_roles','all_permissions'];

    protected $hidden = [
        'password','roles','permissions'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    public function getAllRolesAttribute($value){
        return $this->getRoleNames();
    }

    public function getAllPermissionsAttribute($value){
        return $this->getAllPermissions()->pluck('name');
    }

     ###################### jwt method
     public function getJWTIdentifier()
     {
         return $this->getKey();
     }

     /**
      * Return a key value array, containing any custom claims to be added to the JWT.
      *
      * @return array
      */
     public function getJWTCustomClaims()
     {
         return [];
     }
}
