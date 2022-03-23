@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Font Family</h3>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Font</button>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">Add price number</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            @if(count($fonts) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 15%;">Title</th>
                        <th scope="col" style="width: 15%;">Font Type</th>
                        <th scope="col" style="width: 20%;">Font Size</th>
{{--                        <th scope="col" style="width: 10%;">Font Price</th>--}}
                        <th scope="col" class="text-center" style="width: 35%;">Font Url</th>
                        <th scope="col" style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($fonts as $i=>$font)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td class="text-capitalize">{{ $font->title }}</td>
                            <td>
                                <span class="badge text-capitalize @if($font->type == 'Small Font') badge-primary @else badge-warning text-white @endif p-1">{{ $font->type }}</span>
                            </td>
                            <td>@if($font->size) {{ $font->size }}px @else NA @endif</td>
{{--                            <td>@if($font->price)${{ $font->price }} @else NA @endif</td>--}}
                            <td>@if($font->url) {{ $font->url }} @else NA @endif</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $font->id }}">Edit
                                    </button>
                                    <a href="{{ route('board.font.delete', $font->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $font->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Color</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('board.font.update', $font->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" class="form-control" required placeholder="Roboto" value="{{ $font->title }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Font Type</label>
                                                        <select name="type" class="form-control">
                                                            <option value="Small Font" @if($font->type == 'Small Font') selected @endif>Small Font</option>
                                                            <option value="Big Font" @if($font->type == 'Big Font') selected @endif>Big Font</option>
                                                        </select>
                                                    </div>
{{--                                                    <div class="form-group">--}}
{{--                                                        <label>Url</label>--}}
{{--                                                        <input type="url" name="url" class="form-control" value="{{ $font->url }}" placeholder="https://fonts.googleapis.com/css2?family=Roboto&display=swap">--}}
{{--                                                    </div>--}}

{{--                                                    <div class="form-control">--}}
{{--                                                        <label>Upload Font File</label>--}}
{{--                                                        <input required value="{{asset('font_files_upload/'.$font->url)}}" type="file" name="url" class="form-control" >--}}
{{--                                                    </div>--}}

                                                    <div class="row">
{{--                                                        <div class="col-6">--}}
{{--                                                            <div class="form-group">--}}
{{--                                                                <label>Price</label>--}}
{{--                                                                <input type="number" name="price" class="form-control" required placeholder="eg: $10" value="{{ $font->price }}">--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Font Size</label>
                                                                <input type="number" name="size" class="form-control" required placeholder="eg: 32px" value="{{ $font->size }}">
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
                    </tbody>
                </table>
            @else
                <p class="text-center"><em>No Board Font Family  Available Please Add New Font Family</em></p>
            @endif
        </div>
    </div>
    {{--    New Board Pricing --}}
    <div class="modal fade mt-4" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Board Color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('board.font.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Font Face">
                                </div>
                                <div class="form-group">
                                    <label>Font Type</label>
                                    <select name="type" class="form-control">
                                        <option value="Small Font">Small Font</option>
                                        <option value="Big Font">Big Font</option>
                                    </select>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>Url</label>--}}
{{--                                    <input type="url" name="url" class="form-control" placeholder="Font Url">--}}
{{--                                </div>--}}
                                <div class="form-control">
                                    <label>Upload Font File</label>
                                    <input required type="file" name="url" class="form-control" >
                                </div>
                                <div class="row">
{{--                                    <div class="col-6">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Price</label>--}}
{{--                                            <input type="number" name="price" class="form-control" required placeholder="eg: $10">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Font Size</label>
                                            <input type="number" name="size" class="form-control" required placeholder="eg: 32px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade mt-4" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Board Color</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('board.font.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Font Face">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
