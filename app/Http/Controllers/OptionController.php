<?php

namespace App\Http\Controllers;

use App\Models\FontFamily;
use App\Models\Option;
use App\Models\SliderPicture;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function options_index(){
        $option_price = Option::first();
        return view('app.board-options')->with([
            'option_price'=> $option_price,
        ]);
    }
    public function board_options_save(Request $request){
        $has_price = Option::first();
        if ($has_price == null) {
            $has_price = new Option();
            $has_price->indoor = $request->indoor;
            $has_price->outdoor = $request->outdoor;
            $has_price->remote_dimmer = $request->remote_dimmer;
            $has_price->wall_mounting = $request->wall_mounting;
            $has_price->sign_hang = $request->sign_hang;
            $has_price->cut_around_acrylic = $request->cut_around_acrylic;
            $has_price->rectangle_acrylic = $request->rectangle_acrylic;
            $has_price->cut_letter = $request->cut_letter;
            $has_price->acrylic_stand = $request->acrylic_stand;
            $has_price->open_box = $request->open_box;
            $has_price->save();
            return redirect()->route('board.pricing.all')->with('success', 'Options Prices Added Successfully');
        }else{
            $has_price->indoor = $request->indoor;
            $has_price->outdoor = $request->outdoor;
            $has_price->remote_dimmer = $request->remote_dimmer;
            $has_price->wall_mounting = $request->wall_mounting;
            $has_price->sign_hang = $request->sign_hang;
            $has_price->cut_around_acrylic = $request->cut_around_acrylic;
            $has_price->rectangle_acrylic = $request->rectangle_acrylic;
            $has_price->cut_letter = $request->cut_letter;
            $has_price->acrylic_stand = $request->acrylic_stand;
            $has_price->open_box = $request->open_box;
            $has_price->save();
            return redirect()->route('board.pricing.all')->with('success', 'Options Prices Added Successfully');
        }
        }
        public function options_prices(){
            $option_price = Option::first();
            if($option_price->indoor == null){
                $option_price->indoor = "0" ;
            }
            if($option_price->outdoor == null){
                $option_price->outdoor = "0" ;
            }
            if($option_price->remote_dimmer == null){
                $option_price->remote_dimmer = "0" ;
            }
            if($option_price->wall_mounting == null){
                $option_price->wall_mounting = "0" ;
            }
            if($option_price->sign_hang == null){
                $option_price->sign_hang = "0" ;
            }
            if($option_price->cut_around_acrylic == null){
                $option_price->cut_around_acrylic = "0" ;
            }
            if($option_price->rectangle_acrylic == null){
                $option_price->rectangle_acrylic = "0" ;
            }
            if($option_price->rectangle_acrylic == null){
                $option_price->rectangle_acrylic = "0" ;
            }
            if($option_price->cut_letter == null){
                $option_price->cut_letter = "0" ;
            }
            if($option_price->acrylic_stand == null){
                $option_price->acrylic_stand = "0" ;
            }
            if($option_price->open_box == null){
                $option_price->open_box = "0" ;
            }
            $data = array(
                'indoor' => $option_price->indoor,
                'outdoor' => $option_price->outdoor,
                'remote_dimmer' => $option_price->remote_dimmer,
                'wall_mounting' => $option_price->wall_mounting,
                'sign_hang' => $option_price->sign_hang,
                'cut_around_acrylic' => $option_price->cut_around_acrylic,
                'rectangle_acrylic' => $option_price->rectangle_acrylic,
                'cut_letter' => $option_price->cut_letter,
                'acrylic_stand' => $option_price->acrylic_stand,
                'open_box' => $option_price->open_box,
            );
            return response()->json($data);
        }
        public function SlidPictures(){
        $pictures = SliderPicture::get();
        return view('app.slider-pictures')->with([
            'pictures'=>$pictures,
        ]);
        }
        public function PictureSave(Request $request){
            $picture = new SliderPicture();
            $picture->title = $request->title;
            $file = $request->file('url');
            $input['url'] = $file->getClientOriginalName();
            $file->move(public_path('slider_pictures'),$file->getClientOriginalName());
            $picture->picture = $input['url'];
            $picture->save();
            return redirect()->back()->with('success', 'Slider Picture Added Successfully');
        }
        public function PictureUpdate(Request $request,$id){
        $picture = SliderPicture::where('id',$id)->first();
            $picture->title = $request->title;
            $file = $request->file('url');
            $input['url'] = $file->getClientOriginalName();
            $file->move(public_path('slider_pictures'),$file->getClientOriginalName());
            $picture->picture = $input['url'];
            $picture->save();
            return redirect()->back()->with('success', 'Slider Picture Updated Successfully');
        }
        public function PictureDelete($id){
        $picture = SliderPicture::where('id',$id)->fist();
        $picture->delete();
            return redirect()->back()->with('success', 'Slider Picture Deleted Successfully');
        }
}
