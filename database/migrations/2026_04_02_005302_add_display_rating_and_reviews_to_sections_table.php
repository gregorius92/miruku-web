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
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->string('display_rating')->nullable()->after('content');
            $table->string('display_reviews')->nullable()->after('display_rating');
            $table->string('display_reviews_en')->nullable()->after('display_reviews');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['display_rating', 'display_reviews', 'display_reviews_en']);
        });
    }
};
