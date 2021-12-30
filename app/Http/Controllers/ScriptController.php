<?php

namespace App\Http\Controllers;

use App\Font;
use App\Models\Board;
use App\Models\BoardSize;
use App\Models\Color;
use App\Models\FontFamily;
use App\Models\Option;
use App\Models\Pricing;
use App\Models\SaveDesign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Osiset\BasicShopifyAPI\BasicShopifyAPI;
use Osiset\BasicShopifyAPI\Options;
use Osiset\BasicShopifyAPI\Session;

class ScriptController extends Controller
{
    public function index(Request $request)
    {
        $b_price = $request->b_price;
        $font= null;
        $text= null;
        if (isset($request->slug)) {
            $savedDesign = SaveDesign::where('slug', $request->slug)->first();
            $wall_text = $savedDesign->text;
            $wall_color = $savedDesign->color;
            $wall_font = $savedDesign->font;
            $shape = $savedDesign->Shape;
            $supply = $savedDesign->Supply;
            $board_length = $savedDesign->length;
            $board_width = $savedDesign->width;
        } else {
            $savedDesign = null;
            $wall_text = null;
            $wall_color = null;
            $wall_font = null;
            $shape = null;
            $supply = null;
            $board_length = null;
            $board_width = null;
        }
        $f_colors = Color::all();
        if (count($f_colors) > 0) {
            $colors = view('append.color')->with([
                'f_colors' => $f_colors,
                'wall_color' => $wall_color
            ])->render();
        } else {
            $colors = null;
        }

        $f_fonts = FontFamily::all();
        $small_fonts = $f_fonts->where('type', 'Small Font')->sortBy('title');
        $large_fonts = $f_fonts->where('type', 'Big Font')->sortBy('title');
        $merged = $small_fonts->merge($large_fonts);
        if (count($merged) > 0) {
            $fonts = view('append.font')->with([
                'f_fonts' => $merged,
                'wall_font' => $wall_font
            ])->render();
            $faces = view('append.font_face')->with([
                'f_fonts' => $merged,
            ])->render();
        } else {
            $fonts = null;
            $faces = null;
        }
        if ($wall_text != null) {
            $font = FontFamily::where('title', 'like', '%' . $wall_font . '%')->first();
            $text = str_replace(' ', '', $wall_text);
            $textLength = strlen($text);
        } else {
            $font = FontFamily::first();
            $textLength = 1;
            $text = 'a';
        }
//        $boards = BoardSize::where('font_type', 'Small Font')->where('letter', $textLength)->get();
        $boards = Board::get();
        if (count($boards) > 0) {
            $board = view('append.board')->with([
                'boards' => $boards,
                'board_length' => $board_length,
                'board_width' => $board_width,
                'textLength' => $textLength,
                'font' => $font,
                'text' => $text,
                'b_price'=>$b_price,
            ])->render();
        } else {
            $board = null;
        }

        return response()->json([
            'status' => 'success',
            'text' => $wall_text,
            'color' => $colors,
            'font' => $fonts,
            'font_face' => $faces,
            'shape' => $shape,
            'supply' => $supply,
            'board' => $board
        ]);
    }
//    public function index(Request $request)
//    {
//        if (isset($request->slug)) {
//            $savedDesign = SaveDesign::where('slug', $request->slug)->first();
//            $wall_text = $savedDesign->text;
//            $wall_color = $savedDesign->color;
//            $wall_font = $savedDesign->font;
//            $shape = $savedDesign->Shape;
//            $supply = $savedDesign->Supply;
//            $board_length = $savedDesign->length;
//            $board_width = $savedDesign->width;
//        } else {
//            $savedDesign = null;
//            $wall_text = null;
//            $wall_color = null;
//            $wall_font = null;
//            $shape = null;
//            $supply = null;
//            $board_length = null;
//            $board_width = null;
//        }
//        $f_colors = Color::all();
//        if (count($f_colors) > 0) {
//            $colors = view('append.color')->with([
//                'f_colors' => $f_colors,
//                'wall_color' => $wall_color
//            ])->render();
//        } else {
//            $colors = null;
//        }
//
//        $f_fonts = FontFamily::all();
//        $small_fonts = $f_fonts->where('type','Small Font')->sortBy('title');
//        $large_fonts = $f_fonts->where('type','Big Font')->sortBy('title');
//        $merged = $small_fonts->merge($large_fonts);
//        if (count($merged) > 0) {
//            $fonts = view('append.font')->with([
//                'f_fonts' => $merged,
//                'wall_font' => $wall_font
//            ])->render();
//            $faces = view('append.font_face')->with([
//                'f_fonts' => $merged,
//            ])->render();
//        } else {
//            $fonts = null;
//            $faces = null;
//        }
//          if ($wall_text != null){
//            $font = FontFamily::where('title', 'like', '%' . $wall_font . '%')->first();
//            $text = str_replace(' ', '', $wall_text);
//            $textLength = strlen($text);
//        }else{
//            $textLength = 1;
//        }
//        $boards = BoardSize::where('font_type', 'Small Font')->where('letter', $textLength)->get();
//        if (count($boards) > 0) {
//            $board = view('append.board')->with([
//                'boards' => $boards,
//                'board_length' => $board_length,
//                'board_width' => $board_width
//            ])->render();
//        } else {
//            $board = null;
//        }
//        return response()->json([
//            'status' => 'success',
//            'text' => $wall_text,
//            'color' => $colors,
//            'font' => $fonts,
//            'font_face' => $faces,
//            'shape' => $shape,
//            'supply' => $supply,
//            'board' => $board
//        ]);
//    }

