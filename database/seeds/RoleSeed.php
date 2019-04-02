<?php

use Illuminate\Database\Seeder;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'Administrator (can create other users)',],
            ['id' => 3, 'title' => 'Student',],
            ['id' => 4, 'title' => 'Profesor',],
            ['id' => 5, 'title' => 'Racunovodstvo',],
            ['id' => 6, 'title' => 'Studentska sluzba',],

        ];

        foreach ($items as $item) {
            \App\Role::create($item);
        }
    }
}
