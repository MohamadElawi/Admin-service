<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable ,HasRoles ,SoftDeletes;

    protected $fillable = [
        'last_name','first_name','user_name','email','phone','password','vcode','gender','status','device_token' ,'address'
    ];

    protected $appends =['all_roles','all_permissions'];
    protected $guard_name ='user';

    protected $hidden = [
        'password',
        'remember_token',
        'roles',
        'permissions'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    public function getAllRolesAttribute($value){
        return $this->getRoleNames()->toArray();
    }

    public function getAllPermissionsAttribute(){
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
