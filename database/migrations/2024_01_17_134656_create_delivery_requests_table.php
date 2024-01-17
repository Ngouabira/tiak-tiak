<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('startposition');
            $table->string('endposition');
            $table->double('distance');
            $table->double('amount');
            $table->string('status');
            $table->dateTime('accepteddate');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_requests');
    }
};
