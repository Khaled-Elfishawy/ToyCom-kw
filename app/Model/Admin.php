<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
protected $fillable=['f_name','l_name','email','phone','password','password_confirmation','role_id','remember_token','image'];
    protected $guard = 'admin';

    protected $guard_name='admin';



}
