<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardPricing;
use App\Models\CharacterDiemension;
use App\Models\FontGroup;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function boards_index(Board $board){
        $board = $board->newQuery();
        $boards = $board->get();
        return view('app.boards_index')->with([
            'boards' => $boards,
        ]);
    }
    public function bulk_board_append(Board $board,$disable_font_divs_count){

        $html = view('append.bulk_board_append')->with('disable_font_divs_count',$disable_font_divs_count)->render();
        $data = [
            'html'=>$html
        ];
        return response()->json($data);
    }
    public function bulk_board_pricing_append(){

        $html = view('append.bulk_board_pricing_append')->render();
        $data = [
            'html'=>$html
        ];
        return response()->json($data);
    }

    public function bulk_char_dime_new()
    {
        return view('app.bulk_char_dimen');
    }

    public function bulk_char_diem_append(){

        $html = view('append.bulk_char_dimen_append')->render();
        $data = [
            'html'=>$html
        ];
        return response()->json($data);
    }
    public function board_pricing_index(BoardPricing $board_pricing){
        $board_pricing = $board_pricing->newQuery();
        $board_pricings = $board_pricing->paginate(50);
        return view('app.board_pricing_index')->with([
            'board_pricings' => $board_pricings,
        ]);
    }
    public function font_group_index(FontGroup $font_group){
        $font_group = $font_group->newQuery();
        $font_groups = $font_group->get();
        return view('app.font_groups_index')->with([
            'font_groups' => $font_groups,
        ]);
    }
    public function character_diemensions_index(CharacterDiemension $char_diemension){
        $char_diemension = $char_diemension->newQuery();
        $char_diemensions = $char_diemension->paginate(50);
        return view('app.char_diemension_index')->with([
            'char_diemensions' => $char_diemensions,
        ]);
    }

    public function board_create()
    {
        return view('app.board_create');
    }
    public function bulk_board_pricing_create()
    {
        return view('app.bulk_board_pricing_create');
    }
    public function bulk_board_pricing_edit()
    {
        $board_pricings = BoardPricing::paginate(50);
        return view('app.bulk_board_pricing_edit',compact('board_pricings'));
    }
    public function bulk_char_dime_edit()
    {
        $char_dimensions = CharacterDiemension::paginate(50);
        return view('app.bulk_char_dime_edit',compact('char_dimensions'));
    }
    public function board_pricing_create()
    {
        return view('app.board_pricing_create');
    }

    public function font_group_new()
    {
        return view('app.font_group_create');
    }

    public function character_diemensions_new_create()
    {
        return view('app.char_diemension_create');
    }

    public function board_save(Request $request){
        $board = new Board();
        $board->title = $request->title;
        $board->length_min = $request['min_length'];
        $board->min_height = $request['min_height'];
        $board->length_max = $request['max_length'];
        $board->max_height = $request['max_height'];
        $board->save();
        if(count($request['disable_fonts'])){
            $board->fonts()->attach($request['disable_fonts']);
        }
        return redirect()->route('boards')->with('success', 'New Board Added Successfully');
    }

