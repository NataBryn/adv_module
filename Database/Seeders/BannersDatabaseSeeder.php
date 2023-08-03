<?php

    namespace Modules\Banners\Database\Seeders;

    use Illuminate\Database\Seeder;

    class BannersDatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $this->call([
                SeedRegionsTableSeeder::class,
                SeedSizesTableSeeder::class,
            ]);
        }
    }
