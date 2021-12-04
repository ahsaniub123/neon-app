@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Board Pricing</h3>
        </div>
        <div class="col-6 text-right">
            <a class="btn btn-primary" href="{{ route('board.pricing.new') }}">Add Board</a>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-body pt-3 pl-2 pr-2 pb-2">

            <form action="{{ route('board.pricing.all') }}" method="get">
            <div class="row">
                <div class="col-5">
                    <select name="board" class="form-control">
                        <option value="all">Choose Board</option>
                        <option value="20*20" @if($boardsize == '20*20') selected @endif>20*20 cm</option>
                        <option value="30*20" @if($boardsize == '30*20') selected @endif>30*20 cm</option>
                        <option value="40*20" @if($boardsize == '40*20') selected @endif>40*20 cm</option>
                        <option value="50*30" @if($boardsize == '50*30') selected @endif>50*30 cm</option>
                        <option value="60*30" @if($boardsize == '50*30') selected @endif>50*30 cm</option>
                        <option value="60*40" @if($boardsize == '60*30') selected @endif>60*30 cm</option>
                        <option value="60*40" @if($boardsize == '60*40') selected @endif>60*40 cm</option>
                        <option value="60*60" @if($boardsize == '60*60') selected @endif>60*60 cm</option>
                    </select>
                </div>
                <div class="col-5">
                    <select name="type" class="form-control">
                        <option value="all">Choose Type</option>
                        <option value="Small Font" @if($type == 'Small Font') selected @endif>Small Font</option>
                        <option value="Big Font" @if($type == 'Big Font') selected @endif>Big Font</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-block h-100">Search</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if(count($boards) > 0)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 13%;">Board Size</th>
                        <th scope="col" style="width: 25%;">Length*Width</th>
                        <th scope="col" style="width: 15%;">Font Type</th>
                        <th scope="col" style="width: 15%;">Letters</th>
                        <th scope="col" style="width: 15%;">Predicted Length</th>
                        <th scope="col" style="width: 15%;">Price</th>
                        <th scope="col" style="width: 10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($boards as $i=>$board)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $board->size}}</td>
                            <td>{{ $board->length }}*{{ $board->width }} cm</td>
                            <td>
                                <span
                                    class="badge @if($board->font_type == 'Small Font') badge-primary @else badge-warning text-white @endif p-1">{{ $board->font_type }}</span>
                            </td>
                            <td>{{ $board->letter }}</td>
                            <td>{{ $board->predicted_length }} cm</td>
                            <td>£
                            {{ $board->price }}</td>
                            <td class="text-right">
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#board{{ $board->id }}">Edit
                                    </button>
                                    <a href="{{ route('board.pricing.delete', $board->id) }}" class="btn btn-danger">Delete</a>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade mt-4" id="board{{ $board->id }}" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Board <span
                                                class="badge @if($board->font_type == 'Small Font') badge-primary @else badge-warning text-white @endif">{{ $board->font_type }}</span>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('board.pricing.update', $board->id) }}" method="post">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Board Size</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" name="size"
                                                                   value="{{ $board->size }}" class="form-control"
                                                                   required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Length</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="length"
                                                                   value="{{ $board->length }}" class="form-control"
                                                                   required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Width</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="width" class="form-control"
                                                                   value="{{ $board->width }}" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Number of Letter</label>
                                                        <input type="number" name="letter" class="form-control"
                                                               value="{{ $board->letter }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Predicted Length</label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" name="predicted_length"
                                                                   class="form-control"
                                                                   value="{{ $board->predicted_length }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">cm</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Forecast Price</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">£</span>
                                                            </div>
                                                            <input type="number" step="0.001" name="price"
                                                                   class="form-control" value="{{ $board->price }}"
                                                                   required>
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
                <p class="text-center"><em>No Board Size Available Please Add New Board</em></p>
            @endif
        </div>
    </div>
    {{--    New Board Pricing --}}
    <div class="modal fade mt-4" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Board Pricing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('board.pricing.save') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Number of Letter</label>
                                    <input type="number" name="letter_count" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Length</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="length" class="form-control" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Width</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="width" class="form-control" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-6 border-right border-dark">
                                <div class="form-check">
                                    <input class="form-check-input" name="smallfont" type="checkbox" value="small"
                                           id="defaultCheck1">
                                    <label class="form-check-label " for="defaultCheck1">
                                        Small Font
                                    </label>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label>Forecast cost</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="small_cost" class="form-control"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Predicted Length</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="small_length" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Predicted Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="small_weight" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="bigfont" id="defaultCheck2"
                                           value="big">
                                    <label class="form-check-label " for="defaultCheck2">
                                        Big Font
                                    </label>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Forecast cost</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" name="big_cost" class="form-control"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Predicted Length</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="big_length" class="form-control"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Predicted Weight</label>
                                    <div class="input-group mb-3">
                                        <input type="number" name="big_weight" class="form-control"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kg</span>
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
@endsection
