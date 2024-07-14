<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('gender');
            $table->integer('age');
            $table->text('address');
            $table->string('tc');
            $table->string('marksheet');
            $table->boolean('admitted_status')->default(false);
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
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('admitted');
        });
    }
};
