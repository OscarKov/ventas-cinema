<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->text('detail')->nullable();
            $table->double('price', 16, 2)->default(0);
            $table->smallInteger('seat', false, true);

            $table->foreignId('user_id')
                ->constrained();

            $table->foreignId('movie_show')
                ->constrained();

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
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropForeign(['movie_show']);
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('purchases');
    }
}
