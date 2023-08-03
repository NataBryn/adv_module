<?php

    namespace Modules\Banners\Database\Seeders;

    use Illuminate\Database\Seeder;
    use Illuminate\Database\Eloquent\Model;
    use Modules\Banners\Entities\Region;

    class SeedRegionsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            $regions = [
                ['name' => 'По всій Україні'],
                ['name' => 'Київська область'],
                ['name' => 'АРК'],
                ['name' => 'Вінницька область'],
                ['name' => 'Волинська область'],
                ['name' => 'Дніпропетровська область'],
                ['name' => 'Донецька область'],
                ['name' => 'Житомирська область'],
                ['name' => 'Закарпатська область'],
                ['name' => 'Запорізька область'],
                ['name' => 'Івано-Франківська область'],
                ['name' => 'Кіровоградська область'],
                ['name' => 'Луганська область'],
                ['name' => 'Львівська область'],
                ['name' => 'Миколаївська область'],
                ['name' => 'Одеська область'],
                ['name' => 'Полтавська область'],
                ['name' => 'Рівненська область'],
                ['name' => 'Сумська область'],
                ['name' => 'Тернопільська область'],
                ['name' => 'Харківська область'],
                ['name' => 'Херсонська область'],
                ['name' => 'Хмельницька область'],
                ['name' => 'Черкаська область'],
                ['name' => 'Чернівецька область'],
                ['name' => 'Чернігівська область'],
            ];

            foreach ($regions as $region) {
                Region::updateOrcreate($region);
            }

        }
    }
