@extends('layouts.index')
@section('content')
    <div class="row">
        <div class="col-6">
            <h3>Add Prices for Options</h3>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">

            <form action="{{ route('options.save') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 float-left">
                                <h4>Door Section</h4>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Indoor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="indoor"  value="@if(isset($option_price->indoor)){{$option_price->indoor}}@endif" placeholder="Enter Indoor price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Outdoor</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="outdoor" value="@if(isset($option_price->outdoor)){{$option_price->outdoor}}@endif" placeholder="Enter Outdoor price"  class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 float-left">
                                <h4>Special <Offers></Offers></h4>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Remote & Dimmer</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="remote_dimmer" value="@if(isset($option_price->remote_dimmer)){{$option_price->remote_dimmer}}@endif" placeholder="Enter Remote & Dimmer price"  class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Wall Mounting</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="wall_mounting"  value="@if(isset($option_price->wall_mounting)){{$option_price->wall_mounting}}@endif" placeholder="Enter Wall Mounting price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sign Hanging</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="sign_hang" value="@if(isset($option_price->sign_hang)){{$option_price->sign_hang}}@endif" placeholder="Enter Sign Hanging price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 float-left">
                                <h4>Back Board Section</h4>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Cut Around Acrylic</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="cut_around_acrylic" value="@if(isset($option_price->cut_around_acrylic)){{$option_price->cut_around_acrylic}}@endif" placeholder="Enter Cut Around Acrylic price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Rectangle Acrylic</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="rectangle_acrylic"  value="@if(isset($option_price->rectangle_acrylic)){{$option_price->rectangle_acrylic}}@endif" placeholder="Enter Rectangle Acrylic price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Cut To Letter</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="cut_letter" value="@if(isset($option_price->cut_letter)){{$option_price->cut_letter}}@endif" placeholder="Enter Cut To Letter price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Acrylic Stand</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="acrylic_stand" value="@if(isset($option_price->acrylic_stand)){{$option_price->acrylic_stand}}@endif" placeholder="Enter Acrylic Stand price"  class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Open Box</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number"  step="0.001" name="open_box" value="@if(isset($option_price->open_box)){{$option_price->open_box}}@endif" placeholder="Enter Open Box price" class="form-control" >
                                    </div>
                                </div>
                            </div>
                        </div>

                        </div>
                    </div>
{{--                </div>--}}
                <button type="submit" class="btn btn-primary mt-3 mb-5 float-right">Save</button>
            </form>
        </div>
    </div>
{{--    </div>--}}
{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            var data = $('.copy_new_letter').html();--}}
{{--            $('.add_letter').on('click', function (){--}}
{{--                $('.append_letter').append(data);--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection

