<tr class="text-center check-row">
    <td class="align-middle">
        <input type="text" name="char_name[]" class="form-control" required>
    </td>
    <td class="align-middle">
        <select class="form-control" name="char_type[]" required>
            <option value="{{null}}">Select Character Type</option>
            <option value="Lower Case">Lower Case</option>
            <option  value="Upper Case">Upper Case</option>
        </select>
    </td>
    <td class="align-middle">
        @php $font_familys = \App\Models\FontFamily::get(); @endphp
        <select  class="form-control" name="font_type[]" required>
            <option value="{{null}}">Select Font Family</option>
            @if($font_familys->count())
                @foreach($font_familys as $font_family)
                    <option value="{{$font_family->id}}">{{$font_family->title}}</option>
                @endforeach
            @endif
        </select>
    </td>
    <td class="align-middle">
        @php $board_sizes = \App\Models\Board::get(); @endphp
        <select  class="form-control" name="board_size[]" required>
            <option value="{{null}}">Select Board Size</option>
            @if($board_sizes->count())
                @foreach($board_sizes as $board_size)
                    <option value="{{$board_size->id}}">{{$board_size->title}}</option>
                @endforeach
            @endif
        </select>
    </td>
    <td class="align-middle">
        <input type="number" step="any" name="length[]" class="form-control" required>
    </td>
    <td class="align-middle">
        <input type="number" step="any" name="height[]" class="form-control" required>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center justify-content-center ">
            <a style="font-size: 50px;font-weight: 500;cursor: pointer;" class="fa-times">-</a>
        </div>
    </td>
</tr>
