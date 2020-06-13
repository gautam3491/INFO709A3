@extends('pages.order')

@section('content')

<h1>ALL</h1>
<div class="row">
  {{-- @if(count($items) > 0)
    @foreach ($items as $item)
      <div class="col-sm-4">
        <div class="panel panel-success">
          <div class="hidden">{{$item->id}}</div>
          <div class="panel-heading">{{$item->name}}</div>
          <div class="panel-body"><img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image"></div>
          <div class="panel-footer" style="text-align:center">${{$item->price}}.00
            @if(Auth::check())
          <a href="{{ url('addcart/'.$item->id.'/'.Auth::user()->id) }}">add</a>
          @endif
          </div>
        </div>
      </div>
    @endforeach
  @else
    <p>No record</p>
  @endif --}}

    
</div>

@endsection