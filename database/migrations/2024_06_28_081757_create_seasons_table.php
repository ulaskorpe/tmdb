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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('overview')->nullable();
            $table->foreignId('series_id')->constrained()->onDelete('cascade');
            $table->integer('season_number')->default(0);
            $table->integer('episode_count')->default(0);
            $table->float('vote_average')->default(0);
            $table->date('air_date')->nullable()->default(now());
            $table->string('poster_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
