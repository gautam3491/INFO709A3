<!--order page-->
@extends('layout')

@section('content')
<br>

<div class="container" style="width: 50%" >
  @if(session('success'))
<div class="alert alert-success">
  <strong>Great!</strong> {{session('success')}}
</div>
@endif
    <div class="form-group">
        <label for="sel1">Select Date:</label>
      <select class="form-control sopclass" id="sel1 sopid">
           
          @foreach($orders as $data)
        <option value='{{$data->id}}'>{{$data->created_at->format('Y M jS - G:i A')}}</option>
        @endforeach
      </select>
      <div >
        <table class="table table-hover">
            <thead>
              <tr>
                <th class="col-md-6">Name</th>
                <th class="col-md-2">Price</th>
                <th class="col-md-2" style="text-align:center">Quantity</th>
                <th class="col-md-2"  style="text-align:right">Total Price</th>
              </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
            <tfoot id="tfoot">
                
            </tfoot>
        </table>
      </div>
    </div>
</div>

@endsection