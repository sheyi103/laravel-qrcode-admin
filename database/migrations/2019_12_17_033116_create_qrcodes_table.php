<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id');
            $table->string('website')->nullable();
            $table->string('company_name');
            $table->string('product_name');
            $table->string('product_url')->nullable();
            $table->string('qrcode_path')->nullable();  // Path to Where QRCODE is saved on our server
            $table->string('callback_url');
            $table->float('amount', 10, 4);
            $table->tinyInteger('status')->default(1)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('qrcodes');
    }
}
