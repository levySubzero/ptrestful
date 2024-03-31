<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function allInfo()
    {
        $users = User::get();
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'data'=>$users,
        ]);
    }

    public function storeInfo(Request $request, $id=null)
    {
        Log::info(json_encode($request->name));
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'town' => 'required|string',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code'=>200,
                'status'=>'ok',
                'message'=>['error'=>$validator->errors()->all()],
            ]);
        }

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['name'] . $data['age'] . '@gmail.com',
            'age' => $data['age'],
            'town' => $data['town'],
            'gender' => $data['gender'],    
            'password' => '12345678',            
        ]);
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'user'=>$user,
        ]);
    }

    public function updateInfo(Request $request, $id=null)
    {
        // Log::info(json_encode($request->name));
        $info = $request->all();
        $user = $id == null ? auth()->user() : User::where('id', $id)->first();
        $user->update($info);
        return response()->json([
            'code'=>200,
            'status'=>'ok',
            'user'=>$user,
        ]);
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json([
            'status'=>'Ok',
            'message'=>'User deleted',
        ]);
    }
}
