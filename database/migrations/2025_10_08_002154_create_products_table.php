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

    Schema::create('products', function (Blueprint $table) {
        $table->id();// primary key
        $table->foreignId('department_id')
              ->constrained()
              ->onDelete('cascade');                                  // foreign key to departments table             
        $table->string('name');                                     // name of the product
        $table->decimal('price', 8, 2);                             // price with 2 decimal places
        $table->text('description')->nullable();                    // description of the product
        $table->string('item_number')->unique()->index();           // item number, unique and indexed
        $table->string('image')->nullable();                        // URL image of the product
        $table->timestamps();                                       // created_at и updated_at
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
