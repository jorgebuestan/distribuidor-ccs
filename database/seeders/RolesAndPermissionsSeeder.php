<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Verificar si los roles ya existen y crearlos si no están
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Crear usuario administrador si no existe
        $adminUser = User::where('email', 'admin@admin.com')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
            ]);
            $adminUser->assignRole($adminRole);
        }

        // Crear usuario normal si no existe
        $normalUser = User::where('email', 'user@user.com')->first();
        if (!$normalUser) {
            $normalUser = User::create([
                'name' => 'Usuario Normal',
                'email' => 'user@user.com',
                'password' => Hash::make('user123'),
            ]);
            $normalUser->assignRole($userRole);
        }
    }
}
