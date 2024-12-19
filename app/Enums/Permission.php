<?php
namespace App\Enums;

class Permission
{

CONST DATA = array(
        'users' => [
            'dashboard',
            'list',
            'create',
            'edit',
            'view',
            'delete',
            'profile-view',
            'profile-update',
        ],
        'roles' => [
            'list',
            'create',
            'edit',
            'view',
            'delete',
        ],
        'customers' => [
            'list',
            'create',
            'edit',
            'view',
            'delete',
        ],
        'consignments' => [
            'list',
            'create',
            'edit',
            'view',
            'print',
            'delete',
        ],
        'payorders' => [
            'list',
            'create',
            'edit',
            'view',
            'print',
            'delete',
        ],
        'delivery-challans' => [
            'list',
            'create',
            'print',
            'delete',
        ],
        'delivery-intimation' => [
            'list',
            'create',
            'print',
            'delete',
        ],
        'masters' => [
            'menu',
            'locations',
            'pol',
            'pod',
            'vessels',
            'documents',
        ],
        'settings' => [
            'menu',
            'general',
            'theme',
        ],
        'reports' => [
            'customerstatement',
            'jobstatus',
            'jobstracking',
        ],
    
    );

}