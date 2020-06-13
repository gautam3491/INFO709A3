<!--cart page-->
@extends('layout')

@section('content')


<div class="container" style="width: 50%">
  <h1>Cart</h1>
  @if(session('success'))
    <div class="alert alert-success">
      <strong>Great!</strong> {{session('success')}}
    </div>
    @endif
    @if(session('delete'))
    <div class="alert alert-danger">
      <strong>!!!</strong> {{session('delete')}}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
      <strong>!!!</strong> {{session('error')}}
    </div>
    @endif
    <table class="table table-hover">
        <thead>
          <tr>
            <th class="col-md-1">Sn</th>
            <th class="col-md-6">Name</th>
            
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th width="1px"><a href="{{url('deleteallcartuser/'.Auth::user()->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><span class="glyphicon glyphicon-trash"></span></a></th>
          </tr>
        </thead>
        <tbody>
  @if(count($carts['result']) > 0)
  
    @foreach ($carts['result'] as $cart)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td><img src="{{ asset('images').'/' . $cart->image}}" class="img-responsive"  width="50" alt="Image">{{$cart->name}}</td>
            
          <td  style="text-align:center">${{$cart->price}}.00</td>
          <td  style="text-align:center;padding:5px">
            <form method="POST" action="{{url('updatecart')}}">
              {{ csrf_field() }}
                <input type="hidden" value="{{$cart->id}}" name="cartid">
                <input type="hidden" value="{{$cart->quantity}}" name="oldquantity">
                <input type="number" min="1" style="width: 70px" onfocusout="this.form.submit()" class="form-control" value="{{$cart->quantity}}" id="newquantity" name="newquantity">
                
                  <button class="hidden" type="submit">
                    
                  </button>
                
            </form>
          </td>
          <td  style="text-align:center">${{$cart->tprice}}.00</td>
          
          <td><a href="{{url('deletecart/'.$cart->id.'/'.Auth::user()->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure?')"><span class="glyphicon glyphicon-trash"></span></a></td>
          </tr>
        
    @endforeach
  @else
    <p>No record</p>
  @endif
          <tr>
            <td></td>
            <th>Total</th>
            <td></td>
            
            <td></td>
            <th  style="text-align:center">${{$carts['total']}}.00</th>
            <td></td>
          </tr>
</tbody>
</table>

{{-- <a href="{{url('addorder/'.Auth::user()->id)}}" class="btn btn-success align-right" style="float:right">BUY</a> --}}
<button type="button" class="btn btn-success align-right" data-toggle="modal" data-target="#myModal" style="float:right">
  Buy
</button>
    
</div>
</div>

<!-- Button to Open the Modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Open modal
</button> --}}

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h3 class="modal-title"><b>Information Form</b></h3>
        {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div style="background-color: lightgrey; padding:5px">
          <h4>Customer</h4>
          Login to save your order &amp; details
          <button type="button" class="btn btn-success" >Login</button>
        
      </div>
      <br>
      <br>
      <div>
        <div class="form-group">
          <input type="text" id="address_field_imp" name="address_field_imp" class="form-control" style="visibility: hidden; position: absolute;">
          <input type="text" name="full_name" placeholder="Full Name" class="form-control" value="">
          <input type="email" name="email" placeholder="E-Mail Address" class="form-control" value="">
          <input type="tel" name="phone" placeholder="Phone Number" class="form-control" value="">
          <br>
          <button type="button" class="btn btn-success" >Place Order</button>
        </div>
      </div>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

@endsection