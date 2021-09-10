<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
        $table->string('message_from')->nullable();
        $table->string('message_to')->nullable();
        $table->string('message_body')->nullable();
        $table->bigInteger('wraping_id')->default(0);
//            $table->foreign('wraping_id')->references('id')->on('gift_warpings')->onDelete('restrict');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
