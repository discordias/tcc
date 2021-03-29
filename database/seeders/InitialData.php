<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class InitialData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criar usuário admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('password'),
        ]);

        // Permissões Iniciais e usuário admin padrão - Initial Permissions and default admin user

        $roleAdmin   = Role::create(['name' => 'admin']);
        $roleStudent = Role::create(['name' => 'student']);
        $releValidator   = Role::create(['name' => 'validator']);

        $permissionStoreUsers = Permission::create(['name' => 'store users']);
        $permissionUpdateUsers = Permission::create(['name' => 'update users']);

        $permissionStoreCertificates = Permission::create(['name' => 'store certificates']);
        $permissionShowCertificates = Permission::create(['name' => 'show certificates']);
        $permissionListCertificates = Permission::create(['name' => 'list certificates']);
        $permissionUpdateCertificates = Permission::create(['name' => 'update certificates']);
        $permissionDeleteCertificates = Permission::create(['name' => 'delete certificates']);

        $permissionValidateCertificates = Permission::create(['name' => 'validate certificates']);
        $permissionListAllCertificates = Permission::create(['name' => 'list all certificates']);
        $permissionShowAllCertificates = Permission::create(['name' => 'show all certificates']);

        // Give permissions to Admin
        $roleAdmin->givePermissionTo($permissionStoreUsers);
        $roleAdmin->givePermissionTo($permissionUpdateUsers);

        // Give permissions to Student
        $roleStudent->givePermissionTo($permissionStoreCertificates);
        $roleStudent->givePermissionTo($permissionShowCertificates);
        $roleStudent->givePermissionTo($permissionListCertificates);
        $roleStudent->givePermissionTo($permissionUpdateCertificates);
        $roleStudent->givePermissionTo($permissionDeleteCertificates);

        // Give permissions to Validator
        $releValidator->givePermissionTo($permissionValidateCertificates);
        $releValidator->givePermissionTo($permissionListAllCertificates);
        $releValidator->givePermissionTo($permissionShowAllCertificates);

        $admin->assignRole('admin');
    }
}
