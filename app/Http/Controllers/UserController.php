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
        session()->put('user_account',$input['account']);
        session()->put('user_id',$user_id);
        session()->put('user_stock_list',$Stock->stock_list);
        //I use session to pass the user account and stock_list, make sure the data will keep when user do F5 in browser

        $data =
        [
            'User' => $input['account'],
            'User_id' => $user_id,
            'Stock' => $Stock->stock_list,
        ];
        return redirect('Home')
        ->with([
            'User' => $input['account'],
            'User_id' => $user_id,
            'Stock' => $Stock->stock_list,
            ]);
        
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
