<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert([
            'account' => 'SigMozet',
            'email'    => 'sos7887961@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
