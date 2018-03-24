<?php

use Illuminate\Database\Seeder;

class imforsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imformations')->insert([
        	['birth'=>'1997-12-16', 'address'=>'Hung Yen', 'phone'=>'0973248051'],
        	['birth'=>'1997-05-03', 'address'=>'Ha Noi', 'phone'=>'0936325705']
        ]);
    }
}
