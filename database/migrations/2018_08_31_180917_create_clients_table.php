<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('client_name');
            $table->text('client_contact_first_name');
            $table->text('client_contact_last_name');
            $table->text('client_contact_full_name');
            $table->text('client_contact_phone');
            $table->text('client_contact_email');
            $table->text('client_address');
            $table->text('client_city');
            $table->text('client_state');
            $table->text('client_zip');
            $table->text('client_notes')->nullable();
            $table->text('client_status');
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
        Schema::dropIfExists('clients');
    }
}
