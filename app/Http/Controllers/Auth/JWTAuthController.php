<?php

namespace App\Http\Controllers\Auth;

use App\Actions\Auth\CurrentUserAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\TokenResponseAction;
use App\DTO\Auth\LoginDTO;
use App\DTO\Auth\TokenDTO;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class JWTAuthController extends Controller
{
    public function login(LoginRequest $request, LoginAction $loginAction): JsonResponse
    {
        try {
            $login = $loginAction->execute(LoginDTO::fromRequest($request));
            return ResponseHelper::success(message: 'Logged in!', data: $login);
        } catch (JWTException $e) {
            return ResponseHelper::error(message: $e->getMessage(), statusCode: 401);
        } catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }
    }

    public function user(CurrentUserAction $currentUserAction): JsonResponse
    {
        try {
            $current_user = $currentUserAction->execute(auth()->user());
            return ResponseHelper::success(data: $current_user->toArray());
        } catch (JWTException $e) {
            return ResponseHelper::error(message: $e->getMessage(), statusCode: 401);
        } catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }
    }

    public function logout(LogoutAction $logoutAction): JsonResponse
    {
        try {
            $logoutAction->execute();
            return ResponseHelper::success(message: "Successfully Logged out", statusCode: 201);
        } catch (Throwable  $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }

    }

    public function refresh(TokenResponseAction $tokenResponseAction): JsonResponse
    {
        try {
            $token = $tokenResponseAction->execute(TokenDTO::fromStr(auth()->refresh()));
            return ResponseHelper::success(message: "Token refreshed", data: $token);
        }catch (TokenBlacklistedException $e){
            return ResponseHelper::error(message: $e->getMessage(),statusCode: 403);
        }
        catch (Throwable $e) {
            return ResponseHelper::error(message: $e->getMessage());
        }
    }
}
