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
            <h3>New Board</h3>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-primary" href="">Back</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">

            <form action="{{ route('board_pricing.save') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Character Count</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="char_count" class="form-control" required>
                                    </div>
                                </div>
                            </div>
{{--                            <div class="col-6">--}}
{{--                                <div class="form-group">--}}
{{--                                    <label>Pricing</label>--}}
{{--                                    <div class="input-group mb-3">--}}
{{--                                        <input type="number" step="any" name="pricing" class="form-control" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label style="font-weight: bold;">Select Board</label>
                                @php $boards = \App\Models\Board::get(); @endphp
                                <select required name="board_id" class="form-control">
                                    <option value="{{null}}">Select Board</option>
                                    @if($boards->count())
                                        @foreach($boards as $board)
                                            <option value="{{$board->id}}">{{$board->title}}</option>
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
                                            <option value="{{$font_group->id}}">{{$font_group->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-3 mb-5 float-right">Save</button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection
