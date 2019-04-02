<?php

use Illuminate\Database\Seeder;

class ProfesoriSeedPivot extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            2 => [
                'fakultet' => [2, 4],
                'predmeti' => [],
            ],
            3 => [
                'fakultet' => [4],
                'predmeti' => [],
            ],
            4 => [
                'fakultet' => [2, 3, 4, 5, 6, 7, 8],
                'predmeti' => [],
            ],
            5 => [
                'fakultet' => [4],
                'predmeti' => [],
            ],
            6 => [
                'fakultet' => [4],
                'predmeti' => [],
            ],
            7 => [
                'fakultet' => [4],
                'predmeti' => [],
            ],
            8 => [
                'fakultet' => [4],
                'predmeti' => [],
            ],

        ];

        foreach ($items as $id => $item) {
            $profesori = \App\Profesori::find($id);

            foreach ($item as $key => $ids) {
                $profesori->{$key}()->sync($ids);
            }
        }
    }
}