    public function availableBoard(Request $request)
    {
        dd($request->all());
        $board_price = $request->for_board_price;
        $for_board_length = $request->for_board_length;
        $font = null;
        if (isset($request->slug)) {
            $savedDesign = SaveDesign::where('slug', $request->slug)->first();
            $board_length = $savedDesign->length;
            $board_width = $savedDesign->width;
        } else {
            $board_length = null;
            $board_width = null;
        }
        $font = FontFamily::where('title', 'like', '%' . $request->properties['wall_font'] . '%')->first();
        $text = str_replace(' ', '', isset($request->properties['wall_text']) ? $request->properties['wall_text'] : 'a');
        $textLength = strlen($text);
//        $boards = BoardSize::where('font_type', $font->type)->where('letter', $textLength)->get();
        $boards = Board::get();
        if ($textLength != 0) {
            if (count($boards) > 0) {
                $board = view('append.board')->with([
                    'boards' => $boards,
                    'board_length' => $board_length,
                    'board_width' => $board_width,
                    'text' => $text,
                    'textLength' => $textLength,
                    'font' => $font,
                    'b_price'=>$board_price,
                    'for_board_length'=>$for_board_length,
                ])->render();
            } else {
                $board = '<p>“Too many letters for this font! (Max 50)”</p>';
            }
        } else {
            $board = '<p>Please Enter Your Text First !</p>';
        }
        return response()->json([
            'status' => 'success',
            'board' => $board,
            'length' => $board_length,
            'width' => $board_width,
        ]);
    }
//    public function availableBoard(Request $request)
//    {
//        if (isset($request->slug)) {
//            $savedDesign = SaveDesign::where('slug', $request->slug)->first();
//            $board_length = $savedDesign->length;
//            $board_width = $savedDesign->width;
//        } else {
//            $board_length = null;
//            $board_width = null;
//        }
//        $font = FontFamily::where('title', 'like', '%' . $request->properties['wall_font'] . '%')->first();
//        $text = str_replace(' ', '', $request->properties['wall_text']);
//        $textLength = strlen($text);
//        $boards = BoardSize::where('font_type', $font->type)->where('letter', $textLength)->get();
//        if ($textLength != 0) {
//            if (count($boards) > 0) {
//                $board = view('append.board')->with([
//                    'boards' => $boards,
//                    'board_length' => $board_length,
//                    'board_width' => $board_width
//                ])->render();
//            } else {
//                $board = '<p>“Too many letters for this font! (Max 50)”</p>';
//            }
//        } else {
//            $board = '<p>Please Enter Your Text First !</p>';
//        }
//        return response()->json([
//            'status' => 'success',
//            'board' => $board,
//            'length' => $board_length,
//            'width' => $board_width,
//        ]);
//    }

