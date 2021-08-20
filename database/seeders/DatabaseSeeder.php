<?php

namespace Database\Seeders;

use App\Models\Bankje;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            bankjesSeeder::class,
            picnicBankjesSeeder::class,
            schuilHutSeeder::class,
        ]);
      
            }
        }
