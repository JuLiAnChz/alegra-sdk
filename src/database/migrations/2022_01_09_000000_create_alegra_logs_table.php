<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlegraLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alegra_logs', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('service', 255);
			$table->integer('status_code')->nullable();
			$table->text('request')->nullable();
			$table->text('response')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('alegra_logs');
	}
}
