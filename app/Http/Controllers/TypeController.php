<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Type;
use Auth;
use Validator;
class TypeController extends Controller
{
    public function index() {
        $types = Type::all()->take(4);
        $loggedIn = Auth::check();
        return $loggedIn ? redirect('/search') : view('welcome')->with('data',$types);
    }
    public function showCreateType() {
        $types = Type::all();
        return view('createType')->with('data',$types);
    }
    public function showEditType() {
        $types = Type::all();
        return view('editType')->with('data', $types);
    }
    public function getOne( $id ) {
        $type = Type::find(1);
        return view('type')->with('data',$type);
    }
    
    public function create( Request $req ) {
        $rules = [
            'name' => 'required|min:5',
            'image' => 'required',
        ];
        $messages = [
            'name.required'         => 'name wajib diisi',
            'image.required'        => 'image wajib diisi',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
            ->withErrors($validator)
            ->withInput();
        }

        $typeIsFound = Type::where( 'name' , '=' , $req->name )->first();
        if ($typeIsFound) {
            return redirect()->back()
                ->withErrors('Stationary type must be unique');
        }

        $type = new Type();
        $image = $req->file('image');
        $imageName = $image->getClientOriginalName();
        $uniqueName = generateUniqueFileName($imageName);
        $image->move('images', $uniqueName);

        $type->name = $req->name;
        $type->image = $uniqueName;
        $type->save();

        return redirect()->back()
                    ->with('createdData', $type );   
    }
    public function editTypeName( Request $req , $id ) {
        $type = Type::find($id);
        
        $rules = [
            'name' => 'required|min:5',
        ];
        $messages = [
            'name.required'         => 'nama wajib diisi',
        ];

        $validator = Validator::make($req->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } else {
            $type->name = $req->name;
            $type->save();
        }
        return redirect()->back()
                ->with('editedData', $type ); 
    }
    public function delete( Request $req , $id  ) {
        $type = Type::find($id);
        if ( !$type ) {
            return redirect()->back()
                        ->withErrors('File with id: '. $id .'not found');
        }
        // deleteLocalImage($type->image);
        $type->delete();
        
        return redirect()->back()
                ->with('deletedData', $type );   
    }
    
}
