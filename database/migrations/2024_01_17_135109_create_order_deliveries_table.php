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
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('deliver_id')->nullable();
            $table->foreign('deliver_id')->references('id')->on('users');

            $table->string('startposition');
            $table->string('endposition');
            $table->double('distance');
            $table->double('amount');
            $table->string('status')->default('pending');

            $table->dateTime('accepteddate')->nullable();


            $table->string('comment')->nullable();
            $table->integer('note')->nullable();

            $table->dateTime('enddate')->nullable();
            $table->dateTime('startdate')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};
