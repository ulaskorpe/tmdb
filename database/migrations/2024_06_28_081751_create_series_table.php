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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('adult')->default(false);
            $table->string('original_name')->nullable();
            $table->string('origin_countries')->nullable();
            $table->string('original_language',4)->default('en');
            $table->text('overview')->nullable();
            $table->float('popularity')->default(0);
            $table->float('vote_average')->default(0);
            $table->integer('vote_count')->default(0);
            $table->date('first_air_date')->nullable()->default(now());
            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
