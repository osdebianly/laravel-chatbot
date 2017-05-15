<?php

namespace Lyfing\ChatBot;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;

class ChatBotServiceProvider extends ServiceProvider
{


	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{

		$this->loadMigrationsFrom(__DIR__ . '/../databases/migrations');

		$this->loadViewsFrom(__DIR__ . "/../resources/views", 'chatbot');

		$this->loadRoutesFrom(__DIR__ . '/routes.php');
		
		$this->publishes([
			__DIR__ . '/../config/chatbot.php' => config_path('chatbot.php')
		], 'config');

		$this->publishes([
			__DIR__ . "/../resources/assets"   => public_path('vendor/chatbot'),
		], 'public');

		$this->publishes([
			__DIR__ . "/../aiml" => storage_path('chatbot/aiml')
		], 'aiml');

	}


	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../config/chatbot.php', 'chatbot'
		);

	}

}
