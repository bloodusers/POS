<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /*$table->id();
            $table->unsignedBigInteger('organizations_id');
            $table->string('name');
            $table->string('contact')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->index('organizations_id');*/

            /*$table->id();
            $table->string('name')->unique();
            $table->string('shortName')->unique();
            $table->string('contactPerson');
            $table->string('contact')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('regDate');
            $table->boolean('isActive')->default(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();*/
            $table->id();
            $table->string('name');
            $table->string('contact')->unique();
            $table->string('email')->unique();
            $table->string('address')->nullable();
            $table->unsignedBigInteger('organization_id');
            $table->unsignedBigInteger('role_id');
            $table->string('password');
            $table->timestamps();
            $table->index('organization_id');
            $table->index('role_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
