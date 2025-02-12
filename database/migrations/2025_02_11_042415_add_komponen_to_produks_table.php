<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->string('komponen')->after('harga'); 
            $table->decimal('persentase', 5, 2)->after('komponen'); 
            $table->decimal('nominal', 10, 2)->after('persentase'); 
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn(['komponen', 'persentase', 'nominal']);
        });
    }

};
