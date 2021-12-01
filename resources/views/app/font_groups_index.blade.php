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
            <h3>Font Groups</h3>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" data-toggle="modal"
                    data-target="#font_group_create">Add Font Group
            </button>
        </div>
        <div class="modal fade mt-4" id="font_group_create" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-ms" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Font Group</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('font_group.save') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Font Group Title</label>
                                        <div class="input-group mb-3">
                                            <input type="text" value="" name="title" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label style="font-weight: bold;">Select Fonts</label>
                            <div class="row">
                                @php $fonts = \App\Models\FontFamily::orderBy('title')->get(); @endphp
                                @if($fonts->count())
                                    @foreach($fonts as $font)
                                        <div class="col-md-4">
                                            <label class="pl-2" for="{{$font->id}}">{{$font->title}}</label>
                                            <input type="checkbox" name="fonts[]" id="{{$font->id}}"
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
    {{--    <div class="card mt-2">--}}
    {{--        <div class="card-body pt-3 pl-2 pr-2 pb-2">--}}

    {{--            <form action="{{ route('font_group.pricing.all') }}" method="get">--}}
    {{--                <div class="row">--}}
    {{--                    <div class="col-5">--}}
    {{--                        <select name="font_group" class="form-control">--}}
    {{--                            <option value="all">Choose Board</option>--}}
    {{--                            --}}{{--                            <option value="20*20" @if($font_groupize == '20*20') selected @endif>20*20 cm</option>--}}
    {{--                            --}}{{--                            <option value="30*20" @if($font_groupize == '30*20') selected @endif>30*20 cm</option>--}}
    {{--                            --}}{{--                            <option value="40*20" @if($font_groupize == '40*20') selected @endif>40*20 cm</option>--}}
    {{--                            --}}{{--                            <option value="50*30" @if($font_groupize == '50*30') selected @endif>50*30 cm</option>--}}
    {{--                            --}}{{--                            <option value="60*30" @if($font_groupize == '50*30') selected @endif>50*30 cm</option>--}}
    {{--                            --}}{{--                            <option value="60*40" @if($font_groupize == '60*30') selected @endif>60*30 cm</option>--}}
    {{--                            --}}{{--                            <option value="60*40" @if($font_groupize == '60*40') selected @endif>60*40 cm</option>--}}
    {{--                            --}}{{--                            <option value="60*60" @if($font_groupize == '60*60') selected @endif>60*60 cm</option>--}}
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
                    <th scope="col" style="width: 13%;">Font Group Title</th>
                    <th scope="col" style="width: 13%;">Fonts</th>
                    <th scope="col" style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($font_groups->count())
                    @foreach($font_groups as $i=>$font_group)
                        <tr>
                            <td>{{ $font_group->title}}</td>
                            <td>
                                @if($font_group->fonts()->count())
                                    @foreach($font_group->fonts as $font)
                                        <span style="padding: 4px 5px; margin-bottom: 3px;"
                                              class="badge badge-primary">{{$font->title}}</span>
                                    @endforeach
                                @else
                                    --
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#font_group{{ $font_group->id }}">Edit
                                    </button>
                                    <a href="{{ route('font_group.delete', $font_group->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="font_group{{ $font_group->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Font Group</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('font_group.update', $font_group->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Font Group Title</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" value="{{$font_group->title}}"
                                                                   name="title" class="form-control" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <label style="font-weight: bold;">Select Fonts</label>
                                            <div class="row">
                                                @php $fonts = \App\Models\FontFamily::orderBy('title')->get(); @endphp
                                                @if($fonts->count())
                                                    @foreach($fonts as $font)
                                                        <div class="col-md-4">
                                                            <label class="pl-2"
                                                                   for="{{$font->id}}">{{$font->title}}</label>
                                                            <input
                                                                @if($font_group->fonts()->count())
                                                                @foreach($font_group->fonts as $font_group_font)
                                                                @if($font_group_font->id == $font->id)
                                                                checked
                                                                @endif
                                                                @endforeach
                                                                @endif
                                                                type="checkbox" name="fonts[]" id="{{$font->id}}"
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
                        <td colspan="7" class="text-center"><em>No Font Group Available.</em></td>
                    </tr>
                @endif
                </tbody>
            </table>

        </div>
    </div>

@endsection
