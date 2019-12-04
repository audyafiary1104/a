<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Country extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('name');
            $table->string('alphacode');
            $table->string('callingCodes')->nullable();
            $table->string('currencies');
            $table->string('subregion');
            $table->string('regions');
            $table->longtext('languages');
            $table->longtext('translations');
            $table->string('timezones');
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
        Schema::dropIfExists('country');
      
    }
}