    public function cartOrder(Request $request)
    {
        $cart = json_decode($request->cart);
        $customizationCharges = 0;
        foreach ($cart->items as $item) {
            if (isset($item->properties)) {
                if (isset($item->properties->wall_text)) {
                    $font = FontFamily::where('title', 'like', '%' . $item->properties->wall_font . '%')->first();
                    $text = str_replace(' ', '', $item->properties->wall_text);
                    $textLength = strlen($text);
                    $board = BoardSize::where('length', $item->properties->length)->where('width', $item->properties->width)->where('font_type', $font->type)->where('letter', $textLength)->first();
                    $customizationCharges = $board->price * $item->quantity;
                    $slug = sha1(time() . $item->product_id);
                    $saveDesign = new SaveDesign();
                    $saveDesign->text = $item->properties->wall_text;
                    $saveDesign->font = $item->properties->wall_font;
                    $saveDesign->color = $item->properties->wall_color;
                    $saveDesign->length = $item->properties->length;
                    $saveDesign->width = $item->properties->width;
                    $saveDesign->shape = $item->properties->Shape;
                    $saveDesign->supply = $item->properties->Supply;
                    $saveDesign->slug = $slug;
                    $saveDesign->save();
                }
            }
        }
        $items = [];

        foreach ($cart->items as $item) {
            if (isset($item->properties)) {
                array_push($items, [
                    "variant_id" => $item->variant_id,
                    "quantity" => $item->quantity,
                    "properties" => [
                        [
                            'name' => 'Wall Text',
                            'value' => json_encode($item->properties->wall_text),
                        ],
                        [
                            'name' => 'Wall Font',
                            'value' => $item->properties->wall_font,
                        ],
                        [
                            'name' => 'Wall Color',
                            'value' => $item->properties->wall_color,
                        ],
                        [
                            'name' => 'Wall Size',
                            'value' => $item->properties->length . '*' . $item->properties->width,
                        ],
                        [
                            'name' => 'Backing Shape',
                            'value' => $item->properties->Shape,
                        ],
                        [
                            'name' => 'Power Supply',
                            'value' => $item->properties->Supply,
                        ],
                        [
                            'name' => 'Preview Link',
                            'value' => "https://mycustomled.com/pages/design-custom-led-sign?type=" . $slug,
                        ],
                    ]
                ]);
            } else {
                array_push($items, [
                    "variant_id" => $item->variant_id,
                    "quantity" => $item->quantity,
                ]);
            }
        }
        if ($customizationCharges != 0) {
            array_push($items, [
                "title" => "Customization Charges",
                "price" => $customizationCharges,
                "quantity" => 1
            ]);
        }
        if (isset($request->discount)) {
            $priceRules = $this->getShopify('neon-nerd-co.myshopify.com')->rest('GET', '/admin/price_rules.json');
            $discounts = json_decode(json_encode($priceRules['body']->container['price_rules']));
            $applied_discount = null;
            foreach ($discounts as $disc) {
                if ($disc->title == $request->discount) {
//        Place Order on Shopify Store with discount
                    $response = $this->getShopify('neon-nerd-co.myshopify.com')->rest('POST', '/admin/draft_orders.json',
                        [
                            "draft_order" => [
                                "financial_status" => "pending",
                                "line_items" => $items,
                                "applied_discount" => [
                                    "description" => "Custom discount",
                                    "value_type" => $disc->value_type,
                                    "value" => $disc->value * -1,
                                    "amount" => $disc->value * -1,
                                    "title" => $disc->title
                                ],
                            ]
                        ]);
                }
            }
        } else {
//        Place Order on Shopify Store
            $response = $this->getShopify('neon-nerd-co.myshopify.com')->rest('POST', '/admin/draft_orders.json',
                [
                    "draft_order" => [
                        "financial_status" => "pending",
                        "line_items" => $items
                    ]
                ]);
        }
        $url = $response['body']->container['draft_order']['invoice_url'];
        return response()->json([
            'status' => 'success',
            'url' => $url,
        ]);
    }

