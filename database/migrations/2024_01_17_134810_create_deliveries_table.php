<?php

use App\Models\DeliveryRequest;
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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('comment')->nullable();
            $table->integer('note')->nullable();
            $table->dateTime('enddate');
            $table->dateTime('startdate');
            $table->foreignIdFor(DeliveryRequest::class)->constrained();
            $table->unsignedBigInteger('deliver_id');
            $table->foreign('deliver_id')->references('id')->on('users');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
