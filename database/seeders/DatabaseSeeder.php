<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // UserTypes
        $user_types = ["Regular", "Nutritionist"];

        foreach ($user_types as $ut) {
            \App\Models\UserType::create(['name' => $ut]);
        }

        // Genders
        $genders = ["Feminino", "Masculino"];

        foreach ($genders as $g) {
            \App\Models\Gender::create(['name' => $g]);
        }

        // Activity Levels
        $activity_levels = ["Sedentário", "Leve", "Moderado", "Intenso", "Muito Intenso"];

        foreach ($activity_levels as $al) {
            \App\Models\ActivityLevel::create(['name' => $al]);
        }

        // Formulas
        $formulas = ["Harris-Benedict", "Mifflin St-Jeor", "FAO/OMS"];

        foreach ($formulas as $f) {
            \App\Models\Formula::create(['name' => $f]);
        }

        // Users
        \App\Models\User::factory(10)->create();

        // Specific User
        $nutri = \App\Models\User::create([
            'name' => 'Ademir Nutri',
            'email' => 'ademir@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'api_token' => 'token',
            'remember_token' => Str::random(10),
            'phone' => '55' + strval(rand(911111111, 999999999)),
            'user_type_id' => 2,
            'gender_id' => 2,
            'activity_level_id' => rand(1, 4),
            'weight' => rand(6500, 12000),
            'height' => rand(165, 199),
            'birthday' => '1980-07-31',
            'formula_id' => rand(1, 3)
        ]);

        $users = \App\Models\User::where('user_type_id', 1)->get();

        foreach ($users as $u) {
            $u->nutritional_guidance->update(['nutritionist_id' => $nutri->id]);
        }
        
        $categories = ["Cereais e Derivados", "Verduras, Hortaliças e Derivados", 
            "Frutas e Derivados", "Gorduras e óleos", "Pescados e Frutos do Mar", 
            "Carnes e Derivados", "Leite e Derivados", "Bebidas (Alcoólicas e não Alcoólicas)", 
            "Ovos e Derivados", "Produtos Açucarados", "Miscelâneas", "Outros Alimentos Industrializados", 
            "Alimentos Preparados", "Leguminosas e Derivados", "Nozes e Sementes"];
        
        foreach ($categories as $c) {
            \App\Models\Category::create(['name' => strtolower($c)]);
        }
    }
}