    public function order(Request $request)
    {
        if ($request->indoor != null) {
            $indoor = $request->indoor;
        } else {
            $indoor = 0;
        }
        if ($request->outdoor != null) {
            $outdoor = $request->outdoor;
        } else {
            $outdoor = 0;
        }
        if ($request->power_adapter != null) {
            $power_adapter = $request->power_adapter;
        } else {
            $power_adapter = '';
        }

        if ($request->cut_around_acrylic != null) {
            $cut_around_acrylic = $request->cut_around_acrylic;
        } else {
            $cut_around_acrylic = 0;
        }

        if ($request->rectangle_acrylic != null) {
            $rectangle_acrylic = $request->rectangle_acrylic;
        } else {
            $rectangle_acrylic = 0;
        }

        if ($request->cut_to_letter != null) {
            $cut_to_letter = $request->cut_to_letter;
        } else {
            $cut_to_letter = 0;
        }
        if ($request->acrylic_stand != null) {
            $acrylic_stand = $request->acrylic_stand;
        } else {
            $acrylic_stand = 0;
        }
        if ($request->open_box != null) {
            $open_box = $request->open_box;
        } else {
            $open_box = 0;
        }

        if (isset($request->remote_dimmer)) {
            $remote_dimmer = $request->remote_dimmer;
        } else {
            $remote_dimmer = 0;
        }
        if (isset($request->wallmounting)) {
            $wallmounting = $request->wallmounting;
        } else {
            $wallmounting = 0;
        }

        if (isset($request->signhanging)) {
            $signhanging = $request->signhanging;
        } else {
            $signhanging = 0;
        }

        $font = FontFamily::where('title', 'like', '%' . $request->properties['wall_font'] . '%')->first();
        $text = str_replace(' ', '', $request->properties['wall_text']);
        $textLength = strlen($text);
//        $board = BoardSize::where('length', $request->properties['length'])->where('width', $request->properties['width'])->where('font_type', $font->type)->where('letter', $textLength)->first();

        $customizationCharges = $request->properties['board_price'] + $indoor + $outdoor;
        if ($request->indoor != null) {
            $doortitle = 'Indoor Sign';
            if ($request->indoor == 0) {
                $doorprice = 'Free';
            } else {
                $doorprice = $request->indoor;
            }
        } elseif ($request->outdoor != null) {
            $doortitle = 'Outdoor Sign';
            if ($request->outdoor == 0) {
                $doorprice = 'Free';
            } else {
                $doorprice = '+£' . $request->outdoor;
            }
        } else {
            $doortitle = null;
            $doorprice = null;
        }
        if ($request->power_adapter == 'usa/can') {
            $power_adapter = 'USA/CANADA 120V';
        } elseif ($request->power_adapter == 'uk') {
            $power_adapter = 'UK/IRELAND 230V';
        } elseif ($request->power_adapter == 'eu') {
            $power_adapter = 'EUROPE 230V';
        } elseif ($request->power_adapter == 'aus/nz') {
            $power_adapter = 'AUSTRALIA/NZ 230V';
        } elseif ($request->power_adapter == 'jp') {
            $power_adapter = 'JAPAN 100V';
        }

        if (isset($request->tubecolor)) {
            $tubecolor = $request->tubecolor;
        } else {
            $tubecolor = 'NO';
        }

        if (isset($request->multicolor)) {
            $multicolor = $request->multicolor;
        } else {
            $multicolor = 'NO';
        }
        if (isset($request->waterproof)) {
            $waterproof = $request->waterproof;
        } else {
            $waterproof = 'NO';
        }
        if (isset($request->deliverytime)) {
            $deliverytime = $request->deliverytime;
        } else {
            $deliverytime = 'NO';
        }
        if (isset($request->framecut)) {
            $framecut = $request->framecut;
        } else {
            $framecut = 'NO';
        }
        if (isset($request->plugtype)) {
            $plugtype = $request->plugtype;
        } else {
            $plugtype = 'NO';
        }
//        $wall = BoardSize::where('length', $request->properties['length'])->where('width', $request->properties['width'])->first();
        //Making Array of Customization
        $items = [];
        array_push($items, [
            "title" => "Custom Neon Sign",
            "price" => $customizationCharges,
            "quantity" => 1,
            "properties" => [
                [
                    'name' => 'Wall Text',
                    'value' => $request->properties['wall_text'],
                ],
                [
                    'name' => 'Wall Font',
                    'value' => $request->properties['wall_font'],
                ],
                [
                    'name' => 'Wall Color',
                    'value' => $request->properties['wall_color'],
                ],
                [
                    'name' => 'Wall Size',
                    'value' => $request->properties['board_size'] . ' (' . $request->properties['length'] . '*' . $request->properties['width'] . ')',
                ],
                [
                    'name' => 'Tube Color',
                    'value' => $tubecolor,
                ],
                [
                    'name' => 'Multi Color',
                    'value' => $multicolor,
                ],
                [
                    'name' => 'Water Proof',
                    'value' => $waterproof,
                ],
                [
                    'name' => 'Delivery Time',
                    'value' => $deliverytime,
                ],
                [
                    'name' => 'Frame Cut',
                    'value' => $framecut,
                ],
                [
                    'name' => 'Plug Type',
                    'value' => $plugtype,
                ],
                [
                    'name' => 'Board Price',
                    'value' => '+£' . $request->properties['board_price'],
                ],
            ]
        ]);
        if ($request->cut_around_acrylic != null) {
            $back_board_title = 'Cut Around Acrylic';
            $back_board_price = $request->cut_around_acrylic;
        } elseif ($request->rectangle_acrylic != null) {
            $back_board_title = 'Rectangle Acrylic';
            $back_board_price = $request->rectangle_acrylic;
        } elseif ($request->cut_to_letter != null) {
            $back_board_title = 'Cut to letter';
            $back_board_price = $request->cut_to_letter;
        } elseif ($request->acrylic_stand != null) {
            $back_board_title = 'Acrylic Stand';
            $back_board_price = $request->acrylic_stand;
        } elseif ($request->open_box != null) {
            $back_board_title = 'Open box';
            $back_board_price = $request->open_box;
        } else {
            $back_board_title = null;
            $back_board_price = null;
        }
        if ($back_board_title != null && $back_board_price != null) {
            array_push($items, [
                "title" => $back_board_title,
                "price" => $back_board_price,
                "quantity" => 1
            ]);
        }

        if ($request->remote_dimmer != null) {
            $title = 'Remote Dimmer';
            $price = $request->remote_dimmer;
            array_push($items, [
                "title" => $title,
                "price" => $price,
                "quantity" => 1
            ]);
        }
        if ($request->wallmounting != null) {
            $title = 'Wallmounting';
            $price = $request->wallmounting;
            array_push($items, [
                "title" => $title,
                "price" => $price,
                "quantity" => 1
            ]);
        }
        if ($request->signhanging != null) {
            $title = 'Signhanging';
            $price = $request->signhanging;
            array_push($items, [
                "title" => $title,
                "price" => $price,
                "quantity" => 1
            ]);
        }
//        Getting Slug of Order
        $slug = sha1(time() . $request->product_id);
        $saveDesign = new SaveDesign();
        $saveDesign->text = $request->properties['wall_text'];
        $saveDesign->font = $request->properties['wall_font'];
        $saveDesign->color = $request->properties['wall_color'];
        $saveDesign->length = $request->properties['length'];
        $saveDesign->width = $request->properties['width'];
        $saveDesign->shape = $request->properties['Shape'];
        $saveDesign->supply = $request->properties['Supply'];
        $saveDesign->slug = $slug;
        $saveDesign->save();
//        Place Order on Shopify Store
        $response = $this->getShopify('neons-co.myshopify.com')->rest('POST', '/admin/draft_orders.json',
            [
                "draft_order" => [
                    "financial_status" => "pending",
                    "line_items" => $items,
                    "note" => "https://mycustomled.com/pages/design-custom-led-sign?type=" . $slug
                ]
            ]   );
        $url = $response['body']->container['draft_order']['invoice_url'];
        return response()->json([
            'status' => 'success',
            'url' => $url,
        ]);
    }
//    public function order(Request $request)
//    {
//
//        if ($request->indoor != null) {
//            $indoor = $request->indoor;
//        } else {
//            $indoor = 0;
//        }
//        if ($request->outdoor != null) {
//            $outdoor = $request->outdoor;
//        } else {
//            $outdoor = 0;
//        }
//        if ($request->power_adapter != null) {
//            $power_adapter = $request->power_adapter;
//        } else {
//            $power_adapter = '';
//        }
//
//        if ($request->cut_around_acrylic != null) {
//            $cut_around_acrylic = $request->cut_around_acrylic;
//        } else {
//            $cut_around_acrylic = 0;
//        }
//
//        if ($request->rectangle_acrylic != null) {
//            $rectangle_acrylic = $request->rectangle_acrylic;
//        } else {
//            $rectangle_acrylic = 0;
//        }
//
//        if ($request->cut_to_letter != null) {
//            $cut_to_letter = $request->cut_to_letter;
//        } else {
//            $cut_to_letter = 0;
//        }
//        if ($request->acrylic_stand != null) {
//            $acrylic_stand = $request->acrylic_stand;
//        } else {
//            $acrylic_stand = 0;
//        }
//        if ($request->open_box != null) {
//            $open_box = $request->open_box;
//        } else {
//            $open_box = 0;
//        }
//
//        if (isset($request->remote_dimmer)) {
//            $remote_dimmer = $request->remote_dimmer;
//        } else {
//            $remote_dimmer = 0;
//        }
//        if (isset($request->wallmounting)) {
//            $wallmounting = $request->wallmounting;
//        } else {
//            $wallmounting = 0;
//        }
//
//        if (isset($request->signhanging)) {
//            $signhanging = $request->signhanging;
//        } else {
//            $signhanging = 0;
//        }
//
//        $font = FontFamily::where('title', 'like', '%' . $request->properties['wall_font'] . '%')->first();
//        $text = str_replace(' ', '', $request->properties['wall_text']);
//        $textLength = strlen($text);
//        $board = BoardSize::where('length', $request->properties['length'])->where('width', $request->properties['width'])->where('font_type', $font->type)->where('letter', $textLength)->first();
//
//        $customizationCharges = $board->price + $indoor + $outdoor;
//        if ($request->indoor != null) {
//            $doortitle = 'Indoor Sign';
//            if ($request->indoor == 0) {
//                $doorprice = 'Free';
//            } else {
//                $doorprice = $request->indoor;
//            }
//        } elseif ($request->outdoor != null) {
//            $doortitle = 'Outdoor Sign';
//            if ($request->outdoor == 0) {
//                $doorprice = 'Free';
//            } else {
//                $doorprice = '+£' . $request->outdoor;
//            }
//        } else {
//            $doortitle = null;
//            $doorprice = null;
//        }
//        if ($request->power_adapter == 'usa/can') {
//            $power_adapter = 'USA/CANADA 120V';
//        } elseif ($request->power_adapter == 'uk') {
//            $power_adapter = 'UK/IRELAND 230V';
//        } elseif ($request->power_adapter == 'eu') {
//            $power_adapter = 'EUROPE 230V';
//        } elseif ($request->power_adapter == 'aus/nz') {
//            $power_adapter = 'AUSTRALIA/NZ 230V';
//        } elseif ($request->power_adapter == 'jp') {
//            $power_adapter = 'JAPAN 100V';
//        }
//
//        $wall = BoardSize::where('length', $request->properties['length'])->where('width', $request->properties['width'])->first();
//        //Making Array of Customization
//        $items = [];
//        array_push($items, [
//            "title" => "Custom Neon Sign",
//            "price" => $customizationCharges,
//            "quantity" => 1,
//            "properties" => [
//                [
//                    'name' => 'Wall Text(8)',
//                    'value' => $request->properties['wall_text'],
//                ],
//                [
//                    'name' => 'Wall Font',
//                    'value' => $request->properties['wall_font'],
//                ],
//                [
//                    'name' => 'Wall Color',
//                    'value' => $request->properties['wall_color'],
//                ],
//                [
//                    'name' => 'Wall Size',
//                    'value' => $wall->size . ' (' . $request->properties['length'] . '*' . $request->properties['width'] . ')',
//                ],
//                [
//                    'name' => 'Backing Shape',
//                    'value' => $request->properties['Shape'],
//                ],
//                [
//                    'name' => 'Power Supply',
//                    'value' => $request->properties['Supply'],
//                ],
//                [
//                    'name' => 'Power Adapter',
//                    'value' => $power_adapter,
//                ],
//                [
//                    'name' => $doortitle,
//                    'value' => $doorprice,
//                ],
//                [
//                    'name' => 'Board Price',
//                    'value' => '+£' . $board->price,
//                ],
//            ]
//        ]);
//        if ($request->cut_around_acrylic != null) {
//            $back_board_title = 'Cut Around Acrylic';
//            $back_board_price = $request->cut_around_acrylic;
//        } elseif ($request->rectangle_acrylic != null) {
//            $back_board_title = 'Rectangle Acrylic';
//            $back_board_price = $request->rectangle_acrylic;
//        } elseif ($request->cut_to_letter != null) {
//            $back_board_title = 'Cut to letter';
//            $back_board_price = $request->cut_to_letter;
//        } elseif ($request->acrylic_stand != null) {
//            $back_board_title = 'Acrylic Stand';
//            $back_board_price = $request->acrylic_stand;
//        } elseif ($request->open_box != null) {
//            $back_board_title = 'Open box';
//            $back_board_price = $request->open_box;
//        } else {
//            $back_board_title = null;
//            $back_board_price = null;
//        }
//        if ($back_board_title != null && $back_board_price != null) {
//            array_push($items, [
//                "title" => $back_board_title,
//                "price" => $back_board_price,
//                "quantity" => 1
//            ]);
//        }
//
//        if ($request->remote_dimmer != null) {
//            $title = 'Remote Dimmer';
//            $price = $request->remote_dimmer;
//            array_push($items, [
//                "title" => $title,
//                "price" => $price,
//                "quantity" => 1
//            ]);
//        }
//        if ($request->wallmounting != null) {
//            $title = 'Wallmounting';
//            $price = $request->wallmounting;
//            array_push($items, [
//                "title" => $title,
//                "price" => $price,
//                "quantity" => 1
//            ]);
//        }
//        if ($request->signhanging != null) {
//            $title = 'Signhanging';
//            $price = $request->signhanging;
//            array_push($items, [
//                "title" => $title,
//                "price" => $price,
//                "quantity" => 1
//            ]);
//        }
////        Getting Slug of Order
//        $slug = sha1(time() . $request->product_id);
//        $saveDesign = new SaveDesign();
//        $saveDesign->text = $request->properties['wall_text'];
//        $saveDesign->font = $request->properties['wall_font'];
//        $saveDesign->color = $request->properties['wall_color'];
//        $saveDesign->length = $request->properties['length'];
//        $saveDesign->width = $request->properties['width'];
//        $saveDesign->shape = $request->properties['Shape'];
//        $saveDesign->supply = $request->properties['Supply'];
//        $saveDesign->slug = $slug;
//        $saveDesign->save();
////        Place Order on Shopify Store
//        $response = $this->getShopify('neon-nerd-co.myshopify.com')->rest('POST', '/admin/draft_orders.json',
//            [
//                "draft_order" => [
//                    "financial_status" => "pending",
//                    "line_items" => $items,
//                    "note" => "https://mycustomled.com/pages/design-custom-led-sign?type=" . $slug
//                ]
//            ]);
//        $url = $response['body']->container['draft_order']['invoice_url'];
//        return response()->json([
//            'status' => 'success',
//            'url' => $url,
//        ]);
//    }

