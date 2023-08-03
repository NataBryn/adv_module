<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBannersFilesTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('banners_files', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('banner_id');
                $table->string('filename');
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
            Schema::dropIfExists('banners_files');
        }
    }
