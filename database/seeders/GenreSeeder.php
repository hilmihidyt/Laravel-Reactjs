<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = collect([
            'Speed Metal',
            'Heavy Metal',
            'Thrash Metal',
            'Power Metal',
            'Death Metal',
            'Black Metal',
            'Pagan Metal',
            'Viking Meta',
            'Folk Metal',
            'Symphonic Metal',
            'Gothic Metal',
            'Glam Metal',
            'Hair Metal',
            'Doom Metal',
            'Groove Metal',
            'Industrial Metal',
            'Modern Metal'
        ]);

        $genres->each(function($genre ){
            Genre::create([
                'name' => $genre,
                'slug' => \Str::slug($genre)
            ]);
        });
    }
}
