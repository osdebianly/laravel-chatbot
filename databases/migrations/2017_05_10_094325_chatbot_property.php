<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChatbotProperty extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('chatbot_property', function (Blueprint $table) {
			$table->increments('id');
			$table->string('unique')->unique();
			$table->string('type', 10);
			$table->string('name');
			$table->string('value');
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
		Schema::drop('chatbot_property');
	}
}
