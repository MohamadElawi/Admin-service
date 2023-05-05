<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->text('description_ar')->after('guard_name')->nullable();
            $table->text('description_en')->after('guard_name')->nullable();
        });
    }


    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('description_ar');
            $table->dropColumn('description_en');
        });
    }
};
