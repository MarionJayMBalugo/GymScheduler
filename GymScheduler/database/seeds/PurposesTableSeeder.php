<?php

use Illuminate\Database\Seeder;

class PurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if( !DB::table('purposes')->count() ) {
            DB::table('purposes')->insert([
                [
                    'name' => 'Volleyball',
                    'color' => '#ff0000'
                ],
                [
                    'name' => 'Basketball',
                    'color' => '#00FF00'
                ],
                [
                    'name' => 'Badminton',
                    'color' => '#ffff00'
                ],
                [
                    'name' => 'Others',
                    'color' => '#EE82EE'
                ],
                [
                    'name' => 'Not Available',
                    'color' => '#0000ff'
                ]
            ]);
        }
    }
}
