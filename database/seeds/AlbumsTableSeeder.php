<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Album;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Album::truncate();
        factory(Album::class,30)->create();
    }
}
