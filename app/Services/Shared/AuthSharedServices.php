<?php

namespace App\Services\Shared;

use App\Interfaces\auth\AuthLogoutInterface;
use Illuminate\Http\Request;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Illuminate\Support\Facades\Auth;

abstract class AuthSharedServices implements AuthLogoutInterface {

  protected $tokenRepository, $refreshTokenRepository;

  public function __construct(TokenRepository $tokenRepository, RefreshTokenRepository $refreshTokenRepository){
    $this->tokenRepository = $tokenRepository;
    $this->refreshTokenRepository = $refreshTokenRepository;
  }

  public function generateToken(Request $request){
    $this->revokeToken();
    $client = new \GuzzleHttp\Client();
    try {
      $response = $client->post(url('/oauth/token'), [
        'form_params' => [
          'grant_type' => 'password',
          'client_id' => config('services.passport.client_id'),
          'client_secret' => config('services.passport.client_secret'),
          'username' => $request->email,
          'password' => $request->password
        ]
      ]);
      return $response->getBody();
    } catch (\GuzzleHttp\Exception\ClientException $e) {
      return response([json_decode($e->getResponse()->getBody())], $e->getCode());
    }
  }

  public function revokeToken(){
    $this->tokenRepository->revokeAccessToken(Auth::user()->token()->id);
    $this->refreshTokenRepository->revokeRefreshTokensByAccessTokenId(Auth::user()->token()->id);
  }

  abstract function login(Request $request);
}