<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    /*
      $table->string('name')->unique();
            $table->string('shortName')->unique();
            $table->string('contactPerson');
            $table->string('contact')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('regDate');
            $table->boolean('isActive')->nullable();
            $table->string('password');
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('org_id');
            //$table->unsignedBigInteger('privilege_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            $table->index('org_id');
            //$table->index('privilege_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
