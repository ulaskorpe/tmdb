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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('season_id')->constrained()->onDelete('cascade');
            $table->integer('episode_number')->default(0);
            $table->integer('season_number')->default(0);
            $table->integer('production_code')->default(0);
            $table->string('name');
            $table->string('slug');
            $table->string('episode_type')->default('standart');
            $table->text('overview')->nullable();
            $table->date('air_date')->nullable()->default(now());
            $table->float('vote_average')->default(0);
            $table->integer('vote_count')->default(0);
            $table->integer('runtime')->default(0);
            $table->string('still_path')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
