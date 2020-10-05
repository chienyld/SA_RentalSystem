<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Darryldecode\Cart\CartCondition;

class CartController extends Controller
{
    
    public function add(Request $request)
    {
        //$user_id = auth()->user()->id;
        $userID = auth()->user()->id;
        \Cart::session($userID)->add(array(
            'id' => $request->input('id'),
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'quantity' => $request->input('qty'),
            'attributes' => array()
        ));
        $items = \Cart::getContent();
        foreach($items as $row) {

        echo $row->id; // row ID
        echo $row->name;
        echo $row->qty;
        echo $row->price;
        
        //echo $item->associatedModel->id; // whatever properties your model have
        //echo $item->associatedModel->name; // whatever properties your model have
        //echo $item->associatedModel->description; // whatever properties your model have
        }
    }
}
