<?php
namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Artisan;
use JWTAuth;
use Tymon\JWTAuth\Manager;

class AuthController extends Controller
{

    public function __construct(){

    $this->middleware('auth:api', ['except' => ['login', 'register']]);

    }

    public function register(Request $request)
    {

        // return response()->json(['status' => 'success'], 200);
        $v = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3|confirmed',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }
        $user = new User;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        //$user->save();

    }
    public function login(Request $request)
    {
       
        $credentials = $request->only('email', 'password');
        // $session = 60;
        // JWTAuth::factory()->setTTL($session);
        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => 'success'], 200)->header('Authorization', $token); 
        }
        return response()->json(['error' => 'login_error'], 401);
    }
    public function me()
    {
        return response()->json(auth()->user());
    }
    public function logout()
    {   
        
        // $token = $request->header( 'Authorization' );

        // try {
        //     JWTAuth::parseToken()->invalidate( $token );

        //     return response()->json( [
        //         'error'   => false,
        //         'message' => trans( 'auth.logged_out' )
        //     ] );
        // } catch ( TokenExpiredException $exception ) {
        //     return response()->json( [
        //         'error'   => true,
        //         'message' => trans( 'auth.token.expired' )

        //     ], 401 );
        // } catch ( TokenInvalidException $exception ) {
        //     return response()->json( [
        //         'error'   => true,
        //         'message' => trans( 'auth.token.invalid' )
        //     ], 401 );

        // } catch ( JWTException $exception ) {
        //     return response()->json( [
        //         'error'   => true,
        //         'message' => trans( 'auth.token.missing' )
        //     ], 500 );
        // }
        // auth('api')->logout();
        
        
        Auth::logout();
        JWTAuth::parseToken()->invalidate();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh()
    {
        try {
            Artisan::call('cache:clear');
            $token = \Auth::guard()->refresh();
            $user = JWTAuth::setToken($token)->toUser();
            return $this->respondWithToken($token);
        } catch (\Throwable $th) {
            return response()->json($th);
        }
    }
    protected function respondWithToken($token)
    {
       try {
        $responseArray = [
            'access_token' => $token,
            'user' => auth()->user(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 1,
        ];
        return response()->json($responseArray);
       } catch (Exception $e) {
        return response()->json('token error');
       }

    }
    private function guard()
    {
        return Auth::guard();
        return \Auth::Guard('api');
    }
}
