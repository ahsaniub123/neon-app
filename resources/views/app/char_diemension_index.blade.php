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
        <div class="col-4">
            <h3>Character Diemension</h3>
        </div>
        <div class="col-8 text-right">
            <a  class="btn btn-primary" href="{{route('bulk_char_dime.edit')}}">Edit Bulk Character Diemension</a>
            <a  class="btn btn-primary" href="{{route('bulk_char_dime.new')}}">Add Bulk Character Diemension</a>
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#board">Add Character Diemension</button>
            <div class="modal fade mt-4" id="board" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" >Create Character Diemension</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('character_diemensions.save') }}" method="post">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Character Name</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="char_name" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Character Type</label>
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="char_type" required>
                                                    <option value="{{null}}">Select Character Type</option>
                                                    <option value="Lower Case">Lower Case</option>
                                                    <option  value="Upper Case">Upper Case</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Font Family</label>
                                            <div class="input-group mb-3">
                                                @php $font_familys = \App\Models\FontFamily::get(); @endphp
                                                <select  class="form-control" name="font_type" required>
                                                    <option value="{{null}}">Select Font Family</option>
                                                    @if($font_familys->count())
                                                        @foreach($font_familys as $font_family)
                                                            <option value="{{$font_family->id}}">{{$font_family->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
{{--                                                <select class="form-control" name="" required>--}}
{{--                                                    <option value="{{null}}">Select Font Type</option>--}}
{{--                                                    <option value="Small">Small</option>--}}
{{--                                                    <option  value="Big">Big</option>--}}
{{--                                                </select>--}}
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Board Size</label>
                                            <div class="input-group mb-3">
                                                {{--                                                            <input type="number" step="any" value="{{$char_diemension->board_size}}" name="board_size" class="form-control" required>--}}
                                                {{--                                                            <div class="input-group-append">--}}
                                                {{--                                                                <span class="input-group-text">cm</span>--}}
                                                {{--                                                            </div>--}}
                                                @php $board_sizes = \App\Models\Board::get(); @endphp
                                                <select  class="form-control" name="board_size" required>
                                                    <option value="{{null}}">Select Board Size</option>
                                                    @if($board_sizes->count())
                                                        @foreach($board_sizes as $board_size)
                                                            <option value="{{$board_size->id}}">{{$board_size->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Length</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="any" name="length" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group text-left">
                                            <label>Height</label>
                                            <div class="input-group mb-3">
                                                <input type="number" step="any"  name="height" class="form-control" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                    <th scope="col" style="width: 13%;">Character Name</th>
                    <th scope="col" style="width: 25%;">Character Type</th>
                    <th scope="col" style="width: 15%;">Font Family</th>
                    <th scope="col" style="width: 15%;">Board Size</th>
                    <th scope="col" style="width: 15%;">Length</th>
                    <th scope="col" style="width: 15%;">Height</th>
                    <th scope="col" style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($char_diemensions->count())
                    @foreach($char_diemensions as $i=>$char_diemension)
                        <tr>
                            <td>{{ $char_diemension->char_name}}</td>
                            <td>{{ $char_diemension->char_type }}</td>

                            @php
                                $font_family = null;
                                if(isset($char_diemension->font_type)){
                                    $font_family = \App\Models\FontFamily::find($char_diemension->font_type);
                                    if($font_family != null){
                                        $font_family = $font_family->title;
                                    }
                                }
                            @endphp
                            <td>{{isset($font_family)?$font_family:'--'}}</td>
                            @php
                                $board_size = null;
                                if(isset($char_diemension->board_size)){
                                    $board_size = \App\Models\Board::find($char_diemension->board_size);
                                    $board_size = $board_size->title;
                                }
                            @endphp
                            <td>{{isset($board_size)?$board_size:'--'}} </td>
                            <td>{{ $char_diemension->length }} cm</td>
                            <td>{{ $char_diemension->height }} cm</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $char_diemension->id }}">Edit
                                    </button>
                                    <a href="{{ route('character_diemensions.delete', $char_diemension->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $char_diemension->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Character Diemension</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('character_diemensions.update', $char_diemension->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Character Dimension Name</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" value="{{$char_diemension->char_name}}" name="char_name" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Character Type</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" name="char_type" required>
                                                                <option value="{{null}}">Select Character Type</option>
                                                                <option @if($char_diemension->char_type == 'Lower Case') selected @endif value="Lower Case">Lower Case</option>
                                                                <option @if($char_diemension->char_type == 'Upper Case') selected @endif value="Upper Case">Upper Case</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Font Font Family</label>
                                                        <div class="input-group mb-3">
{{--                                                            <select class="form-control" name="font_type" required>--}}
{{--                                                                <option value="{{null}}">Select Font Type</option>--}}
{{--                                                                <option @if($char_diemension->font_type == 'Small') selected @endif value="Small">Small</option>--}}
{{--                                                                <option @if($char_diemension->font_type == 'Big') selected @endif value="Big">Big</option>--}}
{{--                                                            </select>--}}
                                                            @php $font_familys = \App\Models\FontFamily::get(); @endphp
                                                            <select  class="form-control" name="font_type" required>
                                                                <option value="{{null}}">Select Font Family</option>
                                                                @if($font_familys->count())
                                                                    @foreach($font_familys as $font_family)
                                                                        <option @if(isset($char_diemension->font_type) && $char_diemension->font_type == $font_family->id) selected @endif value="{{$font_family->id}}">{{$font_family->title}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Board Size</label>
                                                        <div class="input-group mb-3">
{{--                                                            <input type="number" step="any" value="{{$char_diemension->board_size}}" name="board_size" class="form-control" required>--}}
{{--                                                            <div class="input-group-append">--}}
{{--                                                                <span class="input-group-text">cm</span>--}}
{{--                                                            </div>--}}
                                                            @php $board_sizes = \App\Models\Board::get(); @endphp
                                                            <select  class="form-control" name="board_size" required>
                                                                <option value="{{null}}">Select Board Size</option>
                                                                @if($board_sizes->count())
                                                                    @foreach($board_sizes as $board_size)
                                                                        <option @if(isset($char_diemension->board_size) && $char_diemension->board_size == $board_size->id) selected @endif value="{{$board_size->id}}">{{$board_size->title}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Length</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" step="any" value="{{$char_diemension->length}}" name="length" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <label>Height</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" step="any" value="{{$char_diemension->height}}" name="height" class="form-control" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <td colspan="7" class="text-center"><em>No Character Diemensions Available.</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($char_diemensions->count())
                <div class="mt-3 text-right float-right">
{{--                    {{ $char_diemensions->links() }}--}}
                    <div class="pagination">
                        {{ $char_diemensions->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
