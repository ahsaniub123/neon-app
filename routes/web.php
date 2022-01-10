<?php

use App\Models\Board;
use Illuminate\Support\Facades\Route;

//This will redirect user to login page.
Route::get('/login', function () {
    if (Auth::user()) {
        return redirect()->route('home');
    }
    return view('login');
})->name('login');

Route::group(['middleware' => ['auth.shopify']], function () {
    Route::get('/', [\App\Http\Controllers\BoardController::class, 'board_pricing_index'])->name('home');
    //Board Size & Pricing Crud
    Route::get('/board/pricing', [\App\Http\Controllers\BoardSizeController::class, 'index'])->name('board.pricing.all');
    Route::get('/board/pricing/new', [\App\Http\Controllers\BoardSizeController::class, 'create'])->name('board.pricing.new');
    Route::get('bulk/char/dime/new', [\App\Http\Controllers\BoardController::class, 'bulk_char_dime_new'])->name('bulk_char_dime.new');
    Route::post('/board/pricing/save', [\App\Http\Controllers\BoardSizeController::class, 'save'])->name('board.pricing.save');
    Route::any('/board/pricing/{id}/update', [\App\Http\Controllers\BoardSizeController::class, 'update'])->name('board.pricing.update');
    Route::any('/board/pricing/{id}/delete', [\App\Http\Controllers\BoardSizeController::class, 'delete'])->name('board.pricing.delete');
//Colors Crud
    Route::get('/board/colors', [\App\Http\Controllers\ColorController::class, 'index'])->name('board.color.all');
    Route::post('/board/colors/save', [\App\Http\Controllers\ColorController::class, 'save'])->name('board.color.save');
    Route::any('/board/colors/{id}/update', [\App\Http\Controllers\ColorController::class, 'update'])->name('board.color.update');
    Route::any('/board/colors/{id}/delete', [\App\Http\Controllers\ColorController::class, 'delete'])->name('board.color.delete');
//Font Family Crud
    Route::get('/board/fonts', [\App\Http\Controllers\FontFamilyController::class, 'index'])->name('board.font.all');
    Route::post('/board/fonts/save', [\App\Http\Controllers\FontFamilyController::class, 'save'])->name('board.font.save');
    Route::any('/board/fonts/{id}/update', [\App\Http\Controllers\FontFamilyController::class, 'update'])->name('board.font.update');
    Route::any('/board/fonts/{id}/delete', [\App\Http\Controllers\FontFamilyController::class, 'delete'])->name('board.font.delete');

    // Options
    Route::get('board-options', [\App\Http\Controllers\OptionController::class, 'options_index'])->name('board.options');
    Route::post('board/options/save', [\App\Http\Controllers\OptionController::class, 'board_options_save'])->name('options.save');

    // slider pictures
    Route::get('slid/pictures', [\App\Http\Controllers\OptionController::class, 'SlidPictures'])->name('slid.pictures');
    Route::post('picture/save', [\App\Http\Controllers\OptionController::class, 'PictureSave'])->name('picture.save');
    Route::post('picture/update/{id}', [\App\Http\Controllers\OptionController::class, 'PictureUpdate'])->name('picture.update');
    Route::get('picture/delete/{id}', [\App\Http\Controllers\OptionController::class, 'PictureDelete'])->name('picture.delete');

//    boards
    Route::get('boards', [\App\Http\Controllers\BoardController::class, 'boards_index'])->name('boards');
    Route::get('/bulk_board_append/{id}', [\App\Http\Controllers\BoardController::class, 'bulk_board_append'])->name('bulk-board-append');
    Route::get('/bulk_board_pricing_append', [\App\Http\Controllers\BoardController::class, 'bulk_board_pricing_append'])->name('bulk-board-pricing-append');
    Route::get('/bulk_char_diem_append', [\App\Http\Controllers\BoardController::class, 'bulk_char_diem_append'])->name('bulk-char-diem-append');
    Route::get('board_pricing', [\App\Http\Controllers\BoardController::class, 'board_pricing_index'])->name('board_pricing');
    Route::get('font_group', [\App\Http\Controllers\BoardController::class, 'font_group_index'])->name('font_group');
    Route::get('character/diemensions', [\App\Http\Controllers\BoardController::class, 'character_diemensions_index'])->name('character_diemensions');

    Route::get('/board/new', [\App\Http\Controllers\BoardController::class, 'board_create'])->name('board.new');
    Route::get('/board_pricing/new', [\App\Http\Controllers\BoardController::class, 'board_pricing_create'])->name('board_pricing.new');
    Route::get('/bulk_board_pricing/new', [\App\Http\Controllers\BoardController::class, 'bulk_board_pricing_create'])->name('bulk_board_pricing.new');
    Route::get('/bulk_board_pricing/edit', [\App\Http\Controllers\BoardController::class, 'bulk_board_pricing_edit'])->name('bulk_board_pricing.edit');
    Route::get('/bulk_char_dime/edit', [\App\Http\Controllers\BoardController::class, 'bulk_char_dime_edit'])->name('bulk_char_dime.edit');
    Route::get('/font_group/new', [\App\Http\Controllers\BoardController::class, 'font_group_new'])->name('font_group.new');
    Route::get('character_diemensions.new', [\App\Http\Controllers\BoardController::class, 'character_diemensions_new_create'])->name('character_diemensions.new');

    Route::post('/board/save', [\App\Http\Controllers\BoardController::class, 'board_save'])->name('board.save');
    Route::post('/bulk/board/save', [\App\Http\Controllers\BoardController::class, 'bulk_board_save'])->name('bulk-board.save');
    Route::post('/board_pricing/save', [\App\Http\Controllers\BoardController::class, 'board_pricing_save'])->name('board_pricing.save');
    Route::post('/bulk/board/pricing/save', [\App\Http\Controllers\BoardController::class, 'bulk_board_pricing_save'])->name('bulk-board-pricing.save');
    Route::post('/bulk/char/dimen/save', [\App\Http\Controllers\BoardController::class, 'bulk_char_dimen_save'])->name('bulk-char-dimen.save');
    Route::post('/font_group/save', [\App\Http\Controllers\BoardController::class, 'font_group_save'])->name('font_group.save');
    Route::post('/character_diemensions/save', [\App\Http\Controllers\BoardController::class, 'character_diemensions_save'])->name('character_diemensions.save');

    Route::any('/board/{id}/delete', [\App\Http\Controllers\BoardController::class, 'delete'])->name('board.delete');
    Route::any('/board_pricing/{id}/delete', [\App\Http\Controllers\BoardController::class, 'board_pricing_delete'])->name('board_pricing.delete');
    Route::any('/font_group/{id}/delete', [\App\Http\Controllers\BoardController::class, 'font_group_delete'])->name('font_group.delete');
    Route::any('/character_diemensions/{id}/delete', [\App\Http\Controllers\BoardController::class, 'character_diemensions_delete'])->name('character_diemensions.delete');

    Route::any('/board/{id}/update', [\App\Http\Controllers\BoardController::class, 'update'])->name('board.update');
    Route::any('/board_pricing/{id}/update', [\App\Http\Controllers\BoardController::class, 'board_pricing_update'])->name('board_pricing.update');
    Route::any('/bulk_board_pricing/{id}', [\App\Http\Controllers\BoardController::class, 'bulk_board_pricing_update'])->name('bulk_board_pricing.update');
    Route::any('/bulk_char_dime/{id}', [\App\Http\Controllers\BoardController::class, 'bulk_char_dime_update'])->name('bulk_char_dime.update');
    Route::any('/font_group/{id}/update', [\App\Http\Controllers\BoardController::class, 'font_group_update'])->name('font_group.update');
    Route::any('/character_diemensions/{id}/update', [\App\Http\Controllers\BoardController::class, 'character_diemensions_update'])->name('character_diemensions.update');

});
//Script Crud
Route::any('/data', [\App\Http\Controllers\ScriptController::class, 'index']);
Route::any('/board', [\App\Http\Controllers\ScriptController::class, 'availableBoard']);
Route::any('/orders', [\App\Http\Controllers\ScriptController::class, 'order']);
Route::any('/cartOrders', [\App\Http\Controllers\ScriptController::class, 'cartOrder']);
Route::any('/saveDesign', [\App\Http\Controllers\ScriptController::class, 'saveDesign']);
Route::any('slider/pictures', [\App\Http\Controllers\ScriptController::class, 'SliderPictures']);

