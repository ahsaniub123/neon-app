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
            <h3>New Character Diemension</h3>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-primary" href="">Back</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">

            <form action="{{ route('character_diemensions.save') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Character Dimension Name</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="char_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Character Type</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="char_type" required>
                                            <option value="{{null}}">Select Character Type</option>
                                            <option value="Lower Case">Lower Case</option>
                                            <option value="Upper Case">Upper Case</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Font Type</label>
                                    <div class="input-group mb-3">
                                        <select class="form-control" name="font_type" required>
                                            <option value="{{null}}">Select Font Type</option>
                                            <option value="Small">Small</option>
                                            <option value="Big">Big</option>
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
                                        @php $board_sizes = \App\Models\Board::get(); @endphp
                                        <select  class="form-control" name="board_size" required>
                                            <option value="{{null}}">Select Font Type</option>
                                            @if($board_sizes->count())
                                                @foreach($board_sizes as $board_size)
                                                    <option value="{{$board_size->id}}">{{$board_size->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
{{--                                        <input type="number" step="any" name="board_size" class="form-control" required>--}}
{{--                                        <div class="input-group-append">--}}
{{--                                            <span class="input-group-text">cm</span>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
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
                                <div class="form-group">
                                    <label>Height</label>
                                    <div class="input-group mb-3">
                                        <input type="number" step="any" name="height" class="form-control" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 float-right">Save</button>
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
