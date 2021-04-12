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

        // Criar usuário admin
        $validator = User::create([
            'name' => 'validator',
            'email' => 'validator@email.com',
            'password' => bcrypt('password'),
        ]);

        // Criar usuário admin
        $student = User::create([
            'name' => 'student',
            'email' => 'student@email.com',
            'password' => bcrypt('password'),
        ]);

        // Permissões Iniciais e usuário admin padrão - Initial Permissions and default admin user
        $roleAdmin   = Role::create(['name' => 'admin']);
        $roleStudent = Role::create(['name' => 'student']);
        $releValidator   = Role::create(['name' => 'validator']);

        $permissionStoreUsers = Permission::create(['name' => 'store users']);
        $permissionUpdateUsers = Permission::create(['name' => 'update users']);
        $permissionStoreAxle = Permission::create(['name' => 'store axles']);
        $permissionUpdateAxle = Permission::create(['name' => 'update axles']);
        $permissionDeleteAxle = Permission::create(['name' => 'delete axles']);

        $permissionStoreCareers = Permission::create(['name' => 'store careers']);
        $permissionUpdateCareers = Permission::create(['name' => 'update careers']);
        $permissionDeleteCareers = Permission::create(['name' => 'delete careers']);

        $permissionStoreCertificates = Permission::create(['name' => 'store certificates']);
        $permissionShowCertificates = Permission::create(['name' => 'show certificates']);
        $permissionListCertificates = Permission::create(['name' => 'list certificates']);
        $permissionUpdateCertificates = Permission::create(['name' => 'update certificates']);
        $permissionDeleteCertificates = Permission::create(['name' => 'delete certificates']);

        $permissionValidateCertificates = Permission::create(['name' => 'validate certificates']);
        $permissionListAllCertificates = Permission::create(['name' => 'list all certificates']);
        $permissionShowAllCertificates = Permission::create(['name' => 'show all certificates']);

        // // Give permissions to Admin
        $roleAdmin->givePermissionTo($permissionStoreUsers);
        $roleAdmin->givePermissionTo($permissionUpdateUsers);
        $roleAdmin->givePermissionTo($permissionStoreAxle);
        $roleAdmin->givePermissionTo($permissionUpdateAxle);
        $roleAdmin->givePermissionTo($permissionDeleteAxle);
        $roleAdmin->givePermissionTo($permissionStoreCareers);
        $roleAdmin->givePermissionTo($permissionUpdateCareers);
        $roleAdmin->givePermissionTo($permissionDeleteCareers);

        // // Give permissions to Student
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
        $validator->assignRole('validator');
        $student->assignRole('student');

    }
}
