<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\ConnectException;

class ReloadlyService {
	private static function getAccessToken() {
		try {
			$uri = env('RELOADLY_GIFTCARD_AUTH_URL');
			$client_secret = env('RELOADLY_API_CLIENT_SECRET');
			$client_id = env('RELOADLY_API_CLIENT_ID');
			$audience = env('RELOADLY_GIFTCARD_BASE_URL');
			
			$httpClient = new Client();     
			$body = [
				"grant_type" => "client_credentials",	
				"audience" => $audience,	
				"client_id" => $client_id,
				"client_secret" => $client_secret,	   
			];
			
			Log::info("[ReloadlyService][getAccessToken]\t Calling: \t" . $audience);
			
			$response = $httpClient->post($uri, [   
				'headers' => [
					'Accept' => 'application/json',
					'Content' => 'application/json'	  
				],        
				'json' => $body,         
			]);
			   
			Log::info("[ReloadlyService][getAccessToken]\t Status: \t" .
						$response->getStatusCode() . "\t:\t" . $response->getBody());	   
			$json_response = json_decode($response->getBody(), true); 	 
		
			if (!empty($json_response) && is_array($json_response)) {
				if (array_key_exists('access_token', $json_response)) {
					$token = $json_response['access_token'];   
					return $token;	
				}	 
			}
		} catch (ClientException $exception) { // Exception caught when a 4xx HTTP status is received 
			Log::error("[ReloadlyService][getAccessToken] ... ClientException ... \t"
					. $exception->getResponse()->getBody()->getContents());
		} catch (ConnectException $exception) { // Exception for when there is a connection issue to the API server    
			Log::error("[ReloadlyService][getAccessToken] ... ConnectException... \t"
					. $exception->getResponse()->getBody()->getContents());  
		} catch (ServerException $exception) { // Exception for when there is a 5xx HTTP status
			Log::error("[ReloadlyService][getAccessToken]\t... ServerException ... \t"
					. $exception->getResponse()->getBody()->getContents());
		} catch (\Exception $exception) { // Fallback. Always called when exception is thrown
			Log::error("[ReloadlyService][getAccessToken] ... Exception... \t" . $exception->getMessage());      
			Log::error("[ReloadlyService][getAccessToken] ... Trace... \t" . $exception->getTraceAsString());
		}
		return null;
	}
	
	public static function getBalance() {
		
		try{
		$token = self::getAccessToken(); // Call to get the token to use later
		$uri = env('RELOADLY_GIFTCARD_BASE_URL') . "/accounts/balance"; // Add correct endpoint here
		$httpClient = new Client();     		
		Log::info("[ReloadlyService][getBalance]\t Calling: \t" . $uri);
		
		$response = $httpClient->get($uri, [   
			'headers' => [
				'Accept' => 'application/com.reloadly.giftcards-v1+json',
				'Content' => 'application/json', 
				'Authorization' => 'Bearer ' . $token // Add token here for authorization
			],                
		]);
		   
		Log::info("[ReloadlyService][getBalance]\t Status: \t" .
                    $response->getStatusCode() . "\t:\t" . $response->getBody());	   
		$json_response = json_decode($response->getBody(), true); 	 
	
		if (!empty($json_response) && is_array($json_response)) {			
			return $json_response;		 
		}
	} catch (ClientException $exception) { // Exception caught when a 4xx HTTP status is received 
		Log::info("[ReloadlyService][getBalance] ... ClientException ... \t"
                . $exception->getResponse()->getBody());
	} catch (ConnectException $exception) { // Exception for when there is a connection issue to the API server    
		Log::error("[ReloadlyService][getBalance] ... ConnectException... \t"
                . $exception->getResponse()->getBody()->getContents());  
	} catch (ServerException $exception) { // Exception for when there is a 5xx HTTP status
		Log::error("[ReloadlyService][getBalance]\t... ServerException ... \t"
                . $exception->getResponse()->getBody()->getContents());
	} catch (\Exception $exception) { // Fallback. Always called when exception is thrown
		Log::error("[ReloadlyService][getBalance] ... Exception... \t" . $exception->getMessage());      
		Log::error("[ReloadlyService][getBalance] ... Trace... \t" . $exception->getTraceAsString());
	}
	return null;
	}
	
	private static function getCountries() {
		return "Work In Progress";
	}
	
	private static function getCountryByIso() {
		return "Work In Progress";
	}
	
	private static function getProduct() {
		return "Work In Progress";
	}

	public static function getProducts() {
		return "Work In Progress";
	}

    private static function getTransactionbyID() {
		return "Work In Progress";
	}

    private static function getMakeOrder() {
		return "Work In Progress";
	}

    private static function getRedeemCode() {
		return "Work In Progress";
	}

    public static function checkAccountBalance() {
		return "Work In Progress";
	}
	
	public static function checkTransactionStatus() {
		return "Work In Progress";
	}
	
	public static function getTransactionHistory() {
		return "Work In Progress";
	}
	
	public static function buyGiftCard() {
		return "Work In Progress";
	}
	//.... Add the rest of the function 
}