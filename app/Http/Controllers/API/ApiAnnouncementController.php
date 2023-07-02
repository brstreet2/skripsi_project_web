<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser;

class ApiAnnouncementController extends Controller
{
    public function get()
    {
        DB::beginTransaction();
        $error      = false;
        $message    = '';

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

                $documentDb       = Announcement::orderBy('created_at', 'DESC')->first();
                if ($documentDb) {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => [$documentDb],
                        'status' => $status
                    ], $status);
                } else {
                    $status = 200;
                    return response()->json([
                        'error'   => false,
                        'message' => 'OK',
                        'data'    => null,
                        'status' => $status
                    ], $status);
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error'     => true,
                'message'   => dd($e),
                'data'      => '',
                'status'    => 403
            ], 403);
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
