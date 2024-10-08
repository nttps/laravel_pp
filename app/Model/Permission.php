<?php

namespace NttpDev\Model;

use Spatie\Permission\Models\Permission as PermissionExtend;

class Permission extends PermissionExtend
{
    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',
            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',
            'view_products',
            'add_products',
            'edit_products',
            'delete_products',
            // 'delete_orders',
            // 
            // 'add_orders',
            // 'edit_orders',
            'view_orders',
            
        ];
    }
}
