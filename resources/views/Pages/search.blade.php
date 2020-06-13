<!--search page-->
@extends('layout')

@section('content')


<h1>Result for "{{$names}}"</h1>
<hr>
@if(session('success'))
    <div class="alert alert-success">
      <strong>Great!</strong> {{session('success')}}
    </div>
    @endif
<div class="row" style="">

  @if(count($items) > 0)
    @foreach ($items as $item)
    
      <div class="col-sm-2">
        <div class="panel panel-success">
          
        <div class="panel-heading">
          <b>
          
          {{$item->name}}
          
          </b>
        </div>
          <div class="panel-body">
            <a href="#" data-toggle="modal" data-target="#myModal" class="itemdetail"><div class="hidden">{{$item->id}}</div>
            <img src="{{ asset('images').'/' . $item->image}}" class="img-responsive"  width="250" alt="Image">
            </a>

          </div>
          <div class="panel-footer" style="text-align:center">${{$item->price}}.00
            @if (Auth::check())
            <a href="{{ url('addcartsearch/'.$item->id.'/'.$names) }}" onclick="return confirm('Add to cart!!')"><span class="glyphicon glyphicon-shopping-cart"></span></a>
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
{{-- {{$items->links()}} --}}
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body" style="overflow-y: auto">
        <div class="col-md-2 itemimage"></div>
        <div class="col-md-10 itemdescription"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
  </div>
</div>

@endsection

