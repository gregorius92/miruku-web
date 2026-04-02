<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('show_on_home')->default(false)->after('is_active');
            $table->boolean('is_best_seller')->default(false)->after('show_on_home');
            $table->dropColumn('stock');
        });

        Schema::create('product_marketplaces', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_marketplaces');

        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock')->default(0)->after('variant');
            $table->dropColumn(['show_on_home', 'is_best_seller']);
        });
    }
};
