<?php

namespace App\Http\Controllers;

use Session;
use App\Item;
use Illuminate\Http\Request;

use App\Http\Requests;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {

    }

    public function index()
    {
        $items = Item::paginate(15);
        return view('items.index')->withItems($items);
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        //dd($request->input());
        $this->validate($request, [
            'id_bmn' => 'required'
        ]);

        $input = $request->all();
        item::create($input);

        Session::flash('flash_message','Task Succesfully Added!');

        return redirect()->back();

    }

    public function show($id)
    {
        $item = Items::find($id);
        return view('items.show')->withItem($task);
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        return view('items.edit')->withItem($item);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $this->validate($request, [
            'id_bmn' => 'required'
        ]);

        $input = $request->all();
        $item->fill($input)->save();
        Session::flash('flash_message','Task successfully edited!');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        Session::flash('flash_message','Item successfully Delete');

        return redirect()->route('items.index');
    }
}
