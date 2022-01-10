@if($total == 0 )
<div class="singlethumb">
    <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/XRoom.png?v=1640191028">
</div>
<div class="singlethumb">
    <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Grass_2.jpg?v=1640191028">
</div>
<div class="singlethumb">
    <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Baby1.jpg?v=1640191028">
</div>
<div class="singlethumb">
    <img style="height:119px;" id="image1" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/image_2.jpg?v=1640191028">
</div>
<div class="singlethumb">
    <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Sofa.jpg?v=1640190887">
</div>
@endif
@if($total == 1 )
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[0]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Grass_2.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Baby1.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" id="image1" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/image_2.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Sofa.jpg?v=1640190887">
    </div>
@endif
@if($total == 2 )
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[0]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[1]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Baby1.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" id="image1" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/image_2.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Sofa.jpg?v=1640190887">
    </div>
@endif
@if($total == 3 )
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[0]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[1]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[2]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" id="image1" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/image_2.jpg?v=1640191028">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Sofa.jpg?v=1640190887">
    </div>
@endif
@if($total == 4 )
    <div class="singlethumb">
        <img style="height:119px;" id="image1" src="{{asset('slider_pictures'.'/'.$pictures[0]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[1]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[2]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[3]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="https://cdn.shopify.com/s/files/1/0548/7686/4740/files/Sofa.jpg?v=1640190887">
    </div>
@endif
@if($total == 5 )
    <div class="singlethumb">
        <img style="height:119px;"  src="{{asset('slider_pictures'.'/'.$pictures[0]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[1]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[2]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" id="image1" src="{{asset('slider_pictures'.'/'.$pictures[3]->picture)}}">
    </div>
    <div class="singlethumb">
        <img style="height:119px;" src="{{asset('slider_pictures'.'/'.$pictures[4]->picture)}}">
    </div>
@endif
