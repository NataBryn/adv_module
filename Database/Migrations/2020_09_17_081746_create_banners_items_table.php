<?php

    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;

    class CreateBannersItemsTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up()
        {
            Schema::create('banners_items', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('campaign_id');
                $table->string('name');
                $table->unsignedBigInteger('size_id');
                $table->tinyInteger('type');
                $table->string('image')->nullable();
                $table->text('code')->nullable();
                $table->text('target_url')->nullable();
                $table->dateTime('date_start')->nullable();
                $table->dateTime('date_finish')->nullable();
                $table->unsignedBigInteger('region_id');
                $table->boolean('hide_mobile')->default(false);
                $table->boolean('hide_tablets')->default(false);
                $table->tinyInteger('priority')->default(1);
                $table->unsignedBigInteger('limit_views');
                $table->unsignedBigInteger('limit_clicks');
                $table->text('description')->nullable();
                $table->tinyInteger('status')->default(0);
                $table->boolean('active')->default(false);
                $table->boolean('all_categories')->default(false);
                $table->unsignedBigInteger('views')->default(0);
                $table->unsignedBigInteger('clicks')->default(0);
                $table->timestamps();

                $table->foreign('campaign_id')
                    ->references('id')
                    ->on('banners_campaigns')
                    ->onDelete('cascade');

                $table->foreign('size_id')
                    ->references('id')
                    ->on('banners_sizes')
                    ->onDelete('cascade');

                $table->foreign('region_id')
                    ->references('id')
                    ->on('banners_regions')
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
            Schema::dropIfExists('banners_items');
        }
    }
