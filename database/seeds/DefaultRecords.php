<?php

use Illuminate\Database\Seeder;

class DefaultRecords extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);
        DB::table('service_types')->insert(
                [['title' => 'Facebook'], ['title' => 'Youtube'], ['title' => 'Twitter '], ['title' => 'Instagram']
        ]);
    }

}
