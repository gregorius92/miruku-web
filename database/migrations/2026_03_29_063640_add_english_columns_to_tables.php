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
            $table->string('name_en')->nullable()->after('name');
            $table->text('description_en')->nullable()->after('description');
            $table->longText('body_en')->nullable()->after('body');
            $table->string('meta_title_en')->nullable()->after('meta_title');
            $table->text('meta_description_en')->nullable()->after('meta_description');
        });

        Schema::table('sections', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->text('content_en')->nullable()->after('content');
        });

        Schema::table('carousels', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title');
            $table->string('subtitle_en')->nullable()->after('subtitle');
            $table->string('button_text_en')->nullable()->after('button_text');
            $table->string('button2_text_en')->nullable()->after('button2_text');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->text('comment_en')->nullable()->after('comment');
        });

        Schema::table('store_locations', function (Blueprint $table) {
            $table->string('name_en')->nullable()->after('name');
            $table->string('address_en')->nullable()->after('address');
            $table->string('city_en')->nullable()->after('city');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en', 'body_en', 'meta_title_en', 'meta_description_en']);
        });
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'subtitle_en', 'content_en']);
        });
        Schema::table('carousels', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'subtitle_en', 'button_text_en', 'button2_text_en']);
        });
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['comment_en']);
        });
        Schema::table('store_locations', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'address_en', 'city_en']);
        });
    }
};
