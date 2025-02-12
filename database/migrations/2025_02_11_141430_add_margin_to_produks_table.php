<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->decimal('margin', 8, 2)->after('harga')->default(0); // Margin dalam persen
        });
    }

    public function down()
    {
        Schema::table('produks', function (Blueprint $table) {
            $table->dropColumn('margin');
        });
    }
};
