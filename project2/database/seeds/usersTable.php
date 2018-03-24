<?php

use Illuminate\Database\Seeder;
	
class usersTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	['name'=>'Tran Viet Huy', 'email'=>'huytran161297@gmail.com', 'password'=>bcrypt('jessepinkman'), 'posision'=>2],
        	['name'=>'Pham Hoan', 'email'=>'hoankhac123@gmail.com', 'password'=>bcrypt('hoankhac123'), 'posision'=>1]
        ]);
    }
}
