<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class roleHasPermissionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_super_admin = Role::findByName('Super Admin');
        $permissions = Permission::all();
        $role_super_admin->givePermissionTo($permissions);
        
        $role_admin = Role::findByName('Admin');
        $role_admin->givePermissionTo('dashboard_menu','dashboard_view','role_menu','role_create','role_view','permission_menu','permission_create','permission_view','manage_user_menu','user_create','users_view','user_profile_view','user_permission_view','user_password_change','personal_profile_view','personal_user_update','personal_password_change','all_menu_show');
       
        $role_user = Role::findByName('User');
        $role_user->givePermissionTo('dashboard_menu','dashboard_view','personal_profile_view','personal_user_update','personal_password_change','all_menu_show');
    }
}
