<?php

namespace Lyfing\ChatBot\Controllers;

use App\Http\Controllers\BaseController as Controller;
use Illuminate\Http\Request;
use Lyfing\ChatBot\Requests\ChatBotApiRequest;
use Lyfing\ChatBot\Servers\Chatbot;

class ChatBotController extends Controller
{

	/**
	 * Get view
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(Request $request)
	{
		return view('chatbot::index');

	}

	/**
	 * API
	 *
	 * @param ChatBotApiRequest $request
	 *
	 * @return array
	 */
	public function api(ChatBotApiRequest $request)
	{

		$userId = $request->userId ?: $_SERVER['REMOTE_ADDR'];

		// initialize chatbot
		$chatbot = new Chatbot(config('chatbot'), $userId);


		$result = array(
			'status'  => 'error',
			'type'    => 'empty',
			'message' => 'empty message ...',
			'data'    => 'empty',
		);

		// talk
		if ($request->requestType == 'talk') {
			$res = $chatbot->talk($request->userInput);
			$data = $chatbot->getData();
			$result['status'] = 'success';
			$result['type'] = 'talk';
			$result['message'] = trim(preg_replace('/\s+/', " ", $res));
			$result['data'] = $data;
		} elseif ($request->requestType == 'forget') {
			$chatbot->forget();
			$result['status'] = 'success';
			$result['type'] = 'forget';
			$result['message'] = 'completed successifully ...';
			$result['data'] = 'empty';
		} else {
			$result['status'] = 'error';
			$result['type'] = $_REQUEST['requestType'];
			$result['message'] = 'invalid request type ...';
			$result['data'] = 'empty';
		}

		return $result;

	}


}
