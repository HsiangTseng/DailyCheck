<?php

namespace App\Http\Controllers;

use DB;
use Response;
use Illuminate\Http\Request;
use Validator;
use Hash;
use App\MyDB\UserModel;
use App\MyDB\StockModel;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function loginProcess()
    {
        $input = request()->all();
        $rules = [
            'account'=>[
                'required',
                'max:30',
                'min:6',
            ],

            'password'=>[
                'required',
                'min:6',
            ],
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails())
        {
            return redirect('/Login')
            ->withErrors($validator)
            ->withInput();
            //withInput let the blade.php can use old data, like {{ old('account') }}
        }

        $check_user_exist = UserModel::where('account', $input['account'])->count();

        if($check_user_exist){
            $User = UserModel::where('account', $input['account'])->firstOrFail();
            $pwd_correct = Hash::check($input['password'], $User->password);


            if(!$pwd_correct){
                $error_msg = [
                    'msg' => [
                        '密碼錯誤',
                    ],
                ];
                return redirect()->back()->withErrors($error_msg)->withInput();
            }
        }
        else{
            $error_msg = [
                'msg' => [
                    '查無此帳號',
                ],
            ];
            return redirect()->back()->withErrors($error_msg)->withInput();
        }

        //IF USER RIGHT, PASS THE DATA
        $user_id = $User->id;
        $Stock = StockModel::where('user_id',$user_id)->first();
        $data =
        [
            'User' => $input['account'],
            'Stock' => $Stock->stock_list,
        ];
        return redirect('Workspace')
        ->with([
            'User' => $input['account'],
            'Stock' => $Stock->stock_list,
            ]);
        
        
        /*
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
        }*/
    }

    public function registerProcess()
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
        
        return redirect('Login')->with([
            'registered' => '1',
        ]);
 

    }


}
