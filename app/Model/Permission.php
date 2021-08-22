<?php

namespace App\Model;

class Permission extends \Spatie\Permission\Models\Permission
{
    protected $guard = 'admin';

    protected $guard_name='admin';


}
