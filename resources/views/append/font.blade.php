@foreach($f_fonts as $i=>$font)
<li  @if($wall_font != null) @if($wall_font == $font->title) class="active" @endif @else @if($f_fonts[1]->title == $font->title) class="active" @endif @if($i == 0) class="" @endif @endif style="font-family:{{ $font->title }}; font-size:20px;" data-font="{{ $font->size }}">{{ $font->title }}</li>
@endforeach
