@foreach($f_colors as $i=>$f_color)
<span   class="color-selector  @if($wall_color != null) @if($wall_color == $f_color->title) active @endif @else @if(($f_colors[0]->title == $f_color->title)) active @endif  @if($i==0) @endif @endif" style="background-color:{{ $f_color->color }};" data-title="{{ $f_color->title }}" data-color="{{ $f_color->color }}" data-backgorund="{{ $f_color->color }}"><span>{{ $f_color->title }}</span></span>
@endforeach
