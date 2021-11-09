<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = ['Humor', 'Jogos', 'Educação','História','Documentário','Notícias',
        'Esporte','Estilo de vida','Negócios','Tecnologia','Arte', 'Música'];

        foreach($category as $cat){
            DB::table('categorias')->insert([
                'type' => $cat,
            ]);
        }
    }
}
