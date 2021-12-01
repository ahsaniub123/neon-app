<?php

namespace App\Http\Controllers;

use App\Models\BoardSize;
use App\Models\Pricing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BoardSizeController extends Controller
{
    public function index(BoardSize $boardSize, Request $request)
    {
        $boardQuery = $boardSize->newQuery();
        if ($request->has('type')) {
            if ($request->input('type') != 'all') {
                $boardQuery->where('font_type', $request->input('type'));
            }
        }
        if ($request->has('board')) {
            if ($request->board != 'all') {
                $dimension = explode('*', $request->board);
                $boardQuery->where('length', $dimension[0])->where('width', $dimension[1]);
            }
        }
        $boards = $boardQuery->get();
        return view('app.board')->with([
            'boards' => $boards,
            'type' => $request->input('type'),
            'boardsize' => $request->input('board')
        ]);
    }

    public function create()
    {
        return view('app.newBoard');
    }


    public function save(Request $request)
    {
        foreach ($request->letter_count as $i => $letter) {
            $board = new BoardSize();
            $board->length = $request->length;
            $board->size = $request->size;
            $board->width = $request->width;
            $board->font_type = $request->font_type;
            $board->letter = $letter;
            $board->predicted_length = $request->predicted_length[$i];
            $board->price = $request->price[$i];
            $board->save();
        }
        return redirect()->route('board.pricing.all')->with('success', 'New Board Added Successfully');
    }

    public function update(Request $request, $id)
    {
        $board = BoardSize::find($id);
        $board->size = $request->size;
        $board->length = $request->length;
        $board->width = $request->width;
        $board->letter = $request->letter;
        $board->predicted_length = $request->predicted_length;
        $board->price = $request->price;
        $board->save();

        return redirect()->back()->with('success', 'Board Updated Successfully');
    }

    public function delete($id)
    {
        $board = BoardSize::find($id);
        $board->delete();

        return redirect()->back()->with('warning', 'Board Deleted with Pricing Successfully');
    }
}
