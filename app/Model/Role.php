<?php

namespace App\Model;

class Role extends \Spatie\Permission\Models\Role
{
    protected $guard = 'admin';

    protected $guard_name='admin';
}
