<p class='add_txt'>Select Your Options</p>
@foreach($boards as $i=>$board)
    @php
        $length_count = 0;

        $total_max_char_height_count = 0;
        $total_max_char_length_count = 0;
        $pricing = 0;

       $char_break_lines_array = [];
       $char_count_array = [];

        $text_length_array = explode("\r\n", $text);
        foreach ($text_length_array as $char_count){
            if(strlen($char_count)){
                array_push($char_break_lines_array,$char_count);
                array_push($char_count_array,strlen($char_count));
           }
        }
        $char_count_sum = array_sum($char_count_array);
        foreach ($char_break_lines_array as $char_break_lines){
            $text_character_array = str_split($char_break_lines);
            if($text_character_array != null && count($text_character_array)){
                $max_char_height_count = 0;
                $length_count = 0;
                foreach ($text_character_array as $text_character){
                    if($text_character != ' '){
                        $font_type = null;
                        $font_family = \App\Models\FontFamily::find($font->id);
                        if(isset($font_family)){
                            if($font_family->type == 'Small Font'){
                                $font_type = 'Small';
                            }elseif($font_family->type == 'Big Font'){
                                $font_type = 'Big';
                            }
                        }
                        if(isset($font_type)){
                            if($font_family->font_groups()->count()){
                                foreach ($font_family->font_groups as $font_group){
                                    $board_pricing = \App\Models\BoardPricing::where('characters_count',$char_count_sum)->where('font_group_id',$font_group->id)->where('board_id',$board->id)->first();
                                    if($board_pricing != null){
                                        $pricing = $board_pricing->pricing;
                                    }
                                }
                            }

                            $character_diemensions = \App\Models\CharacterDiemension::where('char_name',$text_character)->where('board_size',$board->id)->where('font_type',$font_family->id)->first();
                            if(isset($character_diemensions)){
                                $length_count = $length_count + floatval($character_diemensions->length);
                                if($character_diemensions->height >= $max_char_height_count){
                                    $max_char_height_count = $character_diemensions->height;
                                }
                            }
                        }
                    }
                }

                if($length_count > $total_max_char_length_count){
                    $total_max_char_length_count = $length_count;
                }

                $total_max_char_height_count = $max_char_height_count + $total_max_char_height_count;
            }
        }

        $font_disable = null;
            if($board->fonts()->count() && isset($font)){
               foreach ($board->fonts as $disable_font){
                   if($disable_font->id == $font->id){
                       $font_disable = true;
                   }
               }
            }
            if ($i == 0){
                $for_multiply = 1;
            }
            if ($i == 1){
                $for_multiply =  1.39;
            }
            if ($i == 2){
                $for_multiply =  1.67;
            }
            if ($i == 3){
                $for_multiply =  2.1;
            }
            if ($i == 4){
                $for_multiply = 2.67;
            }
            if ($i == 5){
                $for_multiply =  4.44;
            }
            $board_price = 0;
            if($board->title == 'Small'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 102){
                   $board_price = 102;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            if($board->title == 'Medium'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 136){
                   $board_price = 136;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            if($board->title == 'Large'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 180){
                   $board_price = 180;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            if($board->title == 'X Large'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 223){
                   $board_price = 223;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            if($board->title == 'XX Large'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 256){
                   $board_price = 256;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            if($board->title == 'Supersized'){
                if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0){
                   $board_price = 0 ;
                }else{
                if($b_price * $for_multiply  < 301){
                   $board_price = 301;
                   }else{
                    $board_price = round($b_price * $for_multiply) ;
                   }
                }
            }
            $board_price = trim($board_price);
              if ($board->title == 'Small'){
                  if ($b_length * $for_multiply > 18){
                      $board_price = ($board_price * 18) /  ($b_length * $for_multiply);
                  }
              }
               if ($board->title == 'Medium'){
                  if ($b_length * $for_multiply > 25){
                      $board_price = ($board_price * 25) /  ($b_length * $for_multiply);
                  }
              }
                if ($board->title == 'Large'){
                  if ($b_length * $for_multiply > 35){
                      $board_price = ($board_price * 35) /  ($b_length * $for_multiply);
                  }
              }
                 if ($board->title == 'X Large'){
                  if ($b_length * $for_multiply > 45){
                      $board_price = ($board_price * 45) /  ($b_length * $for_multiply);
                  }
              }
                  if ($board->title == 'XX Large'){
                  if ($b_length * $for_multiply > 60){
                      $board_price = ($board_price * 60) /  ($b_length * $for_multiply);
                  }
              }
                   if ($board->title == 'Supersized'){
                  if ($b_length * $for_multiply > 80){
                      $board_price = ($board_price * 80) /  ($b_length * $for_multiply);
                  }
              }
                   $board_price = trim($board_price);
    @endphp
{{--    <p>{{json_encode($total_max_char_height_count)}}</p>--}}
{{--    <p>{{json_encode($char_count_array)}}</p>--}}
{{--    <p>{{json_encode($text)}}</p>--}}
    <div @if(isset($font_disable) && $font_disable == true) data-disable="yes" @else data-disable="not" @endif
    class="board @if($board_width != null && $board_length != null) @if($board_width == $board->width && $board_length == $board->length) active @endif @endif"
         data-length="{{$total_max_char_length_count}}" data-boardSize="{{$board->title}}" data-width="{{$total_max_char_height_count}}"
         data-price="{{$board_price}}">
        <div class="board_price"
             @if(isset($font_disable) && $font_disable == true) style=" width: auto !important;" @else @endif>
            {{ $board->title }}<br>
            @if(isset($font_disable) && $font_disable == true)
                <div style="display: flex;">
                    <span style="font-size: 14px;line-height: 28px;">Not Available For This Font</span>
                </div>
            @else
                USD<span id="board-price2">
                @if($board->title == 'Small') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply  < 102) 102 @else @if($b_length * $for_multiply > 18) {{round((($b_price * $for_multiply) * 18) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
                @if($board->title == 'Medium') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply < 136) 136 @else @if($b_length * $for_multiply > 25) {{round((($b_price * $for_multiply) * 25) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
                @if($board->title == 'Large') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply < 180) 180 @else @if($b_length * $for_multiply > 35) {{round((($b_price * $for_multiply) * 35) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
                @if($board->title == 'X Large') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply < 223) 223 @else @if($b_length * $for_multiply > 47) {{round((($b_price * $for_multiply) * 47) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
                @if($board->title == 'XX Large') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply < 256) 256 @else @if($b_length * $for_multiply > 60) {{round((($b_price * $for_multiply) * 60) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
                @if($board->title == 'Supersized') @if(round($b_length * $for_multiply, 1) == 0 || round($b_height * $for_multiply , 1) == 0) 0 @else @if($b_price * $for_multiply < 301) 301 @else @if($b_length * $for_multiply > 80) {{round((($b_price * $for_multiply) * 80) / ($b_length * $for_multiply) )}} @else {{round($b_price * $for_multiply)}} @endif @endif @endif @endif
            </span>
            @endif
        </div>
        @if(isset($font_disable) && $font_disable == true)
            <div class="board_dimension" style="display: none !important;">

            </div>
        @else
            <div class="board_dimension" style="float: right;">
                @if($board->title == 'Small') Length: @if($b_length * $for_multiply > 18) 18″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 18) {{ round((($b_height * $for_multiply) * 18 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
                @if($board->title == 'Medium') Length: @if($b_length * $for_multiply > 25) 25″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 25) {{ round((($b_height * $for_multiply) * 25 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
                @if($board->title == 'Large') Length: @if($b_length * $for_multiply > 35) 35″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 35) {{ round((($b_height * $for_multiply) * 35 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
                @if($board->title == 'X Large') Length: @if($b_length * $for_multiply > 47) 47″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 47) {{ round((($b_height * $for_multiply) * 47 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
                @if($board->title == 'XX Large') Length: @if($b_length * $for_multiply > 60) 60″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 60) {{ round((($b_height * $for_multiply) * 60 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
                @if($board->title == 'Supersized') Length: @if($b_length * $for_multiply > 80) 80″ @else {{round($b_length * $for_multiply, 1)}}″ @endif <br> Height: @if($b_length * $for_multiply > 80) {{ round((($b_height * $for_multiply) * 80 / ($b_length * $for_multiply) ) , 1) }}″ @else {{ round($b_height * $for_multiply , 1) }}″ @endif  @endif
            </div>
        @endif
    </div>
@endforeach
<div class='board-bottom' style="padding: 1%;"><small>*The Height shown is a range. Sizes vary depending on choice of
        font style, and whether the text includes upper & lower case.</small></div>
{{--Small--}}
{{--Not Available For This Font--}}

