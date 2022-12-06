<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReloadlyService;
use Illuminate\Support\Facades\Log;

class ReloadlyController extends Controller
{
    public function getBalance() {
		Log::info("[ReloadlyService][checkAccountBalance]\t Checking Account Balance");
	$balance_response = ReloadlyService::getBalance();
	if (!empty($balance_response)) {
		return [
			"code" => 200,// Assign a code here for success you will use throughout
			"balance" => $balance_response["balance"],
			"currency" => $balance_response["currencyCode"],
			"message" => "Balance retrieved successfully"
		];
	}
	return [
		"code" => 400,// Assign a code you will use for error getting balance
		"message" => "Could not retrieve the account balance",
	];

	}
    
    public function getTransactionStatus($id, Request $request) { // Added the $id variable defined in the routes as a parameter to use later
		try {
			$result = ReloadlyService::getTransactionStatus();    
		} catch (\Exception $exception) {
			// Log error here using what you have learnt
			return response()->json([
				'code' => 400,// design the code you want to use for internal errors and return here,
				'message' => 'Internal error encountered'
			], 400);
		}
		return $result;
    }

    public function getTransactionHistory(Request $request) {
		$data = $request->validate([          
			'size' => 'required|gt:0|lte:200', // field is required and should be greater than 0 but less than or equal to 200
			'page' => 'required|gt:0', // field is required and greater than 0 
			'start_date' => 'required|date_format:Y-m-d',
			'end_date' => 'required|date_format:Y-m-d',
		]);

		

		try {
			$result = ReloadlyService::getTransactionHistory();    
		} catch (\Exception $exception) {
			// Log error here using what you have learnt
			return response()->json([
				'code' => 400,// design the code you want to use for internal errors and return here,
				'message' => 'Internal error encountered'
			], 400);
		}
		return $result; // Will be worked on later to transform the data into a required form
	}

    public function buyGiftCard(Request $request) {
		try {
			$result = ReloadlyService::buyGiftCard();    
		} catch (\Exception $exception) {
			// Log error here using what you have learnt
			return response()->json([
				'code' => 400,// design the code you want to use for internal errors and return here,
				'message' => 'Internal error encountered'
			], 400);
		}
		return $result; // Will be worked on later to transform the data into a required form
	}

    public function getProducts(Request $request) {
		// Can perform validation of request data or log some additional info
		try {
			$result = ReloadlyService::getProducts();    
		} catch (\Exception $exception) {
			// Log error here using what you have learnt
			return response()->json([
				'code' => 400,// design the code you want to use for internal errors and return here,
				'message' => 'Internal error encountered'
			], 400); // 400 is the HTTP status to return. If you want to return 200, remove the 400
		}
		return $result; // Will be worked on later to transform the data into a required form
	}
}