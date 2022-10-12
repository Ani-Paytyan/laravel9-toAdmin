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
        Schema::create('company_workplace', function (Blueprint $table) {
            $table->foreignUuid('company_id')
                ->references('id')
                ->on('companies')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignUuid('workplace_id')
                ->references('id')
                ->on('workplaces')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_workplace', function (Blueprint $table) {
            $table->dropForeign(['company_id', 'workplace_id']);
            $table->dropColumn('company_id');
            $table->dropColumn('workplace_id');
        });

        Schema::dropIfExists('company_workplace');
    }
};