Route::any('/discount', [\App\Http\Controllers\ScriptController::class, 'discount']);
Route::any('/options-prices', [\App\Http\Controllers\OptionController::class, 'options_prices']);

Route::get('test',function(){
//    dd(gettype('2'),gettype('a'),gettype('/'));
    dd(1);
//    combination for board pricing

    function get_combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    $character_counts = range(1, 50);
    $font_group = \App\Models\FontGroup::pluck('id');
    $board = \App\Models\Board::pluck('id');
//    dd($board);

//    dd($character_counts,$font_group,$board);

    $combinations = get_combinations(
        array(
            'item1' => $character_counts,
            'item2' => $font_group,
            'item3' => $board,
        )
    );

//    dd($combinations);

    foreach ($combinations as $combination){
//        dd($combination['item1']);

        $board_pricing = \App\Models\BoardPricing::where('board_id',$combination['item3'])->where('characters_count',$combination['item1'])->where('font_group_id',$combination['item2'])->first();
        if($board_pricing == null){
            $board_pricing = new \App\Models\BoardPricing();
        }
        $board_pricing->characters_count = $combination['item1'];
        $board_pricing->font_group_id = $combination['item2'];
        $board_pricing->board_id = $combination['item3'];
        $board_pricing->save();

    }
    dd('Board Pricing Combination Added');

//    combination for char dimenstions
//    function get_combinations($arrays) {
//        $result = array(array());
//        foreach ($arrays as $property => $property_values) {
//            $tmp = array();
//            foreach ($result as $result_item) {
//                foreach ($property_values as $property_value) {
//                    $tmp[] = array_merge($result_item, array($property => $property_value));
//                }
//            }
//            $result = $tmp;
//        }
//        return $result;
//    }
//
//    $lower_alpha = range('a', 'z');
//    $character_type = ['Lower Case','Upper Case'];
//    $font_family = \App\Models\FontFamily::pluck('id');
//    $board = \App\Models\Board::pluck('id');
////    dd($board);
//
////    dump($lower_alpha,$character_type,$font_group,$board);
//
//    $combinations = get_combinations(
//        array(
//            'item1' => $lower_alpha,
//            'item2' => $character_type,
//            'item3' => $font_family,
//            'item4' => $board,
//        )
//    );
//
////    dd($combinations);
//
//    foreach ($combinations as $combination){
////        dd($combination['item1']);
//
//        $character_diemension = \App\Models\CharacterDiemension::where('char_name',$combination['item1'])->where('char_type',$combination['item2'])->where('font_type',$combination['item3'])->where('board_size',$combination['item4'])->first();
//        if($character_diemension == null){
//            $character_diemension = new \App\Models\CharacterDiemension();
//        }
//        $character_diemension->char_name = $combination['item1'];
//        $character_diemension->char_type = $combination['item2'];
//        $character_diemension->font_type = $combination['item3'];
//        $character_diemension->board_size = $combination['item4'];
//        $character_diemension->save();
//
//    }
//    dd('Combination Added');

//    $board = Board::find(9);
//    dd($board->fonts()->detach());
//    $board->fonts()->detach();
});
