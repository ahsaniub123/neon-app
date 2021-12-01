@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Board Color</h3>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Color</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            @if(count($colors) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col" class="text-center">Color</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($colors as $i=>$color)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $color->title }}</td>
                            <td class="text-center"><span class="badge badge-primary px-5 py-2" style="background: {{ $color->color }}"><span style="opacity: 0;">color</span></span></td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $color->id }}">Edit
                                    </button>
                                    <a href="{{ route('board.color.delete', $color->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $color->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Color</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('board.color.update', $color->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" class="form-control"
                                                               value="{{ $color->title }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Color</label>
                                                        <input type="color" class="form-control p-0" name="color"
                                                               value="{{ $color->color }}">
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
                <p class="text-center"><em>No Board Color Available Please Add New Color</em></p>
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
                <form action="{{ route('board.color.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Color</label>
                                    <input type="color" name="color" class="form-control p-0">
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
