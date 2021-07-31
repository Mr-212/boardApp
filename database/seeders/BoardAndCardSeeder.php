<?php

namespace Database\Seeders;

use App\Models\Board;
use Database\Factories\BoardFactory;
use Illuminate\Database\Seeder;
use App\Models\Card;

class BoardAndCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Board::factory()->create()->each(function(){
        //     Card::factory()->count(4)->create();
        // });
        Board::factory()->count(5)->has(Card::factory()->count(4))->create();
        // Card::factory()->count(4)->create();
    }
}
