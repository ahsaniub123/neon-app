@extends('layouts.index')
@section('content')
    <style>
        input[type="checkbox"] {
            height: 20px !important;
            width: 15px !important;
            display: inline !important;
            float: left !important;
            margin-top: 3px !important;
            /* outline: 0 !important; */
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            opacity: 1 !important;
        }
    </style>
    <div class="row">
        <div class="col-6">
            <h3>Boards</h3>
        </div>
        <div class="col-6 text-right">
{{--            <a  class="btn btn-primary" href="{{route('board.new')}}">Add Bulk Boards</a>--}}
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#board">Add Board</button>
            <div class="modal fade mt-4" id="board" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Board</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('board.save') }}" method="post">
                            @csrf
                            <div class="modal-body" style="text-align: left;">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Board Title</label>
                                            <div class="input-group mb-3">
                                                <input type="text"  name="title" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Min Length</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  step="any" name="min_length" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Min Height</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  step="any" name="min_height" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Max Length</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  step="any" name="max_length" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Max Height</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  step="any" name="max_height" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label style="font-weight: bold;">Select Fonts to Disable</label>
                                <div class="row">
                                    @php $fonts = \App\Models\FontFamily::get(); @endphp
                                    @if($fonts->count())
                                        @foreach($fonts as $font)
                                            <div class="col-md-3">
                                                <label class="pl-2" for="{{$font->id}}">{{$font->title}}</label>
                                                <input type="checkbox" name="disable_fonts[]" id="{{$font->id}}"
                                                    value="{{$font->id}}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="card mt-2">--}}
{{--        <div class="card-body pt-3 pl-2 pr-2 pb-2">--}}

{{--            <form action="{{ route('board.pricing.all') }}" method="get">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-5">--}}
{{--                        <select name="board" class="form-control">--}}
{{--                            <option value="all">Choose Board</option>--}}
{{--                            --}}{{--                            <option value="20*20" @if($boardsize == '20*20') selected @endif>20*20 cm</option>--}}
{{--                            --}}{{--                            <option value="30*20" @if($boardsize == '30*20') selected @endif>30*20 cm</option>--}}
{{--                            --}}{{--                            <option value="40*20" @if($boardsize == '40*20') selected @endif>40*20 cm</option>--}}
{{--                            --}}{{--                            <option value="50*30" @if($boardsize == '50*30') selected @endif>50*30 cm</option>--}}
{{--                            --}}{{--                            <option value="60*30" @if($boardsize == '50*30') selected @endif>50*30 cm</option>--}}
{{--                            --}}{{--                            <option value="60*40" @if($boardsize == '60*30') selected @endif>60*30 cm</option>--}}
{{--                            --}}{{--                            <option value="60*40" @if($boardsize == '60*40') selected @endif>60*40 cm</option>--}}
{{--                            --}}{{--                            <option value="60*60" @if($boardsize == '60*60') selected @endif>60*60 cm</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-5">--}}
{{--                        <select name="type" class="form-control">--}}
{{--                            <option value="all">Choose Type</option>--}}
{{--                            --}}{{--                            <option value="Small Font" @if($type == 'Small Font') selected @endif>Small Font</option>--}}
{{--                            --}}{{--                            <option value="Big Font" @if($type == 'Big Font') selected @endif>Big Font</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-2">--}}
{{--                        <button type="submit" class="btn btn-primary btn-block h-100">Search</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row mt-2">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col" style="width: 13%;">Board Title</th>
                    <th scope="col" style="width: 25%;">Min Length</th>
                    <th scope="col" style="width: 15%;">Max Length</th>
                    <th scope="col" style="width: 15%;">Min Height</th>
                    <th scope="col" style="width: 15%;">Max Height</th>
                    <th scope="col" style="width: 15%;">Disable Fonts</th>
                    <th scope="col" style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($boards->count())
                    @foreach($boards as $i=>$board)
                        <tr>
                            <td>{{ $board->title}}</td>
                            <td>{{ $board->length_min }} cm</td>
                            <td>{{ $board->length_max }} cm</td>
                            <td>{{ $board->min_height }} cm</td>
                            <td>{{ $board->max_height }} cm</td>
                            <td>
                                @if($board->fonts()->count())
                                    @foreach($board->fonts as $font)
                                        <span style="padding: 4px 5px; margin-bottom: 3px;" class="badge badge-primary">{{$font->title}}</span>
                                    @endforeach
                                @else
                                    --
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $board->id }}">Edit
                                    </button>
                                    <a href="{{ route('board.delete', $board->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $board->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Board</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('board.update', $board->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Board Title</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" value="{{$board->title}}" name="title" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Min Length</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board->length_min}}" step="any" name="min_length" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Min Height</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board->min_height}}" step="any" name="min_height" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Max Length</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board->length_max}}" step="any" name="max_length" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Max Height</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board->max_height}}" step="any" name="max_height" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <label style="font-weight: bold;">Select Fonts to Disable</label>
                                            <div class="row">
                                                @php $fonts = \App\Models\FontFamily::get(); @endphp
                                                @if($fonts->count())
                                                    @foreach($fonts as $font)
                                                        <div class="col-md-3">
                                                            <label class="pl-2" for="{{$font->id}}">{{$font->title}}</label>
                                                            <input
                                                                @if($board->fonts()->count())
                                                                    @foreach($board->fonts as $disable_font)
                                                                        @if($disable_font->id == $font->id)
                                                                            checked
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                                type="checkbox" name="disable_fonts[]" id="{{$font->id}}"
                                                                   value="{{$font->id}}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center"><em>No Boards Available Please Add New Board</em></td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>

@endsection
