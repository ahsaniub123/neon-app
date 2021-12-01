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
        <div class="col-6" style="padding-left: 0;">
            <h3>Edit Bulk Board Pricing</h3>
        </div>
        <div class="col-6 text-right" style="padding-right: 0;">
            {{--            <button type="button" class="btn btn-primary  mr-2">Add Row</button>--}}
            <a class="btn btn-primary" href="">Refresh</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            {{--            {{ route('board.save') }}--}}

            <div class="row">
                <table class="js-table-sections table  table-vcenter variants-table">
                    <tbody class="js-table-sections-header show table-active">

                    <tr class="text-center toggle-tr">
                        <td class="w-100">
                            <div class="row">
                                <div class="col-md-2">Character Name</div>
                                <div class="col-md-2">Character Type</div>
                                <div class="col-md-2">Font Family</div>
                                <div class="col-md-2">Board Size</div>
                                <div class="col-md-2">Length</div>
                                <div class="col-md-2">Height</div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <tbody class="font-size-sm append-tbody">
                    @php
                        $font_familys = \App\Models\FontFamily::get();
                        $board_sizes = \App\Models\Board::get();
                    @endphp
                    {{--                                <tr class="text-center no-price-rule d-none">--}}
                    {{--                                    <td colspan="6" class="text-center">no pricing rules</td>--}}
                    {{--                                </tr>--}}

                    @foreach($char_dimensions as $char_dimension)
                        {{--                        @dd($char_dimension->char_name)--}}

                        <tr class="text-center check-row" data-board_id="{{$char_dimension->id}}">
                            <td >
                                <form class="d-flex align-items-center" style="margin-bottom: 0px;">
                                    @csrf
                                    <div class="align-middle col-md-2">
                                        <input type="text" @if(isset($char_dimension->char_name)) value="{{$char_dimension->char_name}}" @endif name="char_name" class="form-control char-name" required>
                                    </div>
                                    <div class="align-middle col-md-2">
                                        <select class="form-control char-type"  name="char_type" required>
                                            <option value="{{null}}">Select Character Type</option>
                                            <option @if(isset($char_dimension->char_type) && $char_dimension->char_type == 'Lower Case') selected @endif value="Lower Case">Lower Case</option>
                                            <option @if(isset($char_dimension->char_type)  && $char_dimension->char_type == 'Upper Case') selected @endif value="Upper Case">Upper Case</option>
                                        </select>
                                    </div>
                                    <div class="align-middle col-md-2 ">

                                        <select  class="form-control font-type" name="font_type" required>
                                            <option value="{{null}}">Select Font Family</option>
                                            @if($font_familys->count())
                                                @foreach($font_familys as $font_family)
                                                    <option @if(isset($char_dimension->font_type) && $char_dimension->font_type == $font_family->id) selected @endif value="{{$font_family->id}}">{{$font_family->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="align-middle col-md-2 ">
                                        <select  class="form-control board-size" name="board_size" required>
                                            <option value="{{null}}">Select Board Size</option>
                                            @if($board_sizes->count())
                                                @foreach($board_sizes as $board_size)
                                                    <option @if(isset($char_dimension->board_size) && $char_dimension->board_size == $board_size->id) selected @endif value="{{$board_size->id}}">{{$board_size->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="align-middle col-md-2">
                                        <input type="number" step="any" @if(isset($char_dimension->length)) value="{{$char_dimension->length}}" @endif name="length" class="form-control length" required>
                                    </div>
                                    <div class="align-middle col-md-2">
                                        <input type="number" step="any" @if(isset($char_dimension->height)) value="{{$char_dimension->height}}" @endif name="height" class="form-control height" required>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                @if($char_dimensions->count())
                    <div style="float: right">
                        {{ $char_dimensions->links("pagination::bootstrap-4") }}
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection

{{--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
{{--            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
{{--            crossorigin="anonymous" ></script>--}}
@section('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // alert(1);

            $(document).on('keyup','.char-name',function(){
                // var char_count = $(this).val();
                // console.log(char_count)
                var char_dime_id = $(this).parents('tr').data('board_id');
                if( char_dime_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+char_dime_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension  edit successfully !");
                            }else{
                                toastr.error("Character diemension pricing not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });
            $(document).on('keyup','.length',function(){
                // var char_count = $(this).val();
                // console.log(char_count)
                var char_dime_id = $(this).parents('tr').data('board_id');
                if( char_dime_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+char_dime_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension  edit successfully !");
                            }else{
                                toastr.error("Character diemension pricing not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });
            $(document).on('keyup','.height',function(){
                // var char_count = $(this).val();
                // console.log(char_count)
                var char_dime_id = $(this).parents('tr').data('board_id');
                if( char_dime_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+char_dime_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension  edit successfully !");
                            }else{
                                toastr.error("Character diemension pricing not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });
            $(document).on('change','.char-type',function(){
                // var char_count = $(this).val();
                var board_id = $(this).parents('tr').data('board_id');
                if( board_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+board_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension edit successfully !");
                            }else{
                                toastr.error("Character diemension not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });
            $(document).on('change','.font-type',function(){
                // var char_count = $(this).val();
                var board_id = $(this).parents('tr').data('board_id');
                if( board_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+board_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension edit successfully !");
                            }else{
                                toastr.error("Character diemension not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });
            $(document).on('change','.board-size',function(){
                // var char_count = $(this).val();
                var board_id = $(this).parents('tr').data('board_id');
                if( board_id != ''){
                    $.ajax({
                        url: '/bulk_char_dime/'+board_id ,
                        data: $(this).parents('form').serialize(),
                        type: 'post',
                        success: function (success) {
                            console.log(success.success)
                            if(success.status == 'success'){
                                toastr.success("Character diemension edit successfully !");
                            }else{
                                toastr.error("Character diemension not saved !");
                            }
                        },
                        errors: function (errors) {
                            console.log(errors);
                        },
                    });
                }
            });

            $(document).on('click','.fa-times', function () {
                $(this).parents("tr").remove();
            });
            $(".add-row").click(function () {
                var disable_font_divs =  $(document).find('.disable-font-divs').length;
                // alert(disable_font_divs);
                // var variant_id = $(this).parent().next('.variant-ids').val();
                var this_pointer = $(this);
                $.ajax({
                    url: '/bulk_board_pricing_append/',
                    type: 'get',
                    success: function (success) {
                        // $('.no-price-rule').addClass('d-none')
                        $('.append-tbody').append(success.html);
                    },
                    errors: function (errors) {
                        console.log(errors);
                    },
                });
            });
        });
    </script>
@endsection
