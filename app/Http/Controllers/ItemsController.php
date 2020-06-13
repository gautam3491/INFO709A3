<?php

namespace App\Http\Controllers;

use App\items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator, Redirect, Response;
use App\Cart;
use App\Order;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\OrderDetail;
use DB;

class ItemsController extends Controller
{

    //show all items in cart
    public function showcart($userid)
    {
        $data = $this->allData($userid);
        return view('pages.cart', ['carts' => $data]);
    }

    //insert in cart
    public function addCart($id)
    {
        // return $id;
        if (Auth::check()) {
            $userid = Auth::user()->id;

            $check = Cart::where('pid', $id)->where('userid', $userid)->count();
            // return $check;
            if ($check > 0) {
                $result = Cart::where('pid', $id)->where('userid', $userid)
                    ->select('quantity')->first();

                $quantity = $result->quantity;

                Cart::where('pid', $id)->where('userid', $userid)
                    ->update(['quantity' => $quantity + 1]);
            } else {
                $cart = new Cart();
                $cart->pid = $id;
                $cart->userid = $userid;
                $cart->quantity = 1;
                $cart->save();
            }
            return redirect()->back()->withSuccess('Added to Cart');
        } else {
            return Redirect::to("login");
        }
    }

    //insert in cart from search
    public function addCartSearch($id, $result)
    {
        if (Auth::check()) {
            $userid = Auth::user()->id;

            $check = Cart::where('pid', $id)->where('userid', $userid)->count();
            // return $check;
            if ($check > 0) {
                $results = Cart::where('pid', $id)->where('userid', $userid)
                    ->select('quantity')->first();

                $quantity = $results->quantity;

                Cart::where('pid', $id)->where('userid', $userid)
                    ->update(['quantity' => $quantity + 1]);
            } else {
                $cart = new Cart();
                $cart->pid = $id;
                $cart->userid = $userid;
                $cart->quantity = 1;
                $cart->save();
            }
            // return redirect()->back()->withSuccess('Added to Cart');
            return Redirect::to('showsearchget/' . $result)->withSuccess('Added to Cart');
        } else {
            return Redirect::to("login");
        }
    }

    //update quantity, price in cart
    public function updateCart(Request $request)
    {
        $oldquantity = $request->oldquantity;
        $newquantity = $request->newquantity;
        $cartid = $request->cartid;

        if ($oldquantity == $newquantity) {
            return Redirect::to('showcart/' . Auth::user()->id);
        } else {
            Cart::where('id', $cartid)
                ->update(['quantity' => $newquantity]);

            return Redirect::to('showcart/' . Auth::user()->id)->withSuccess('Update Success');
        }
    }

    //delete item in cart
    public function deleteCart($id, $userid)
    {
        Cart::where('id', '=', $id)->delete();
        return Redirect::to('showcart/' . $userid)->withDelete('Item Removed');
    }

    //deleting from cart after buying
    public function deleteCartUser($userid): void
    {
        Cart::where('userid', '=', $userid)->delete();
        // return Redirect::to('showcart/'.$userid);
    }

    //deleting from cart before buying
    public function deleteAllCartUser($userid)
    {
        $data = $this->allData($userid);
        $check = $data['total'];
        if ($check > 0) {
            Cart::where('userid', '=', $userid)->delete();
            return Redirect::to('showcart/' . $userid)->withDelete('All Item Removed');
        } else {
            return Redirect::to('showcart/' . $userid)->withDelete('No Items');
        }
    }

    //insert in order
    public function addOrder($userid)
    {
        $data = $this->allData($userid);
        $check = $data['total'];
        if ($check > 0) {
            $order = new Order();
            $order->userid = $userid;
            $order->total = $data['total'];
            $order->save();
            $lastInsertId = $order->id;


            foreach ($data['result'] as $d) {
                $orderdetail = new OrderDetail();
                $orderdetail->orderid = $lastInsertId;
                $orderdetail->pid = $d->pid;
                $orderdetail->userid = $userid;
                $orderdetail->pname = $d->name;
                $orderdetail->price = $d->price;
                $orderdetail->quantity = $d->quantity;
                $orderdetail->tprice = $d->tprice;
                $orderdetail->save();
            }

            $this->deleteCartUser($userid);
            return Redirect::to("showorder/" . $userid)->withSuccess('Purchase Success');
        } else {
            return Redirect::to("showcart/" . $userid)->withDelete('No Items');
        }
    }

    //join query for cart and item tables
    public function allData($userid)
    {
        $carts = Cart::select(
            'carts.id',
            'carts.pid',
            'carts.created_at',
            'items.name',
            'items.image',
            'users.name as uname',
            'items.price',
            'carts.quantity',
            DB::raw('items.price*carts.quantity as tprice')
        )

            ->join('items', 'items.id', '=', 'carts.pid')
            ->join('users', 'users.id', '=', 'carts.userid')
            ->where('userid', '=', $userid)
            ->get();

        $total = Cart::join('items', 'items.id', '=', 'carts.pid')
            ->join('users', 'users.id', '=', 'carts.userid')
            ->where('userid', '=', $userid)
            ->sum(DB::raw('items.price*carts.quantity'));

        $data = array(
            'result' => $carts,
            'total' => $total
        );
        return $data;
    }

    //show all items in order
    public function showorder($userid)
    {
        $orders = Order::where('userid', '=', $userid)
            ->orderByRaw('created_at DESC')->get();
        // $data = $this->allData($userid);
        return view('pages.order', ['orders' => $orders]);
    }

    //show all items in orderdetail according to order
    public function ajaxshow($id)
    {
        $orderdetails = OrderDetail::where('orderid', '=', $id)->get();
        return $orderdetails;
    }
}
