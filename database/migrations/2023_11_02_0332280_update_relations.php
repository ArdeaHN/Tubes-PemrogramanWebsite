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
        Schema::table('user_shoping_carts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('cart_id')->references('id')->on('user_shoping_carts');
            $table->foreign('product_id')->references('id')->on('product');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('product_categories');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_shoping_carts', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('cart_id');
            $table->dropColumn('product_id');
        });

        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });

    }
};
