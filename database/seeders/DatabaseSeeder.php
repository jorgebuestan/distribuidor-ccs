<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RolesAndPermissionsSeeder::class); 
        $this->call(PaisSeeder::class);   
        $this->call(ProvinciaSeeder::class); 
        $this->call(CantonSeeder::class); 
        $this->call(TipoDocumentoSeeder::class); 
        $this->call(TipoSexoSeeder::class); 
        $this->call(TipoSolicitudSeeder::class); 
        $this->call(TipoVigenciaSeeder::class); 
        $this->call(TipoAmbienteSeeder::class);
        $this->call(TipoContribuyenteSeeder::class);
        
        //$this->call(UserSeeder::class);  
    }
}
