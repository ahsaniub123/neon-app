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
            <h3>New Bulk Board Pricing</h3>
        </div>
        <div class="col-6 text-right" style="padding-right: 0;">
            {{--            <button type="button" class="btn btn-primary  mr-2">Add Row</button>--}}
            <a class="btn btn-primary" href="">Refresh</a>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            {{--            {{ route('board.save') }}--}}
            <form id="board-price-form" action="{{ route('bulk-board-pricing.save')}}" method="post">
                @csrf
                <div class="row">
                    <table class="js-table-sections table  table-vcenter variants-table">
                        <tbody class="js-table-sections-header show table-active">

                        <tr class="text-center toggle-tr">
                            <td colspan="1">
                                Character Count
                            </td>
                            <td class="font-w600 font-size-sm">
                                 Board
                            </td>
                            <td class="font-w600 font-size-sm">
                                Font Groups
                            </td>
{{--                            <td class="font-w600 font-size-sm">--}}
{{--                                Pricing--}}
{{--                            </td>--}}

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
                                <input type="number"  name="char_count[]" class="form-control" required>
                            </td>
                            <td class="align-middle">
                                @php $boards = \App\Models\Board::get(); @endphp
                                <select required name="board_id[]" class="form-control">
                                    <option value="{{null}}">Select Board</option>
                                    @if($boards->count())
                                        @foreach($boards as $board)
                                            <option  value="{{$board->id}}">{{$board->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                            <td class="align-middle">
                                @php $font_groups = \App\Models\FontGroup::get(); @endphp
                                <select required name="font_group_id[]" class="form-control">
                                    <option value="{{null}}">Select Font Group</option>
                                    @if($font_groups->count())
                                        @foreach($font_groups as $font_group)
                                            <option  value="{{$font_group->id}}">{{$font_group->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
{{--                            <td class="align-middle">--}}
{{--                                <input type="number"  step="any" name="pricing[]" class="form-control" required>--}}
{{--                            </td>--}}

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
