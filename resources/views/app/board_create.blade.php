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
            <h3>New Bulk Board</h3>
        </div>
        <div class="col-6 text-right" style="padding-right: 0;">
            {{--            <button type="button" class="btn btn-primary  mr-2">Add Row</button>--}}
            <a class="btn btn-primary" href="">Back</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            {{--            {{ route('board.save') }}--}}
            <form id="board-price-form" action="{{ route('bulk-board.save')}}" method="post">
                @csrf
                <div class="row">
                    <table class="js-table-sections table  table-vcenter variants-table">
                        <tbody class="js-table-sections-header show table-active">

                        <tr class="text-center toggle-tr">
                            <td colspan="1">
                                Board Title
                            </td>
                            <td class="font-w600 font-size-sm">
                                Min Length
                            </td>
                            <td class="font-w600 font-size-sm">
                                Min Height
                            </td>
                            <td class="font-w600 font-size-sm">
                                Max Length
                            </td>
                            <td class="font-w600 font-size-sm">
                                Max Height
                            </td>
                            <td class="font-w600 font-size-sm">
                                Fonts to Disable
                            </td>

                            <td class="font-w600 font-size-sm">
                                <div class="py-1">
                                    <a href="javascipt:void(0)">Actions</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                        <tbody class="font-size-sm append-tbody">

                        {{--                                <tr class="text-center no-price-rule d-none">--}}
                        {{--                                    <td colspan="6" class="text-center">no pricing rules</td>--}}
                        {{--                                </tr>--}}

                        <tr class="text-center check-row">
                            <td class="align-middle">
                                <input type="text" name="title[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                <input type="number" step="any" name="min_length[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                <input type="number" step="any" name="min_height[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                <input type="number" step="any" name="max_length[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                <input type="number" step="any" name="max_height[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                <div class="row disable-font-divs">
                                    @php $fonts = \App\Models\FontFamily::get(); @endphp
                                    @if($fonts->count())
                                        @foreach($fonts as $font)
                                            <div class="col-md-2" style="padding: 0px !important;">
                                                <label class="" style="    margin-left: -6px;"
                                                       for="{{$font->id}}">{{$font->title}}</label>
                                                <input type="checkbox" name="disable_fonts_0[]" id="{{$font->id}}"
                                                       value="{{$font->id}}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center justify-content-center ">
                                    <a style="font-size: 44px;font-weight: 400;cursor: pointer;" class="add-row">+</a>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5 float-right ">Save</button>
            </form>
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
            $(document).on('click','.fa-times', function () {
                $(this).parents("tr").remove();
                var disable_font_divs =  $(document).find('.disable-font-divs').length;
                // alert(disable_font_divs)
                // for (var i = 0; i < disable_font_divs; i++) {
                //     $(document).find(".disable-font-divs["+i+"]").find('input').attr('name', 'disable_fonts_'+i+'[]');
                //     console.log(i)
                // }
                $(document).find(".disable-font-divs").each(function (i,j) {
                    console.log(i,j);
                    $(this).find('input').attr('name', 'disable_fonts_'+i+'[]');
                });

            });
            $(".add-row").click(function () {
               var disable_font_divs =  $(document).find('.disable-font-divs').length;
               // alert(disable_font_divs);
                // var variant_id = $(this).parent().next('.variant-ids').val();
                var this_pointer = $(this);
                $.ajax({
                    url: '/bulk_board_append/'+disable_font_divs,
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
