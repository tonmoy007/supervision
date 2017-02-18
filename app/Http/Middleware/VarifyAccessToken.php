<?php

namespace App\Http\Middleware;

use App\Models\Token;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class VarifyAccessToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!$token = $this->auth->setRequest($request)->getToken()) {
            $response['message'] = 'No token provided';
            $response['success'] = 0;
            $response['type'] = 'token_absent';
            return response()->json($response);
        }

        $expired = false;


        try {

            $user = $this->auth->authenticate($token);

        } catch (TokenExpiredException $e) {
            $expired = true;
        } catch (JWTException $e) {
            $response['message'] = 'Invalid token';
            $response['success'] = 0;
            $response['type'] = 'token_invalid';

            return response()->json($response);
        } catch (TokenBlacklistedException $e) {
            $response['message'] = 'You are not logged in';
            $response['success'] = 0;
            $response['type'] = 'token_blacklisted';
            return response()->json($response);
        }
        //  $exist=Token::where('token',$request->token)->first();
        // if(!$exist){
        //     return response()->json(['message'=>'token not found','success'=>0,'type'=>'not_found']);
        // }

        if ($expired) {
            try {
                $newToken = $this->auth->setRequest($request)
                    ->parseToken()
                    ->refresh();
                $user = $this->auth->authenticate($newToken);
            } catch (TokenExpiredException $e) {
                return $this->respond('tymon.jwt.expired', 'token_expired', $e->getStatusCode(), [$e]);
            } catch (JWTException $e) {
                return $this->respond('tymon.jwt.invalid', 'token_invalid', $e->getStatusCode(), [$e]);
            }
            // send the refreshed token back to the client
            $request->headers->set('Authorization', 'Bearer ' . $newToken);
        }

        if (!$user) {
            $response['message'] = 'User not found with this token. user might be deleted';
            $response['success'] = 0;
            $response['type'] = 'not_found';
            return response()->json($response);
        }

        if (!$user->hasRole(explode('|', $role) || strcmp($role, 'token') !== 0)) {

            $response['message'] = 'Unauthorized user';
            $response['success'] = 0;
            $response['type'] = 'token_unauthorized';

            return response()->json($response);
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }
}

