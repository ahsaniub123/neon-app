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
                                    <div class="col-md-3">Character Count</div>
                                    <div class="col-md-3">Board</div>
                                    <div class="col-md-3">Font Groups</div>
{{--                                    <div class="col-md-3">Pricing</div>--}}
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tbody class="font-size-sm append-tbody">

                        {{--                                <tr class="text-center no-price-rule d-none">--}}
                        {{--                                    <td colspan="6" class="text-center">no pricing rules</td>--}}
                        {{--                                </tr>--}}
                        @foreach($board_pricings as $board_pricing)
                            <tr class="text-center check-row" data-board_id="{{$board_pricing->id}}">
                                <td >
                                    <form class="d-flex align-items-center" style="margin-bottom: 0px;">
                                        @csrf
                                        <div class="align-middle col-md-3">
                                            <input type="number" @if(isset($board_pricing->characters_count)) value="{{$board_pricing->characters_count}}" @endif  name="char_count" class="form-control char-count" required>
                                        </div>
                                        <div class="align-middle col-md-3">
                                            @php $boards = \App\Models\Board::get(); @endphp
                                            <select required name="board_id" class="form-control board">
                                                <option value="{{null}}">Select Board</option>
                                                @if($boards->count())
                                                    @foreach($boards as $board)
                                                        <option @if(isset($board_pricing->board_id) && $board_pricing->board_id == $board->id) selected @endif value="{{$board->id}}">{{$board->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="align-middle col-md-3 ">
                                            @php $font_groups = \App\Models\FontGroup::get(); @endphp
                                            <select required name="font_group_id" class="form-control font">
                                                <option value="{{null}}">Select Font Group</option>
                                                @if($font_groups->count())
                                                    @foreach($font_groups as $font_group)
                                                        <option @if(isset($board_pricing->font_group_id) && $board_pricing->font_group_id == $font_group->id) selected @endif value="{{$font_group->id}}">{{$font_group->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
{{--                                        <div class="align-middle col-md-3">--}}
{{--                                            <input type="number" @if(isset($board_pricing->pricing)) value="{{$board_pricing->pricing}}" @endif step="any" name="pricing" class="form-control price" required>--}}
{{--                                        </div>--}}
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    @if($board_pricings->count())
                        <div style="float: right">
                            {{ $board_pricings->links("pagination::bootstrap-4") }}
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

            $(document).on('keyup','.char-count',function(){
                 // var char_count = $(this).val();
                 // console.log(char_count)
                 var board_id = $(this).parents('tr').data('board_id');
                 if( board_id != ''){
                     $.ajax({
                         url: '/bulk_board_pricing/'+board_id ,
                         data: $(this).parents('form').serialize(),
                         type: 'post',
                         success: function (success) {
                             console.log(success.success)
                             if(success.status == 'success'){
                                 toastr.success("Bulk board pricing edit successfully !");
                             }else{
                                 toastr.error("Bulk board pricing not saved !");
                             }
                         },
                         errors: function (errors) {
                             console.log(errors);
                         },
                     });
                 }
            });
            $(document).on('keyup','.price',function(){
                 // var char_count = $(this).val();
                 // console.log(char_count)
                 var board_id = $(this).parents('tr').data('board_id');
                 if( board_id != ''){
                     $.ajax({
                         url: '/bulk_board_pricing/'+board_id ,
                         data: $(this).parents('form').serialize(),
                         type: 'post',
                         success: function (success) {
                             console.log(success.success)
                             if(success.status == 'success'){
                                 toastr.success("Bulk board pricing edit successfully !");
                             }else{
                                 toastr.error("Bulk board pricing not saved !");
                             }
                         },
                         errors: function (errors) {
                             console.log(errors);
                         },
                     });
                 }
            });
            $(document).on('change','.board',function(){
                 // var char_count = $(this).val();
                 var board_id = $(this).parents('tr').data('board_id');
                 if( board_id != ''){
                     $.ajax({
                         url: '/bulk_board_pricing/'+board_id ,
                         data: $(this).parents('form').serialize(),
                         type: 'post',
                         success: function (success) {
                             console.log(success.success)
                             if(success.status == 'success'){
                                 toastr.success("Bulk board pricing edit successfully !");
                             }else{
                                 toastr.error("Bulk board pricing not saved !");
                             }
                         },
                         errors: function (errors) {
                             console.log(errors);
                         },
                     });
                 }
            });
            $(document).on('change','.font',function(){
                 // var char_count = $(this).val();
                 var board_id = $(this).parents('tr').data('board_id');
                 if( board_id != ''){
                     $.ajax({
                         url: '/bulk_board_pricing/'+board_id ,
                         data: $(this).parents('form').serialize(),
                         type: 'post',
                         success: function (success) {
                             console.log(success.success)
                             if(success.status == 'success'){
                                 toastr.success("Bulk board pricing edit successfully !");
                             }else{
                                 toastr.error("Bulk board pricing not saved !");
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
