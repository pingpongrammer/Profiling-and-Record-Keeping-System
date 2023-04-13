<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('files', function (Blueprint $table) {
      $table->id();
      // $table->unsignedBigInteger('user_id');
      $table->string('name');
      $table->string('type');
      $table->string('size');
      $table->enum('category', ['accomplishment', 'financial', 'blotter']);
      $table->softDeletes();
      $table->timestamps();
      $table->text('description');

      // $table->foreign('user_id')
      //     ->references('id')
      //     ->on('users')
      //     ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('files');
  }
}
