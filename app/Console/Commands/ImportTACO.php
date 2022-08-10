<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Models\Food;
use App\Models\Category;

use App\Models\CMVCol;
use App\Models\AG;
use App\Models\Aminoacid;

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

    public function open_and_read ($path) {

        $taco = fopen($path, 'r');

        $header = fgetcsv($taco, filesize($path), ",");

        while ($row = fgetcsv($taco, filesize($path), ",")) {
            $nota[] = array_combine($header, $row);
        }

        fclose($taco);

        return $nota;
    }

    public function fieldTest ($field) {

        $return = null;

        $lenght = strlen($field);

        $test = (float) str_replace(",", ".", $field);

        if ($test > 0) {
            $ret = number_format($test, $lenght -1);
            $ret = (float) str_replace(",", ".", $ret);
            $return = round($ret, 4);
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
        
        $this->info("Iniciando importação da Tabela TACO");

        // $this->call('cache:clear');

        $cmvcol_path = "/var/www/html/storage/app/public/csvs/cmvcol.csv";
        $ag_path = "/var/www/html/storage/app/public/csvs/ag.csv";
        $amino_path = "/var/www/html/storage/app/public/csvs/amino.csv";

        if(!File::exists($cmvcol_path)) \Log::info('Falha no cmvcol');
        if(!File::exists($ag_path)) \Log::info('Falha no ag');
        if(!File::exists($amino_path)) \Log::info('Falha no amino');

        // lidando com o cmvcol

        $cmvcol_note = $this->open_and_read($cmvcol_path);

        $categories = Category::get();

        foreach($cmvcol_note as $k => $n) {

            $cat = $categories->where('name', 'like', strtolower($n['category']))->first();

            $f = [
                "name" => $n['description'],
                "category_id" => $cat->id
            ];

            $food = Food::create($f);

            $cmvcol = CMVCol::create([
                'food_id' => $food->id,
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

        $this->info("CMVCol concluído");

        // lidando com o ag

        $ag_note = $this->open_and_read($ag_path);

        foreach ($ag_note as $k => $g) {

            $ag = AG::create([
                'food_id' => $g['id'],
                'saturated_g' => $this->fieldTest($g['saturated_g']),
                'monounsaturated_g' => $this->fieldTest($g['monounsaturated_g']),
                'polyunsaturated_g' => $this->fieldTest($g['polyunsaturated_g']),
                'ag_12_0_g' => $this->fieldTest($g['12:0_g']),
                'ag_14_0_g' => $this->fieldTest($g['14:0_g']),
                'ag_16_0_g' => $this->fieldTest($g['16:0_g']),
                'ag_18_0_g' => $this->fieldTest($g['18:0_g']),
                'ag_20_0_g' => $this->fieldTest($g['20:0_g']),
                'ag_22_0_g' => $this->fieldTest($g['22:0_g']),
                'ag_24_0_g' => $this->fieldTest($g['24:0_g']),
                'ag_14_1_g' => $this->fieldTest($g['14:1_g']),
                'ag_16_1_g' => $this->fieldTest($g['16:1_g']),
                'ag_18_1_g' => $this->fieldTest($g['18:1_g']),
                'ag_20_1_g' => $this->fieldTest($g['20:1_g']),
                'ag_18_2_n_6_g' => $this->fieldTest($g['18:2 n-6_g']),
                'ag_18_3_n_3_g' => $this->fieldTest($g['18:3 n-3_g']),
                'ag_20_4_g' => $this->fieldTest($g['20:4_g']),
                'ag_20_5_g' => $this->fieldTest($g['20:5_g']),
                'ag_22_5_g' => $this->fieldTest($g['22:5_g']),
                'ag_22_6_g' => $this->fieldTest($g['22:6_g']),
                'ag_18_1t_g' => $this->fieldTest($g['18:1t_g']),
                'ag_18_2t_g' => $this->fieldTest($g['18:2t_g']),
            ]);
        }

        $this->info("Ácido Graxo concluído");

        // lidando com o amino

        $amino_note = $this->open_and_read($amino_path);

        foreach ($amino_note as $k => $am) {

            $amino = Aminoacid::create([
                'food_id' => $am['id'],
                'tryptophan_g' => $this->fieldTest($am['tryptophan_g']),
                'threonine_g' => $this->fieldTest($am['threonine_g']),
                'isoleucine_g' => $this->fieldTest($am['isoleucine_g']),
                'leucine_g' => $this->fieldTest($am['leucine_g']),
                'lysine_g' => $this->fieldTest($am['lysine_g']),
                'methionine_g' => $this->fieldTest($am['methionine_g']),
                'cystine_g' => $this->fieldTest($am['cystine_g']),
                'phenylalanine_g' => $this->fieldTest($am['phenylalanine_g']),
                'tyrosine_g' => $this->fieldTest($am['tyrosine_g']),
                'valine_g' => $this->fieldTest($am['valine_g']),
                'arginine_g' => $this->fieldTest($am['arginine_g']),
                'histidine_g' => $this->fieldTest($am['histidine_g']),
                'alanine_g' => $this->fieldTest($am['alanine_g']),
                'aspartic_g' => $this->fieldTest($am['aspartic_g']),
                'glutamic_g' => $this->fieldTest($am['glutamic_g']),
                'glycine_g' => $this->fieldTest($am['glycine_g']),
                'proline_g' => $this->fieldTest($am['proline_g']),
                'serine_g' => $this->fieldTest($am['serine_g']),
            ]);
        }

        $this->info("Aminoácido concluído");
    }
}
