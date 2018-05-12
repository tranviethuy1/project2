<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class TemplateController extends Controller
{
	public function showListTemplate(){
		$lists = DB::table('templates')->paginate('6');
		return view('template')->with('lists',$lists);
	}
	
}
