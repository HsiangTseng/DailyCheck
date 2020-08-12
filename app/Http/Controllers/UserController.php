<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\MyDB\UserModel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_account()
    {
        $account = $_POST['account'];
        $pwd = $_POST['password'];

        $user_exist = DB::table('users')->where('account', $account)->where('password', $pwd)->count();

        //User exist.
        if($user_exist){
            $user_id = DB::table('users')->where('account', $account)->pluck('id');
            $stock = DB::table('stock')->where('user_id', $user_id)->first();
            $stock_list = $stock->stock_list;
            $data = 
            [
                'User' => $account,
                'Stock' => $stock_list
            ];
            return view('dashboard.frontend.Home')->with($data);
        }
        //User NOT exist.
        else{
            //return redirect()->route('WrongUser');
            $error_msg = 'No PWD';
            return redirect()->back()->with(['id' => $error_msg]);

        }
    }

    public function register()
    {
        //GET ALL DATA
        $input = request()->all();
        //var_dump($input);
        

        $rules = [
            'account'=>[
                'required',
                'max:30',
                'min:6',
            ],

            'email'=>[
                'required',
                'max:50',
                'email',
            ],

            'password'=>[
                'required',
                'same:check_password',
                'min:6',
            ],

            'check_password'=>[
                'required',
                'min:6',
            ],
        ];

        //valid
        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect('/Register')
            ->withErrors($validator)
            ->withInput();
            //withInput let the blade.php can use old data, like {{ old('account') }}
        }

        //Hash the password
        $input['password'] = Hash::make($input['password']);
        
        //Create in db
        $Users = UserModel::create($input);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
