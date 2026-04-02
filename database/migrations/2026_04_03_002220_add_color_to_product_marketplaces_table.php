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
        Schema::table('product_marketplaces', function (Blueprint $table) {
            $table->string('color')->default('bg-miruku-blue')->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_marketplaces', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
};
