<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CommitteeMembersMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing committee_members
        Schema::create('committee_members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->integer('occupation_id')->unsigned();
            $table->string('name');
            $table->string('company');
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
        Schema::dropIfExists('committee_members');
    }

    // Foreign keys migrations are done via 9999_12_31_235959_FKMigrations.php
}
