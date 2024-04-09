<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;

class authController extends Controller
{
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(['message' => __('auth.failed')], 422);
        }
        $token = auth()->user()->createToken('client');
        return ['token' => $token->plainTextToken];
    }

    public function logout()
    {
        auth('sanctum')->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'logout success.'
        ], 200);
    }

    public function users(Request $request, $id = null)
    {
        $sorCol = json_decode($request->sorting)->col ?? 'name';
        $sortBy = json_decode($request->sorting)->by ?? 'asc';

        if($id) {
            return new UserResource(User::where('user_type', 2)->findOrFail($id));
        }
        return new UserCollection(User::where('user_type', 2)->where(function ($query) use($request) {
            $query->where('full_name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('email', 'LIKE', '%'.$request->search.'%')
            ->orWhere('mobile_no', 'LIKE', '%'.$request->search.'%');
        })->orderBy($sorCol, $sortBy)->paginate(env('PAGINATION_VALUE')));
    }

    public function storeUser(Request $request, $id = null)
    {
        try {
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
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function books(Request $request, $id = null)
    {
        $sorCol = json_decode($request->sorting)->col ?? 'name';
        $sortBy = json_decode($request->sorting)->by ?? 'asc';

        if($id) {
            return new BookResource(Book::findOrFail($id));
        }
        return new BookCollection(Book::where(function ($query) use($request) {
            $query->where('name', 'LIKE', '%'.$request->search.'%')
            ->orWhere('description', 'LIKE', '%'.$request->search.'%');
        })->orderBy($sorCol, $sortBy)->paginate(env('PAGINATION_VALUE')));
    }

    public function storeBook(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required|max:255',
                'price' => 'required|numeric',
                'cover_image' => 'required|mimes:jpeg,jpg,png',
                'status' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error.',
                    'errors'=>$validator->errors()
                ], 422);
            }

            $fileName = null;
            if($request->cover_image) {
                $fileName = time() . '.' . $request->cover_image->getClientOriginalExtension();
                $request->cover_image->storeAs('books', $fileName, ['disk' => 'books']);
            }
            
            $store = Book::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'cover_image' => $fileName,
                'status' => $request->status == 'Active' ? 1 : 2,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Book created successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function updateBook(Request $request, $id = null)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required|max:255',
                'price' => 'required|numeric',
                'status' => 'required',
            ]);
     
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation error.',
                    'errors'=>$validator->errors()
                ], 422);
            }

            $fileName = (Book::where('id', $id)->first('cover_image'))->cover_image;
            if(!is_string($request->cover_image)) {
                $fileName = time() . '.' . $request->cover_image->getClientOriginalExtension();
                $request->cover_image->storeAs('books', $fileName, ['disk' => 'books']);
            }
            
            $store = Book::where('id', $id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'cover_image' => $fileName,
                'status' => $request->status == 'Active' ? 1 : 2,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Book updated successfully.'
            ], 200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function destroyBook($id)
    {
        try {
            Book::where('id', $id)->delete();

            return response()->json([
                'status' => true,
                'message' => 'Book deleted successfully.'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong'
            ], 500);
        }
    }
}
