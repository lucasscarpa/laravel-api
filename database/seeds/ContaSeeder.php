<?php

use Illuminate\Database\Seeder;

use App\Models\Conta;

class ContaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Conta::class, 5)->create();
    }
}
