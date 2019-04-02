<?php

use Illuminate\Database\Seeder;

class FakultetiSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 2, 'naziv' => 'FPE - Fakultet Poslovne Ekonomije',],
            ['id' => 3, 'naziv' => 'FPN - Fakultet Pravnih Nauka',],
            ['id' => 4, 'naziv' => 'FIT - Fakultet Informacionih Tehnologija',],
            ['id' => 5, 'naziv' => 'FSN - Fakultet Sportskih Nauka',],
            ['id' => 6, 'naziv' => 'FZN - Fakultet Zdravstvenih Nauka',],
            ['id' => 7, 'naziv' => 'FFN - Fakultet Filoloskih Nauka',],
            ['id' => 8, 'naziv' => 'Saobracajni Fakultet',],

        ];

        foreach ($items as $item) {
            \App\Fakulteti::create($item);
        }
    }
}
