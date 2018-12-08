<?php

namespace App\Http\Helpers;

class CheckPermission{

    public $permissions;

    public function __construct()
    {
        $this->permissions = app()->make('Permissions');
    }

    public function checkPermission($action,$type){
        $result = $this->permissions->getPermissionByActionAndType($action,$type);
        if($result){
            $perm = $result[0]->permission;
            return $perm;
        } else {
            return 0;
        }
    }
}
