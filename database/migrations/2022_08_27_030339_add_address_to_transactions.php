<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressToTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->longText('address_one')->nullable();
            $table->longText('address_two')->nullable();
            $table->integer('provinces_id')->nullable();
            $table->integer('regencies_id')->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('resi')->nullable();
            $table->string('courier')->nullable();
            $table->string('service')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('address_one');
            $table->dropColumn('address_two');
            $table->dropColumn('provinces_id');
            $table->dropColumn('regencies_id');
            $table->dropColumn('zip_code');
            $table->dropColumn('country');
            $table->dropColumn('phone_number');
            $table->dropColumn('resi');
            $table->dropColumn('courier');
            $table->dropColumn('service');
        });
    }
}
