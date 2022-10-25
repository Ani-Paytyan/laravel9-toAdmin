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
        Schema::create('unique_items', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->foreignUuid('item_id')
                ->references('id')
                ->on('items')
                ->onUpdate('cascade');
            $table->string('workplace_id');
            $table->string('article')->nullable();
            $table->string('mac')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unique_items');
    }
};
