<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\activationEmail;
use App\Models\Auth\User;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Psr\Http\Message\ServerRequestInterface;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\Exceptions\OAuthServerException;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;

class ApiAuthController extends \Laravel\Passport\Http\Controllers\AccessTokenController
{
    public function login(ServerRequestInterface $request)
    {
        $error         = true;
        $expires_in    = 0;
        $investorAccount = 0;
        $status        = 403;
        $message       = "";
        $issuedToken   = "";
        $data          = "";

        try {
            $validator = Validator::make($request->getParsedBody(), [
                'username'       => 'required|email',
                'password'       => 'required',
                'client_id'      => 'required|numeric',
                'client_secret'  => 'required',
                'grant_type'     => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid input',
                    'data'      => '',
                    'status'    => 403
                ], 403);
            }

            if ($request->getParsedBody()['grant_type'] != 'password') {
                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid input',
                    'data'      => '',
                    'status'    => 403
                ], 403);
            }

            $username  = $request->getParsedBody()['username'];
            $client_id = $request->getParsedBody()['client_id'];

            //get user
            $user = User::where('email', $username)->firstOrFail();

            //check role
            if ($user->user_role) {
                $activation = Activation::where('user_id', $user->id)->first();

                $investorAccount = 1;

                if ($investorAccount == 0) {
                    $message = 'username/password is invalid';
                } else {
                    if (!$activation) {
                        $message = 'Your account is not active.';
                    } else {
                        if ($activation->completed == 0) {
                            Mail::to($user->email)->send(new activationEmail($user, $activation->code));
                            $message = 'Your account is not active. Check your email for activation.';
                        } else {
                            //issuetoken
                            $tokenResponse = parent::issueToken($request);

                            //convert response to json string
                            $content = $tokenResponse->content();

                            //convert json to array
                            $data = json_decode($content, true);

                            if ($user->email != 'investor@admin.com') {
                                //get previous user token
                                $userTokens = $user->tokens;

                                //revoke previous token
                                if ($client_id == "2") {  //for android device
                                    foreach ($userTokens as $key => $token) {
                                        //revoke token except the first one
                                        if ($token->client_id == "2" && $key !== 0) {
                                            $token->revoke();
                                        }
                                    }
                                }
                            }

                            $user->last_login            = date('Y-m-d H:i:s');
                            $user->updated_by            = $user->name;
                            $user->save();

                            //set data for response success
                            $error       = false;
                            $message     = 'success';
                            $status      = 200;
                            $issuedToken = $data['access_token'];
                            $expires_in  = $data['expires_in'];
                            $data        = [
                                'id'    => $user->id,
                                'email' => $user->email,
                                'name'  => $user->name,
                                'phone' => $user->phone,
                            ];
                        }
                    }
                }
            } else {
                $message = 'username/password is invalid';
            }

            return response()->json([
                'error'        => $error,
                'message'      => $message,
                'data'         => $data,
                'status'       => $status,
                'token'        => $issuedToken,
                'expires_in'   => $expires_in,
            ], $status);
        } catch (ModelNotFoundException $e) { // email notfound
            //return error message
            $message = "username/password is invalid";

            return Response::json([
                "error"      => $error,
                "message"    => $message,
                "data"       => $data,
                "status"     => $status,
                "token"      => $issuedToken,
                "expires_in" => $expires_in,
            ], $status);
        } catch (OAuthServerException $e) { //password not correct..token not granted
            //return error message
            $message = $e->getMessage();

            return Response::json([
                "error"      => $error,
                "message"    => $message,
                "data"       => $data,
                "status"     => $status,
                "token"      => $issuedToken,
                "expires_in" => $expires_in,
            ], $status);
        } catch (Exception $e) {
            //return error message
            if ($e->getCode() == 10) {
                $message = "username/password is invalid";
            } else {
                $message = $e->getMessage();
            }

            return Response::json([
                "error"      => $error,
                "message"    => $message,
                "data"       => $data,
                "status"     => $status,
                "token"      => $issuedToken,
                "expires_in" => $expires_in,
            ], $status);
        }
    }

    public function logout(Request $request)
    {
        DB::beginTransaction();
        $error   = true;
        $message = '';

        try {
            $bearerToken = request()->bearerToken();
            if ($bearerToken == null) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid Token',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            }

            $tokenId = app(Parser::class)->parse($bearerToken)->claims()->get('jti');
            $revoked = Token::find($tokenId)->revoked;

            if ($revoked) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Not Allowed',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            } else {
                $userId = app(Parser::class)->parse($bearerToken)->claims()->get('sub');

                $user = User::find($userId);

                if ($user == false) {
                    $error      = true;
                    $message    = 'Email not found';
                    $user       = '';
                    $status     = 403;
                } else {
                    //revoke available token
                    $userTokens = $user->tokens;
                    foreach ($userTokens as $token) {
                        if (isset($request->device)) {
                            if ($request->device == "mobile") {
                                if ($token->client_id == "2") { //for android device
                                    $token->revoke();
                                }
                            } else {
                                $token->revoke();
                            }
                        } else {
                            $token->revoke();
                        }
                    }

                    $user->updated_by            = $user->name;
                    $user->save();

                    $error      = false;
                    $message    = 'Logout success';
                    $status     = 200;
                }

                DB::commit();

                return response()->json([
                    'error'      => $error,
                    'message'    => $message,
                    'data'       => '',
                    'status'     => $status
                ], $status);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'      => true,
                'message'    => $e->getMessage(),
                'data'       => '',
                'status'     => 403
            ], 403);
        }
    }

    public function profile()
    {
        DB::beginTransaction();
        $error   = false;
        $message = '';

        try {
            $bearerToken = request()->bearerToken();
            if ($bearerToken == null) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Invalid Token',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            }

            $tokenId = app(Parser::class)->parse($bearerToken)->claims()->get('jti');
            $revoked = Token::find($tokenId)->revoked;

            if ($revoked) {
                DB::rollBack();

                return response()->json([
                    'error'     => true,
                    'message'   => 'Not Allowed',
                    'data'      => '',
                    'status'    => 401
                ], 401);
            } else {
                $userId = app(Parser::class)->parse($bearerToken)->claims()->get('sub');
                $user = User::find($userId);
                $user->updated_by = $user->name;
                $user->save();
                $job_title = null;
                if (isset($user->company_employees->job_title)) {
                    if ($user->company_employees->job_title != "") {
                        $job_title = $user->company_employees->job_title;
                    } else {
                        $job_title = null;
                    }
                }

                $status = 200;

                DB::commit();

                return response()->json([
                    'error'   => false,
                    'message' => 'OK',
                    'data'    => [
                        'id'     => $user->id,
                        'name'   => $user->name,
                        'email'  => $user->email,
                        'phone'  => $user->phone,
                        'created_at'  => $user->created_at,
                        'job_title'   => $job_title
                    ],
                    'status' => $status
                ], $status);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'     => true,
                'message'   => $e->getMessage(),
                'data'      => '',
                'status'    => 403
            ], 403);
        }
    }
}
