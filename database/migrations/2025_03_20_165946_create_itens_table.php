<?php

use App\Models\Manufacturer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;
use App\Models\Admin;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity');
            $table->integer('quantity_sold')->default(0);
            $table->float('purchase_value');
            $table->float('sale_value');
            $table->date('purchase_date');
            $table->date('sale_date')->nullable();
            $table->string('product_code');
            $table->date('due_date');
            $table->integer('ativo');
            $table->foreign('product_code')->references('code')->on('products')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignIdFor(Manufacturer::class)->references('id')->on('manufacturers')->onDelete('cascade');
            $table->foreignIdFor(Admin::class)->references('id')->on('admin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens');
    }
};
