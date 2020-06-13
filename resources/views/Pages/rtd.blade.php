@extends('layout')

@section('content')

<h1>RTD</h1>
<hr>
<div class="row">
  @if(count($items) > 0)
    @foreach ($items as $item)
    <div class="col-sm-2">
      <div class="panel panel-success">
        <div class="panel-heading"><b><a href="" data-toggle="modal" data-target="#myModal"  class="itemdetail">{{$item->name}}<div class="hidden">{{$item->id}}</div></a></b></div>
        <div class="panel-body"><img src="{{ asset('images').'/' . $item->image}}" class="img-responsive"  width="250" alt="Image"></div>
        <div class="panel-footer" style="text-align:center">${{$item->price}}.00
          @if (Auth::check())
          <a href="{{ url('addcart/'.$item->id) }}" onclick="return confirm('Add to cart!!')"><span class="glyphicon glyphicon-shopping-cart"></span></a>
          @else
          <a href="{{ url('login') }}" onclick="return confirm('You need to login!!')"><span class="glyphicon glyphicon-shopping-cart"></span></a>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  @else
    <p>No record</p>
  @endif
    
</div>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

@endsection