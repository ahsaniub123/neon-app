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
            <h3>Board Pricings</h3>
        </div>
        <div class="col-8 text-right">
            <a  class="btn btn-primary" href="{{route('bulk_board_pricing.edit')}}">Edit Bulk Board Pricing</a>
            <a  class="btn btn-primary" href="{{route('bulk_board_pricing.new')}}">Add Bulk Board Pricing</a>
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#board">Add Board Pricing</button>
            <div class="modal fade mt-4" id="board" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Board Pricing</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('board_pricing.save') }}" method="post">
                            @csrf
                            <div class="modal-body" style="text-align: left;">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Character Count</label>
                                            <div class="input-group mb-3">
                                                <input type="number"  name="char_count" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Pricing</label>--}}
{{--                                            <div class="input-group mb-3">--}}
{{--                                                <input type="number"  step="any" name="pricing" class="form-control" required>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <label style="font-weight: bold;">Select Board</label>
                                        @php $boards = \App\Models\Board::get(); @endphp
                                        <select required name="board_id" class="form-control">
                                            <option value="{{null}}">Select Board</option>
                                            @if($boards->count())
                                                @foreach($boards as $board)
                                                    <option  value="{{$board->id}}">{{$board->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label style="font-weight: bold;">Select Font Groups</label>
                                        @php $font_groups = \App\Models\FontGroup::get(); @endphp
                                        <select required name="font_group_id" class="form-control">
                                            <option value="{{null}}">Select Font Group</option>
                                            @if($font_groups->count())
                                                @foreach($font_groups as $font_group)
                                                    <option  value="{{$font_group->id}}">{{$font_group->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
                    <th scope="col" style="width: 13%;">Character Counts</th>
                    <th scope="col" style="width: 13%;">Board</th>
                    <th scope="col" style="width: 13%;">Font Group</th>
{{--                    <th scope="col" style="width: 13%;">Pricing</th>--}}
                    <th scope="col" style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($board_pricings->count())
                    @foreach($board_pricings as $i=>$board_pricing)
                        <tr>
                            <td>{{ $board_pricing->characters_count}}</td>
                            @php
                                $font_group = null;
                                if(isset($board_pricing->font_group_id)){
                                    $font_group = \App\Models\FontGroup::where('id',$board_pricing->font_group_id)->first();
                                }
                                $board = null;
                                if(isset($board_pricing->board_id)){
                                    $board = \App\Models\Board::where('id',$board_pricing->board_id)->first();
                                }

                            @endphp
                            <td>{{isset($board->title)?$board->title:'--'}}</td>

                            <td>{{ isset($font_group->title)?$font_group->title:'--'}}</td>
{{--                            <td>{{ $board_pricing->pricing }}</td>--}}

                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $board_pricing->id }}">Edit
                                    </button>
                                    <a href="{{ route('board_pricing.delete', $board_pricing->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $board_pricing->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Board Pricing</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('board_pricing.update', $board_pricing->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Character Count</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board_pricing->characters_count}}" name="char_count" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Pricing</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="{{$board_pricing->pricing}}" step="any" name="pricing" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <label style="font-weight: bold;">Select Board</label>
                                                    @php $boards = \App\Models\Board::get(); @endphp
                                                    <select required name="board_id" class="form-control">
                                                        <option value="{{null}}">Select Board</option>
                                                        @if($boards->count())
                                                            @foreach($boards as $board)
                                                                <option @if(isset($board_pricing->board_id) && $board_pricing->board_id == $board->id) selected @endif value="{{$board->id}}">{{$board->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label style="font-weight: bold;">Select Font Groups</label>
                                                    @php $font_groups = \App\Models\FontGroup::get(); @endphp
                                                    <select required name="font_group_id" class="form-control">
                                                        <option value="{{null}}">Select Font Group</option>
                                                        @if($font_groups->count())
                                                            @foreach($font_groups as $font_group)
                                                                <option @if(isset($board_pricing->font_group_id) && $board_pricing->font_group_id == $font_group->id) selected @endif value="{{$font_group->id}}">{{$font_group->title}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
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
                        <td colspan="7" class="text-center"><em>No Boards Available.</em></td>
                    </tr>
                @endif
                </tbody>
            </table>
            @if($board_pricings->count())
                <div class="mt-3 text-right float-right">
{{--                    {{ $board_pricings->links() }}--}}
                    <div class="pagination">
                        {{ $board_pricings->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
