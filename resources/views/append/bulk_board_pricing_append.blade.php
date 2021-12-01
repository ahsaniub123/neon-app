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
    <td class="align-middle">
        <input type="number"  step="any" name="pricing[]" class="form-control" required>
    </td>

    <td class="align-middle">
        <div class="d-flex align-items-center justify-content-center ">
            <a style="font-size: 50px;font-weight: 500;cursor: pointer;" class="fa-times">-</a>
        </div>
    </td>
</tr>
