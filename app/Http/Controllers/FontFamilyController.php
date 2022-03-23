<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\FontFamily;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FontFamilyController extends Controller
{
    public function index()
    {

        $fonts = FontFamily::latest()->paginate(50);
        return view('app.fonts')->with([
            'fonts' => $fonts
        ]);
    }

    public function save(Request $request)
    {
//        dd($request->all());
//        $request->validate([
//            'url' => 'required|mimes:ttf',
//        ]);
        $font = new FontFamily();
        $font->title = $request->title;
        $font->price = $request->price;
        $font->size = $request->size;
        $font->type = $request->type;
        $file = $request->file('url');
        $input['url'] = $file->getClientOriginalName();
        $file->move(public_path('font_files_upload'),$file->getClientOriginalName());
        $font->url = $input['url'];
        $font->save();
        return redirect()->back()->with('success', 'New Font Family Added Successfully');
    }

    public function update(Request $request, $id)
    {
//        $request->validate([
//            'url' => 'required|mimes:ttf',
//        ]);
        $font = FontFamily::find($id);
        $font->title = $request->title;
        $font->price = $request->price;
        $font->size = $request->size;
        $font->type = $request->type;
        if (filled($request->file('url'))){
            $file = $request->file('url');
            $input['url'] = $file->getClientOriginalName();
            $file->move(public_path('font_files_upload'),$file->getClientOriginalName());
            $font->url = $input['url'];
        }
        $font->save();
        return redirect()->back()->with('success', 'Font Family Updated Successfully');
    }

    public function delete($id)
    {
        $font = FontFamily::find($id);
        $font->delete();
        return redirect()->back()->with('warning', 'Font Family Deleted Successfully');
    }
    public function PriceFormula(Request $request){
        $fontfamilies = FontFamily::get();
        if (count($fontfamilies) > 0 ){
            foreach ($fontfamilies as $fontfamily){
                $fontfamily->price_formula = $request->price_formula;
                $fontfamily->save();
            }
        }else{
            $fontfamily = new FontFamily();
            $fontfamily->price_formula = $request->price_formula;
            $fontfamily->save();
        }
        return redirect()->back()->with('success', 'Number added Successfully');
    }
}
