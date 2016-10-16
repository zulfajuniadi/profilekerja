<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TasksMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing tasks
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('position');
            $table->integer('duty_id')->unsigned();
            $table->integer('level_id')->unsigned();
            $table->string('name');
            $table->text('subtasks');
            $table->text('performance_standard');
            $table->text('enabling_requirement');
            $table->text('materials');
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
        Schema::dropIfExists('tasks');
    }

    // Foreign keys migrations are done via 9999_12_31_235959_FKMigrations.php
}
