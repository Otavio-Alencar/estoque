<?php

use App\Models\Manufacturer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Item;
use App\Models\Admin;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('quantity');
            $table->float('sale_value');
            $table->date('sale_date');
            $table->string('product_code');
            $table->string('proof');
            $table->foreign('product_code')->references('code')->on('products');
            $table->foreignIdFor(Item::class)->references('id')->on('items');
            $table->foreignIdFor(Admin::class)->references('id')->on('admin');
            $table->foreignIdFor(Manufacturer::class)->references('id')->on('manufacturers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
