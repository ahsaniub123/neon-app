<style>
@foreach($f_fonts as $font)
@font-face {
    font-family: '{{ $font->title }}';
    src: url('{{ asset('font_files_upload/'.$font->url)}}');
    {{--src: url('{{ $font->url }}');--}}
}
@endforeach
</style>

