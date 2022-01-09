@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Slider Pictures</h3>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add picture</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            @if(count($pictures) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 15%;">Title</th>
                        <th scope="col" class="text-center" style="width: 35%;">Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pictures as $i=>$picture)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td class="text-capitalize">{{ $picture->title }}</td>
                            <td class="text-capitalize"><img src="{{asset('assets/images/dashboard/multikart-logo.png')}}" width="40px" height="40px"></td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $picture->id }}">Edit
                                    </button>
                                    <a href="{{ route('picture.delete', $picture->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $picture->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Picture</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('picture.update', $picture->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" class="form-control" required placeholder="Roboto" value="{{ $font->title }}">
                                                    </div>
                                                    <div class="form-control">
                                                        <label>Upload Font File</label>
                                                        <input required type="file" name="url" class="form-control" >
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
                    <h5 class="modal-title" id="exampleModalLabel">New picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('picture.save') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Font Face">
                                </div>
                                <div class="form-control">
                                    <label>Upload Font File</label>
                                    <input required type="file" name="url" class="form-control" >
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
