<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;

class authController extends Controller
{
    public function login(Request $request)
    {
        // dd($request);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['message' => __('auth.failed')], 422);
        }
        $token = auth()->user()->createToken('client');
        return ['token' => $token->plainTextToken];
    }

    public function users(Request $request, $id = null)
    {
        if($id) {
            return new UserResource(User::where('user_type', 2)->findOrFail($id));
        }
        return new UserCollection(User::where('user_type', 2)->get());
    }

    public function storeUser(Request $request, $id = null)
    {
        try {
            // dd($request, $id);

            $validator = Validator::make($request->all(), [
                'full_name' => 'required',
                'email' => 'required|email',
                'mobile_no' => 'required|numeric',
                'status' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error.',
                    'errors'=>$validator->errors()
                ], 422);
            }

            if($id) {
                $store = User::where('id', $id)->update([
                    'full_name' => $request->full_name,
                    'email' => $request->email,
                    'mobile_no' => $request->mobile_no,
                    'status' => $request->status == 'Active' ? 1 : 2,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'User updated successfully.'
                ], 200);
            }
            
            $store = User::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'mobile_no' => $request->mobile_no,
                'user_type' => 2,
                'status' => $request->status == 'Active' ? 1 : 2,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'User created successfully.'
            ], 200);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            
            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            // dd($th);
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
