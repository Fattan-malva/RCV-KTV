<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Nama ruangan
            $table->unsignedBigInteger('room_category_id'); // Foreign key ke room_categories
            $table->integer('capacity'); // Kapasitas ruangan
            $table->integer('available')->default(1); // Status ketersediaan
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Relasi foreign key
            $table->foreign('room_category_id')->references('id')->on('room_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}

