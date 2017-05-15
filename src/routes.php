<?php


Route::group(['namespace' => 'Lyfing\ChatBot\Controllers', 'middleware' => 'web'], function () {

	Route::get(env('chatbotUrl', 'chatbot'), 'ChatBotController@index');

	Route::get(env('chatbotApiUrl', 'chatbot/api'), 'ChatBotController@api');

});


