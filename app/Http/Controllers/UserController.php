<?php

namespace App\Http\Controllers;

use DB;
use Response;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check_account()
    {
        $username = $_POST['name'];
        $pwd = $_POST['password'];

        $user = DB::table('users')->where('username', $username)->where('password', $pwd)->count();

        $user_id = DB::table('users')->where('username', $username)->pluck('id');

        $stock = DB::table('stock')->where('user_id', $user_id)->first();
        $stock_list = $stock->stock_list;

        if($user > 0){
            $data = 
            [
                'User' => $username,
                'Stock' => $stock_list
            ];
            return view('dashboard.frontend.Home')->with($data);
        }
        else{
            return redirect('/WrongUser');
        }
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
