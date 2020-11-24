<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use Auth;
class TypeController extends Controller
{
    public function getAll() {
        $types = Type::all()->take(4);
        $loggedIn = Auth::check();
        return $loggedIn ? redirect('/product/search') : view('welcome')->with('data',$types);
    }
        
}
