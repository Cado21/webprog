<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Type;
use App\Transaction;
use Auth;
use Validator;
use App\Providers\RouteServiceProvider;
class TypeController extends Controller
{
    public function index() {
        $transactions = Transaction::with(['details' => function ($query) {
            $query->orderBy('quantity', 'desc');
        }])->get();

        $typeIdsCount = [];
        foreach( $transactions as $transaction ) {
            foreach( $transaction->details as $detail ) {
                $typeNotDeleted = Type::find($detail->type_id);
                if ( $typeNotDeleted ) {
                    $typeIdExist = array_key_exists( $detail->type_id , $typeIdsCount );
                    $typeIdsCount[$detail->type_id] = $typeIdExist ? $typeIdsCount[$detail->type_id]+1 : 1;
                }
            }
        }
        arsort($typeIdsCount);
        $typeIdsCount = array_slice($typeIdsCount, 0, 4, true); 
        // dd ( $typeIdsCount );
        if ( count ($typeIdsCount) < 4 ) {
            $typeToBeAppend = Type::all()->take( 4 - count($typeIdsCount) );
            foreach( $typeToBeAppend as $type ) $typeIdsCount[$type->id] = 1;
        } 
        $typeIds = array_keys($typeIdsCount);
        // dd( $typeIds );
        $tempStr = implode(',', $typeIds);
        $data = Type::whereIn('id', $typeIds)
            ->orderByRaw("FIELD(id, $tempStr)")
            ->get();

        $loggedIn = Auth::check();
        return $loggedIn ? redirect(RouteServiceProvider::SEARCH) : view('welcome')->with('data',$data);
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
            'name' => 'required|min:5|unique:types',
            'image' => 'required',
        ];
        $messages = [
            'name.required'         => 'name wajib diisi',
            'image.required'        => 'image wajib diisi',
            'name.unique'           => 'stationary with name "' . $req->name . '" already taken',
        ];
        
        $validator = Validator::make($req->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
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
            'name' => 'required|min:5|unique:types',
        ];
        $messages = [
            'name.required'         => 'nama wajib diisi',
            'name.unique'           => 'stationary with name "' . $req->name . '" already taken',
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
