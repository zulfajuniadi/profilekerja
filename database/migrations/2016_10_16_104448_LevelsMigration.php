<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LevelsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing levels
        Schema::create('levels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('occupation_id')->unsigned();
            $table->integer('level');
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('levels');
    }

    // Foreign keys migrations are done via 9999_12_31_235959_FKMigrations.php
}