//    public function bulk_board_save(Request $request){
//
//        $board = new Board();
//        $board->title = $request->title;
//        $board->length_min = $request['min_length'];
//        $board->min_height = $request['min_height'];
//        $board->length_max = $request['max_length'];
//        $board->max_height = $request['max_height'];
//        $board->save();
//        if(count($request['disable_fonts'])){
//            $board->fonts()->attach($request['disable_fonts']);
//        }
//        return redirect()->route('boards')->with('success', 'New Board Added Successfully');
//    }

    public function board_pricing_save(Request $request){
        $board_pricing = new BoardPricing();
        $board_pricing->characters_count = $request->char_count;
        $board_pricing->font_group_id = $request->font_group_id;
        $board_pricing->board_id = $request->board_id;
        $board_pricing->pricing = $request->pricing;
        $board_pricing->save();
        return redirect()->route('board_pricing')->with('success', 'New Board Pricing Added Successfully');
    }

    public function bulk_board_pricing_save(Request $request){
        if(isset($request['char_count']) && count($request['char_count'])){
            foreach ($request['char_count'] as $key => $char_count){
//                dd($request->char_count[]);
                $board_pricing = BoardPricing::where('characters_count',$request->char_count[$key])->where('font_group_id',$request->font_group_id[$key])->where('board_id',$request->board_id[$key])->first();
                if($board_pricing == null){
                    $board_pricing = new BoardPricing();
                }
                $board_pricing->characters_count = $request->char_count[$key];
                $board_pricing->font_group_id = $request->font_group_id[$key];
                $board_pricing->board_id = $request->board_id[$key];
                $board_pricing->pricing = $request->pricing[$key];
                $board_pricing->save();
            }
        }

        return redirect()->route('board_pricing')->with('success', 'New Bulk Board Pricing Added Successfully');
    }

    public function bulk_char_dimen_save(Request $request){
        if(isset($request['char_name']) && count($request['char_name'])){
            foreach ($request['char_name'] as $key => $char_name){
//                dd($request->char_count[]);
                $chara_diemn = CharacterDiemension::where('char_name',$request->char_name[$key])->where('board_size',$request->board_size[$key])->where('char_type',$request->char_type[$key])->where('font_type',$request->font_type[$key])->first();
                if($chara_diemn == null){
                    $chara_diemn = new CharacterDiemension();
                }
                $chara_diemn->char_name = $request->char_name[$key];
                $chara_diemn->char_type = $request->char_type[$key];
                $chara_diemn->font_type = $request->font_type[$key];
                $chara_diemn->board_size = $request->board_size[$key];
                $chara_diemn->length = $request->length[$key];
                $chara_diemn->height = $request->height[$key];
                $chara_diemn->save();
            }
        }

        return redirect()->route('character_diemensions')->with('success', 'New Charachter Diemensions Added Successfully');
    }

    public function font_group_save(Request $request){
        $font_group = new FontGroup();
        $font_group->title = $request->title;
        $font_group->save();
        if(isset($request['fonts']) && count($request['fonts'])){
            $font_group->fonts()->attach($request['fonts']);
        }
        return redirect()->route('font_group')->with('success', 'New Font Group Added Successfully');
    }

    public function character_diemensions_save(Request $request){
        $char_dimension = new CharacterDiemension();
        $char_dimension->char_type = $request->char_type;
        $char_dimension->char_name = $request['char_name'];
        $char_dimension->font_type = $request['font_type'];
        $char_dimension->board_size = $request['board_size'];
        $char_dimension->length = $request['length'];
        $char_dimension->height = $request['height'];
        $char_dimension->save();

        return redirect()->route('character_diemensions')->with('success', 'New Character Diemension Added Successfully');
    }


    public function delete($id)
    {
        $board = Board::find($id);

        $board->fonts()->detach();

        $board->delete();

        return redirect()->back()->with('warning', 'Board Deleted Successfully');
    }
    public function board_pricing_delete($id)
    {
        $board_pricing = BoardPricing::find($id);

        $board_pricing->delete();

        return redirect()->back()->with('warning', 'Board Pricing Deleted Successfully');
    }

    public function font_group_delete($id)
    {
        $font_group = FontGroup::find($id);

        $font_group->delete();

        return redirect()->back()->with('warning', 'Font Group Deleted Successfully');
    }
    public function character_diemensions_delete($id)
    {
        $char_die = CharacterDiemension::find($id);
        $char_die->delete();

        return redirect()->back()->with('warning', 'Character Diemension Deleted Successfully');
    }

    public function update(Request $request,$id){
        $board = Board::find($id);
        if($board == null){
            $board = new Board();
        }
        $board->title = $request->title;
        $board->length_min = $request['min_length'];
        $board->min_height = $request['min_height'];
        $board->length_max = $request['max_length'];
        $board->max_height = $request['max_height'];
        $board->save();
        if(isset($request['disable_fonts']) && count($request['disable_fonts'])){
            $board->fonts()->sync($request['disable_fonts']);
        }else{
            $board->fonts()->delete();
        }
        return redirect()->route('boards')->with('success', 'Board Updated Successfully');
    }
    public function board_pricing_update(Request $request,$id){
        $board = BoardPricing::find($id);
        if($board == null){
            $board = new BoardPricing();
        }
        $board->characters_count = $request->char_count;
        $board->pricing = $request->pricing;
        $board->font_group_id = $request->font_group_id;
        $board->board_id = $request->board_id;
        $board->save();

        return redirect()->route('board_pricing')->with('success', 'Board Pricing Updated Successfully');
    }
    public function bulk_board_pricing_update(Request $request,$id){
//        dd($request->all());
        $board = BoardPricing::find($id);
//        dd($request->all(),$id,$board);
        if($board == null){
            $board = new BoardPricing();
        }
        $board->characters_count = $request->char_count;
        $board->pricing = $request->pricing;
        $board->font_group_id = $request->font_group_id;
        $board->board_id = $request->board_id;
        if($board->save()){
            $data = array(
                'status'=>'success'
            );
        }else{
            $data = array(
                'status'=>'failed'
            );
        }

        return response()->json($data);
    }
    public function bulk_char_dime_update(Request $request,$id){
//        dd($request->all());
        $char_dimension = CharacterDiemension::find($id);
        if($char_dimension == null){
            $char_dimension = new CharacterDiemension();
        }
        $char_dimension->char_type = $request->char_type;
        $char_dimension->char_name = $request['char_name'];
        $char_dimension->font_type = $request['font_type'];
        $char_dimension->board_size = $request['board_size'];
        $char_dimension->length = $request['length'];
        $char_dimension->height = $request['height'];
        $char_dimension->save();
        if($char_dimension->save()){
            $data = array(
                'status'=>'success'
            );
        }else{
            $data = array(
                'status'=>'failed'
            );
        }

        return response()->json($data);
    }
    public function font_group_update(Request $request,$id){
        $font_group = FontGroup::find($id);
        if($font_group == null){
            $font_group = new FontGroup();
        }
        $font_group->title = $request->title;
        if(isset($request['fonts']) && count($request['fonts'])){
            $font_group->fonts()->sync($request['fonts']);
        }else{
            $font_group->fonts()->delete();
        }

        $font_group->save();

        return redirect()->route('font_group')->with('success', 'Font Group Updated Successfully');
    }

    public function character_diemensions_update(Request $request,$id){
        $char_dimension = CharacterDiemension::find($id);
        if($char_dimension == null){
            $char_dimension = new CharacterDiemension();
        }
        $char_dimension->char_type = $request->char_type;
        $char_dimension->char_name = $request['char_name'];
        $char_dimension->font_type = $request['font_type'];
        $char_dimension->board_size = $request['board_size'];
        $char_dimension->length = $request['length'];
        $char_dimension->height = $request['height'];
        $char_dimension->save();
        return redirect()->route('character_diemensions')->with('success', 'Character Dimension Updated Successfully');
    }
}
