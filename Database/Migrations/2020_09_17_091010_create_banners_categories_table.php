<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBannersCategoriesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('banners_pages', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('banner_id');
                $table->uuid('page_id')->nullable();
                $table->timestamps();

                $table->foreign('banner_id')
                    ->references('id')
                    ->on('banners_items')
                    ->onDelete('cascade');
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('banners_pages');
        }
    }
