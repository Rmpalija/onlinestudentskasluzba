<?php

use Illuminate\Database\Seeder;

class ProfesoriSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'ime' => 'Gordana', 'prezime' => 'Radić', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],
            ['id' => 3, 'ime' => ' Zoran Ž. ', 'prezime' => 'Avramović', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],
            ['id' => 4, 'ime' => 'Mišo', 'prezime' => 'Kulić', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],
            ['id' => 5, 'ime' => 'Nedim', 'prezime' => 'Smailović', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],
            ['id' => 6, 'ime' => 'Željko', 'prezime' => 'Stanković', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],
            ['id' => 7, 'ime' => 'Siniša', 'prezime' => 'Tomić', 'zvanje' => 'Doc. dr', 'status' => 'redovan',],
            ['id' => 8, 'ime' => 'Branko', 'prezime' => 'Latinović', 'zvanje' => 'Prof. dr', 'status' => 'redovan',],

        ];

        foreach ($items as $item) {
            \App\Profesori::create($item);
        }
    }
}
