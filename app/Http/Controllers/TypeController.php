<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
class TypeController extends Controller
{
    public function getAll() {
        $types = Type::all()->take(4);
        return view('welcome')->with('data',$types);
    }
        
}
