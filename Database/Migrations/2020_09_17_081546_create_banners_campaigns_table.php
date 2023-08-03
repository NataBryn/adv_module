<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBannersCampaignsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('banners_campaigns', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('contact_person');
                $table->string('email')->unique()->nullable();
                $table->string('phone')->nullable();
                $table->unsignedBigInteger('views')->default(0);
                $table->unsignedBigInteger('clicks')->default(0);
                $table->dateTime('date_start')->nullable();
                $table->dateTime('date_finish')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->boolean('active')->default(false);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('banners_campaigns');
        }
    }
