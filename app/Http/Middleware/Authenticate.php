<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Auth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        try
        {
            if (! $user = JWTAuth::parseToken()->authenticate() )
            {
                 return response()->json([
                   'code'   => 101, // means auth error in the api,
                   'response' => null, // nothing to show ,
                 ]);
            }
        }
        catch (TokenExpiredException $e)
        {
            // If the token is expired, then it will be refreshed and added to the headers
            try
            {
                $refreshed = JWTAuth::refresh(JWTAuth::getToken());
                $user = JWTAuth::setToken($refreshed)->toUser();
                header('Authorization: Bearer ' . $refreshed);
            }
            catch (JWTException $e)
            {
                 return response()->json([
                   'code'   => 103, // means not refreshable 
                   'response' => null // nothing to show 
                 ]);
            }
        }
        catch (JWTException $e)
        {
            return response()->json([
                   'code'   => 101, // means auth error in the api,
                   'response' => null // nothing to show 
            ]);
        }

        // Login the user instance for global usage
        Auth::login($user, false);

        return  $next($request);
    }
    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null];
        }
        foreach ($guards as $guard) {
            if ($this->auth->guard($guard)->check()) {
                return $this->auth->shouldUse($guard);
            }
        }
        return 'authentication_error';
    }
}