<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Plate;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PlateController extends Controller
{

    protected $validation = [
        'name' => 'required|string|max:75',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        // 'plate_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $plates = Plate::where('user_id', $user->id)->get();

        $plates = $plates->all();
        
        return view('admin.index', compact('user', 'plates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $types = Type::all();


        return view('admin.create', compact('user', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();
        $validation = $this->validation;

        // validation
        $request->validate($validation);

        
        $data = $request->all();

        // conotrollo disponibilità
        $data['available'] = !isset($data['available']) ? 0 : 1;
        if ( isset($data['plate_img'])) {
            $data['plate_img'] = Storage::disk()->put('images', $data['plate_img']);
        } else {
            $data['plate_img'] = 'images/default.jpeg';
        }
        
        $data['user_id'] = $user->id;
        // creazione nuovo piatto
        $newPlate = Plate::create($data);

        // controllo checkbox types e attach
        if( isset($data['types']) ){
            $newPlate->types()->attach($data['types']);
        }

        return redirect()->route('admin.plate.index');
        
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
    public function destroy(Plate $plate)
    {
        $plate->delete();

        return redirect()->route('user.plate.index')->with('message', 'Il piatto è stato eliminato!');
    }
}
