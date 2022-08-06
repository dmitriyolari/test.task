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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');
            $table->string('filename');
            $table->string('path');
            $table->boolean('from_url')->nullable()->default(0);
            $table->string('disk')->default('public');
            $table->string('alt')->nullable();
            $table->string('title')->nullable();
            $table->string('scope')->nullable();

            $table->index('scope');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
