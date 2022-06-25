<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $user_types = ["Regular", "Nutritionist", "Admin"];

        foreach ($user_types as $ut) {
            \App\Models\UserType::create(['name' => $ut]);
        }

        // Genders

        $genders = ["Feminino", "Masculino"];

        foreach ($genders as $g) {
            \App\Models\Gender::create(['name' => $g]);
        }

        // Activity Levels

        $activity_levels = ["Sedentário", "Levemente Ativo", "Ativo", "Muito Ativo"];

        foreach ($activity_levels as $al) {
            \App\Models\ActivityLevel::create(['name' => $al]);
        }

        // Users
        \App\Models\User::factory(10)->create();

        // Specific Users
        
        // \App\Models\User::factory(10)->create();
        
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
