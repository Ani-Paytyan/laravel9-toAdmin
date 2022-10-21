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
        Schema::create('antena_workplace', function (Blueprint $table) {
            // unsigned is needed for foreign key
            $table->id();
            $table->string('type');

            $table->foreignUuid('antena_id')
                ->references('id')
                ->on('antenas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('workplace_id')
                ->references('id')
                ->on('workplaces')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('antena_workplaces');
    }
};
