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
        	['birth'=>'1997-12-16', 'address'=>'Hung Yen', 'phone'=>'0973248051','id_employee'=>1],
        	['birth'=>'1997-05-03', 'address'=>'Ha Noi', 'phone'=>'0936325705','id_employee'=>2],
            ['birth'=>'1997-05-03', 'address'=>'Vinh Phuc', 'phone'=>'093632575','id_employee'=>3]
        ]);
    }
}
