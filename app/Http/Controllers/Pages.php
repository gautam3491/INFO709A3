<?php

namespace App\Http\Controllers;

use DB;
use App\items;
use App\Category;
use App\Contact;
use Illuminate\Http\Request;
use Validator, Redirect, Response;
use App\User;
use Session;

class Pages extends Controller
{
    //show all items in index page
    public function show()
    {
        $name = "Specials";
        $items = items::all();
        return view('pages.index', ['items' => $items, 'names' => $name]);
    }

    //show items according to category
    public function items($id)
    {
        $name = Category::select('name')->where('id', $id)->first();
        $items = Items::where('categoryid', $id)->get();
        return view('pages.beer', ['items' => $items, 'names' => $name->name]);
    }

    //show item description
    public function showitem($id)
    {
        $data = Items::where('id', $id)->first();
        return $data;
    }

    // public function showBeer()
    // {
    //     $items = Items::where('categoryid', '1')->get();
    //     return view('pages.beer', ['items' => $items]);
    // }

    // public function showWine()
    // {
    //     $items = Items::where('categoryid', '2')->get();
    //     return view('pages.wine', ['items' => $items]);
    // }

    // public function showRTD()
    // {
    //     $items = Items::where('categoryid', '3')->get();
    //     return view('pages.rtd', ['items' => $items]);
    // }


    //to show items according to search value
    public function showSearch(Request $request)
    {
        $name = $request->search;
        $items = Items::where('name', 'like', $name . '%')->get();
        return view('pages.search', ['items' => $items, 'names' => $name]);
    }

    //to show items according to search value
    public function showSearchGet($result)
    {
        $name = $result;
        $items = Items::where('name', 'like', $name . '%')->get();
        return view('pages.search', ['items' => $items, 'names' => $name]);
    }

    // public function login()
    // {
    //     return view('pages.login');
    // }

    // public function register()
    // {
    //     return view('pages.register');
    // }

    //form view for contact
    public function contact()
    {
        return view('pages.contact');
    }

    //insert in contact
    public function addcontact(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'phone' => 'required'
        ]);

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
        return redirect()->back()->withSuccess('Thank you');
    }
}
