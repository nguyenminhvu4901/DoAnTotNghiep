<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Domains\Auth\Services\PermissionService;
use App\Domains\Auth\Services\RoleService;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
    use DisableForeignKeys;

    protected RoleService $roleService;
    protected PermissionService $permissionService;

    public function __construct(RoleService $roleService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }
    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        // Create Roles
        $roleData = [
            [
                'id' => 1,
                'type' => User::TYPE_ADMIN,
                'name' => User::ROLE_ADMIN,
            ],
            [
                'id' => 2,
                'type' => User::TYPE_USER,
                'name' => User::ROLE_STAFF,
            ],
            [
                'id' => 3,
                'type' => User::TYPE_USER,
                'name' => User::ROLE_CUSTOMER,
            ]
        ];

        foreach ($roleData as $eachRole) {
            if (!$this->roleService->isExistByName($eachRole['name'])) {
                Role::create($eachRole);
            }
        }

        // Create Permissions
        $permissionData = [
            [
                'type' => User::TYPE_ADMIN,
                'name' => 'admin.access.user',
                'description' => 'All User Permissions',
                'children' => [
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.list',
                        'description' => 'View Users',
                    ],
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.deactivate',
                        'description' => 'Deactivate Users',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.reactivate',
                        'description' => 'Reactivate Users',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.clear-session',
                        'description' => 'Clear User Sessions',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.impersonate',
                        'description' => 'Impersonate Users',
                        'sort' => 5,
                    ],
                    [
                        'type' => User::TYPE_ADMIN,
                        'name' => 'admin.access.user.change-password',
                        'description' => 'Change User Passwords',
                        'sort' => 6,
                    ]
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.category',
                'description' => 'Category management',
                'sort' => 2,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.create',
                        'description' => 'Create category',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.edit',
                        'description' => 'Edit category',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.view',
                        'description' => 'View list category',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.disabled',
                        'description' => 'Disable category',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.detail',
                        'description' => 'Detail category',
                        'sort' => 5,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.category.trash',
                        'description' => 'Trash category',
                        'sort' => 6,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.product',
                'description' => 'Product management',
                'sort' => 3,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.create',
                        'description' => 'Create product',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.edit',
                        'description' => 'Edit product',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.view',
                        'description' => 'View list product',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.disabled',
                        'description' => 'Disable product',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.detail',
                        'description' => 'Detail product',
                        'sort' => 5,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.product.trash',
                        'description' => 'Trash product',
                        'sort' => 6,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.management',
                'description' => 'Account management',
                'sort' => 4,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.management.staff',
                        'description' => 'User management staff',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.management.customer',
                        'description' => 'User management customer',
                        'sort' => 2,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.cart',
                'description' => 'Cart management',
                'sort' => 5,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.cart.create',
                        'description' => 'Create cart',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.cart.edit',
                        'description' => 'Edit cart',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.cart.view',
                        'description' => 'View list cart',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.cart.disabled',
                        'description' => 'Disable cart',
                        'sort' => 4,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.coupon',
                'description' => 'Coupon management',
                'sort' => 6,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.coupon.create',
                        'description' => 'Create coupon',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.coupon.edit',
                        'description' => 'Edit coupon',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.coupon.view',
                        'description' => 'View list coupon',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.coupon.disabled',
                        'description' => 'Disable coupon',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.coupon.detail',
                        'description' => 'Detail coupon',
                        'sort' => 5,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.order',
                'description' => 'Order management',
                'sort' => 7,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.order.create',
                        'description' => 'Create order',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.order.edit',
                        'description' => 'Edit order',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.order.view',
                        'description' => 'View list order',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.order.disabled',
                        'description' => 'Disable order',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.order.detail',
                        'description' => 'Detail order',
                        'sort' => 5,
                    ],
                ]
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.role-permission.management',
                'description' => 'Role - Permission management',
                'sort' => 8
            ],
            [
                'type' => User::TYPE_USER,
                'name' => 'user.sale',
                'description' => 'Sale management',
                'sort' => 9,
                'children' => [
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.sale.create',
                        'description' => 'Create sale',
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.sale.edit',
                        'description' => 'Edit sale',
                        'sort' => 2,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.sale.view',
                        'description' => 'View list sale',
                        'sort' => 3,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.sale.disabled',
                        'description' => 'Disable sale',
                        'sort' => 4,
                    ],
                    [
                        'type' => User::TYPE_USER,
                        'name' => 'user.sale.detail',
                        'description' => 'Detail sale',
                        'sort' => 5,
                    ],
                ]
            ],
        ];

        foreach ($permissionData as $eachPermission) {
            // Insert parents
            $parent = $this->permissionService->findByNameAndType($eachPermission['name'], $eachPermission['type']);
            if (!$parent) {
                $permissionExcludeChild = array_diff_key($eachPermission, array_flip(['children']));
                $parent = Permission::create($permissionExcludeChild);
            }
            // Insert children
            if (array_key_exists('children', $eachPermission)) {
                $children = [];
                foreach ($eachPermission['children'] as $eachChild) {
                    if (!$this->permissionService->findByNameAndType($eachChild['name'], $eachChild['type'])) {
                        $children[] = new Permission($eachChild);
                    }
                }
                $parent->children()->saveMany($children);
            }
        }

        // Assign Permissions to other Roles
        // env for manual run
        $refreshRolePermissions = env('REFRESH_ROLE_PERMISSION', false);
        // Staff
        $roleStaff = Role::find(2);
        $this->syncPermissionsForRole($roleStaff, [
            //Category
            'user.category',
            'user.category.create',
            'user.category.edit',
            'user.category.view',
            'user.category.disabled',
            'user.category.detail',
            'user.category.trash',

            //Product
            'user.product',
            'user.product.create',
            'user.product.edit',
            'user.product.view',
            'user.product.disabled',
            'user.product.detail',
            'user.category.trash',

            //Cart
            'user.cart',
            'user.cart.create',
            'user.cart.edit',
            'user.cart.view',
            'user.cart.disabled',

            //Coupon
            'user.coupon.view',
            'user.coupon.detail',

            //Order
            'user.order',
            'user.order.create',
            'user.order.edit',
            'user.order.view',
            'user.order.disabled',
            'user.order.detail',

            //Sale
            'user.sale.view'
        ], $refreshRolePermissions);

        // Customer
        $roleCustomer = Role::find(3);
        $this->syncPermissionsForRole($roleCustomer, [
            //Category
            'user.category.view',
            'user.category.detail',

            //Product
            'user.product.view',
            'user.product.detail',

            //Cart
            'user.cart',
            'user.cart.create',
            'user.cart.edit',
            'user.cart.view',
            'user.cart.disabled',

            //Coupon
            'user.coupon.view',
            'user.coupon.detail',

            //Order
            'user.order',
            'user.order.create',
            'user.order.edit',
            'user.order.view',
            'user.order.disabled',
            'user.order.detail',

            //Sale
            'user.sale.view'
        ], $refreshRolePermissions);

        $this->enableForeignKeys();
    }

    /**
     * @param Role $role
     * @param array $permissions
     * @param bool $refresh
     * @return void
     */
    private function syncPermissionsForRole(Role $role, array $permissions, bool $refresh): void
    {
        if ($refresh || $role->permissions->count() == 0) {
            $role->syncPermissions($permissions);
        }
    }
}
