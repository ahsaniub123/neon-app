<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Pricing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){

        $colors = Color::all();
        return view('app.color')->with([
            'colors' => $colors
        ]);
    }
    public function save(Request $request){
        $color = new Color();
        $color->title = $request->title;
        $color->color = $request->color;
        $color->save();
        return redirect()->back()->with('success', 'New Board Color Added Successfully');
    }
    public function update(Request $request, $id){
        $color = Color::find($id);
        $color->title = $request->title;
        $color->color = $request->color;
        $color->save();
        return redirect()->back()->with('success', 'Board Color Updated Successfully');
    }
    public function delete($id){
        $color = Color::find($id);
        $color->delete();
        return redirect()->back()->with('warning', 'Board Color Deleted Successfully');
    }
}
