<tr class="text-center check-row">
    <td class="align-middle" >
        <input type="text"  name="title[]" class="form-control" required>
    </td>
    <td class="align-middle"  >
        <input type="number" step="any" name="min_length[]" class="form-control" required>
    </td>
    <td class="align-middle" >
        <input type="number" step="any" name="min_height[]" class="form-control" required>
    </td>
    <td class="align-middle" >
        <input type="number" step="any" name="max_length[]" class="form-control" required>
    </td>
    <td class="align-middle" >
        <input type="number" step="any" name="max_height[]" class="form-control" required>
    </td>
    <td class="align-middle" >
        <div class="row disable-font-divs">
            @php $fonts = \App\Models\FontFamily::get(); @endphp
            @if($fonts->count())
                @foreach($fonts as $font)
                    <div class="col-md-2" style="padding: 0px !important;">
                        <label class="" style="    margin-left: -6px;" for="{{$font->id}}">{{$font->title}}</label>
                        <input type="checkbox" name="disable_fonts_{{$disable_font_divs_count}}[]" id="{{$font->id}}"
                               value="{{$font->id}}">
                    </div>
                @endforeach
            @endif
        </div>
    </td>
    <td class="align-middle">
        <div class="d-flex align-items-center justify-content-center ">
            <a style="font-size: 50px;font-weight: 500;cursor: pointer;" class="fa-times">-</a>
        </div>
    </td>
</tr>
