<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Food;
use App\Models\Category;

use App\Models\Variation;
use App\Models\CMVCol;

class ImportTACO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importaco';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa a Tabela TACO.';


    public function fieldTest ($field) {

        $return = null;

        if (floatval($field) != 0) {

            $replaced = str_replace(",", ".", $field);

            $return = round(floatval($replaced), 3);
        }

        return $return;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        // abrindo o csv
        // $path = storage_path('app/public/csvs/cmvcol.csv');

        $caminho = "/var/www/html/storage/app/public/csvs/cmvcol.csv";

        if(!File::exists($caminho)) {
            \Log::info('Deu merda');
        }

        $taco_1 = fopen($caminho, 'r');

        $header = fgetcsv($taco_1, filesize($caminho), ",");

        while ($row = fgetcsv($taco_1, filesize($caminho), ",")) {
            $nota[] = array_combine($header, $row);
        }

        \Log::info($nota);

        $categories = Category::get();

        foreach($nota as $k => $n) {

            $cat = $categories->where('name', 'like', strtolower($n['category']))->first();

            $f = [
                "name" => $n['description'],
                "scientific_name" => "",
                "category_id" => $cat->id
            ];

            $food = Food::create($f);

            $variation = Variation::create([
                'name' => $n['description'],
                'food_id' => $food->id
            ]);

            $cmvcol = CMVCol::create([
                'variation_id' => $variation->id,
                'humidity_percents' => $this->fieldTest($n['humidity_percents']),
                'energy_kcal' => $this->fieldTest($n['energy_kcal']),
                'energy_kj' => $this->fieldTest($n['energy_kj']),
                'protein_g' => $this->fieldTest($n['protein_g']),
                'lipidius_g' => $this->fieldTest($n['lipidius_g']),
                'cholesterol_mg' => $this->fieldTest($n['cholesterol_mg']),
                'carbohydrate_g' => $this->fieldTest($n['carbohydrate_g']),
                'fiber_g' => $this->fieldTest($n['fiber_g']),
                'ashes_g' => $this->fieldTest($n['ashes_g']),
                'calcium_mg' => $this->fieldTest($n['calcium_mg']),
                'magnesium_mg' => $this->fieldTest($n['magnesium_mg']),
                'manganese_mg' => $this->fieldTest($n['manganese_mg']),
                'phosphorus_mg' => $this->fieldTest($n['phosphorus_mg']),
                'iron_mg' => $this->fieldTest($n['iron_mg']),
                'sodium_mg' => $this->fieldTest($n['sodium_mg']),
                'potassium_mg' => $this->fieldTest($n['potassium_mg']),
                'copper_mg' => $this->fieldTest($n['copper_mg']),
                'zinc_mg' => $this->fieldTest($n['zinc_mg']),
                'retinol_mcg' => $this->fieldTest($n['retinol_mcg']),
                're_mcg' => $this->fieldTest($n['re_mcg']),
                'rae_mcg' => $this->fieldTest($n['rae_mcg']),
                'tiamina_mg' => $this->fieldTest($n['tiamina_mg']),
                'riboflavin_mg' => $this->fieldTest($n['riboflavin_mg']),
                'pyridoxine_mg' => $this->fieldTest($n['pyridoxine_mg']),
                'niacin_mg' => $this->fieldTest($n['niacin_mg']),
                'vitaminC_mg' => $this->fieldTest($n['vitaminC_mg']),
            ]);
        }

        fclose($taco_1);
    }
}
