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

            <form action="{{ route('font_group.save') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Font Group Title</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="title" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Title</label>
                                    <div class="input-group mb-3">
                                        <input type="text" step="any" name="title" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <label style="font-weight: bold;">Select Fonts</label>
                        <div class="row">
                            @php $fonts = \App\Models\FontFamily::get(); @endphp
                            @if($fonts->count())
                                @foreach($fonts as $font)
                                    <div class="col-md-2">
                                        <label class="pl-2" for="{{$font->id}}">{{$font->title}}</label>
                                        <input type="checkbox" name="fonts[]" id="{{$font->id}}"
                                               value="{{$font->id}}">
                                    </div>
                                @endforeach
                            @endif
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
