<?php

namespace Database\Seeders;

use App\Models\Urun;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;




class UrunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Urun::truncate();

        for ($i=0;$i<30;$i++){
            $urun_adi = $faker->sentence(2);
            Urun::create(
                [
                    'urun_adi'=> $urun_adi,
                    'slug'=>str::slug($urun_adi),
                    'aciklama'=>$faker->sentence(20),
                    'fiyati' => $faker->randomFloat(3,1,20)

                ]
            );
        }
    }
}
