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
        $category = ['Humor', 'Jogos', 'Educação','História','Crimes reais',
        'Documentário','Notícias e Política',
        'Esporte e lazer','Cultura','Estilo de vida e Saúde','Negócios','Tecnologia',
        'Arte e Entretenimento', 'Música'
        ];

        foreach($category as $cat){
            DB::table('categorias')->insert([
                'type' => $cat,
            ]);
        }
    }
}