    public function discount(Request $request)
    {
        $response = $this->getShopify('neon-nerd-co.myshopify.com')->rest('GET', '/admin/price_rules.json');
        $discounts = json_decode(json_encode($response['body']->container['price_rules']));
        $discount_status = null;
        foreach ($discounts as $discount) {
            if ($discount->title == $request->discount) {
                $discount_status = 'yes';
            }
        }
        return response()->json([
            'status' => 'success',
            'discount' => $discount_status,
        ]);
    }

    public function getShopify($domain = null)
    {
        if (Auth::user()) {
            $this->api = Auth::user()->api();
        } else {
            if ($domain) {
            } else {
                $domain = env('SHOPIFY_SHOP');
            }
            $shop = \App\Models\User::where('name', $domain)->first();
            $options = new Options();
            $options->setVersion('2021-07');
            $options->setApiKey(env('SHOPIFY_API_KEY'));
            $options->setApiSecret(env('SHOPIFY_API_SECRET'));
            $this->api = new BasicShopifyAPI($options);
            $this->api->setSession(new Session($domain, $shop->password));
        }
        return $this->api;
    }

    public function saveDesign(Request $request)
    {
        $slug = sha1(time() . $request->product_id);
        $saveDesign = new SaveDesign();
        $saveDesign->text = $request->properties['wall_text'];
        $saveDesign->font = $request->properties['wall_font'];
        $saveDesign->color = $request->properties['wall_color'];
        $saveDesign->length = $request->properties['length'];
        $saveDesign->width = $request->properties['width'];
        $saveDesign->shape = $request->properties['Shape'];
        $saveDesign->supply = $request->properties['Supply'];
        $saveDesign->slug = $slug;
        $saveDesign->save();
        return response()->json([
            'status' => 'success',
            'slug' => $slug,
        ]);
    }

}
