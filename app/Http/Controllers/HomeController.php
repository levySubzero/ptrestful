<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addInfo($id=null)
    {
        $user = $id == null ? auth()->user() : User::where('id', $id)->first();
        return view('form', compact('user'));
    }

    public function newInfo()
    {
        return view('form');
    }

    public function allInfo()
    {
        $users = User::get();
        return view('infos', compact('users'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'town' => ['required', 'string'],
            'gender' => ['required'],
        ]);
    }

    public function storeInfo(Request $request, $id=null)
    {
        $data = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'town' => 'required|string',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid information.');;
        }

        User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['name'] . $data['age'] . '@gmail.com',
            'age' => $data['age'],
            'town' => $data['town'],
            'gender' => $data['gender'],    
            'password' => '12345678',            
        ]);
        return redirect()->route('info.all')->with('success', 'New Record added.');;
    }

    public function updateInfo(Request $request, $id=null)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'age' => 'required|integer',
            'town' => 'required|string',
            'gender' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Invalid information.');;
        }
        $info = $request->all();
        $user = $id == null ? auth()->user() : User::where('id', $id)->first();
        $user->update($info);
        return redirect()->back()->with('success', 'Updated Successfuly.');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->back()
                        ->with('success','User deleted');
    }
}
