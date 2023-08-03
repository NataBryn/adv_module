<?php

    namespace Modules\Banners\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Database\Eloquent\Model;
    use Modules\Banners\Entities\Size;

    class SeedSizesTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            $sizes = [
                ['alias' => 'banner_1', 'name' => '300x250'],
                ['alias' => 'banner_2', 'name' => '300x600'],
                ['alias' => 'banner_3', 'name' => '728x90'],
            ];

            foreach ($sizes as $size) {
                Size::updateOrcreate($size);
            }

        }
    }
