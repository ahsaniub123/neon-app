@extends('layouts.index')
@section('content')
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

            <form action="{{ route('board.pricing.save') }}" method="post">
                @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label>Board Label</label>
                            <div class="input-group mb-3">
{{--                                <select class="form-select col-md-6" name="size" required>--}}
{{--                                    <option selected value="small">Small</option>--}}
{{--                                    <option  value="medium">Medium</option>--}}
{{--                                    <option  value="large">Large</option>--}}
{{--                                    <option  value="xlarge">X Large</option>--}}
{{--                                    <option  value="xxlarge">XX Large</option>--}}
{{--                                    <option  value="supersized">Supersized</option>--}}
{{--                                </select>--}}
                                <input type="text" name="size" class="form-control" required>
                            </div>
                        </div>
                    </div>
                        <div class="col-4">
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
                    <div class="col-4">
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
                        <div class="col-12">
                            <div class="form-group">
                                <label>Font Type</label>
                                <select name="font_type" class="form-control">
                                    <option value="Small Font">Small Font</option>
                                    <option value="Big Font">Big Font</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary add_letter float-right">Add Letter</button>
                        </div>
                    </div>
                    <div class="row copy_new_letter">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Number of Letter</label>
                                <input type="number" name="letter_count[]" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Predicted Length</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="predicted_length[]" class="form-control" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Forecast Price</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" name="price[]" step="0.001" class="form-control" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row append_letter">

                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 float-right">Save</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function (){
            var data = $('.copy_new_letter').html();
            $('.add_letter').on('click', function (){
                $('.append_letter').append(data);
            });
        });
    </script>
@endsection
