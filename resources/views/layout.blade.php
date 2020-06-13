<!DOCTYPE html>
<html lang="en">
<head>
  <title>Liquor Store</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <style>
    body{
      /* margin-left: 2%;
      margin-right:2%; */
      color: green;
      
    }
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 0px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin: 0;
      padding: 0;
      /* background-image: url('images/jumboimg2.jpg'); */
      /* color: white; */
      font-family: 'Wide Latin';
      font-style: italic;
      /* top: 0;
      position: fixed;
      width: 100%; */
      
    }

    .jumbotron a{
      /* color : white; */
    }
   
    /* Add a gray background color and some padding to the footer */
    
    .footer {
     /* position: fixed;
      left: 0;
      bottom: 0; */
      
      padding: 25px;
      margin-top: 20px; 
      background-color: #f2f2f2;
      width: 100%;
    }

    nav{
      top: 240;
      position: fixed;
      width: 100%;
    }

    
    .panel-body{
      height:270px
    }
    .loginregisterbody{
      height: auto;
    }
    .panel:hover {
      /* transform: scale(1.09);  */
      box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
    }

    a,a:hover{
      color: green;
      text-decoration: none;
    }

    .mainbody{
      padding: 0px;
      margin-right:25px;
      margin-left:25px;
      width: auto;
      height: 700px;
    }

    .panel-heading{
      font-size: 12px;
      /* font-size: 1vw; */
    }
    span strong{
      color: red;
    }

    

  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    
    <h1><a href="{{url('/')}}"><img src="{{ URL::to('/images/himalaya-indian-cuisine-logo.jpg') }}"/></a></h1>     
    {{-- <p>Liquor, Liquor & Liquor</p> --}}
  </div>
</div>

<nav class="navbar navbar-inverse" id="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="{{url('/')}}"><img height="20px" src="{{ URL::to('/images/l1.jpg') }}"/></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" >Products
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{url('items/1')}}">Chicken</a></li>
              <li><a href="{{url('items/2')}}">Lamb</a></li>
              <li><a href="{{url('items/3')}}">Beef</a></li>
            </ul>
        </li>
        {{-- <li><a href="#">Deals</a></li>
        <li><a href="#">Stores</a></li> --}}
        <li><a href="{{url('contact')}}">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <form class="navbar-form navbar-left" method="POST" action="{{url('showsearch')}}">
            {{ csrf_field() }}
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search" id="search" name="search">
              <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                  <i class="glyphicon glyphicon-search"></i>
                </button>
              </div>
            </div>
          </form>
        </li>
        @if(Auth::check())
        
          
          {{-- <li><a href=""><span class="glyphicon glyphicon-user"></span>{{ Auth::user()->name }}</a></li> --}}
      <li><a href="{{url('showcart/'.Auth::user()->id)}}"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a>
      {{-- <span class="badge badge-light">{{ Cart()->notifications->count() }}</span> --}}
      </li>
      <li><a href="{{url('showorder/'.Auth::user()->id)}}"><span class="glyphicon glyphicon-shopping-cart"></span> Order</a></li>
        <li><a href="{{url('logout')}}"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
        @else
        <li><a href="{{url('login')}}"><span class="glyphicon glyphicon-user"></span>Login</a></li>
        <li><a href="{{url('register')}}"><span class="glyphicon glyphicon-user"></span>Register</a></li>
        
        @endif
        
      </ul>
    </div>
    
  </div>
</nav>

<div class="container mainbody">    
  @yield('content')
</div>


<div class="text-center footer">
  <p>Liquor Store Copyright</p>  
    {{-- <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button> --}}
  </form> 
  <p></p>  
</div> 



</body>
</html>
<script>
  $(document).ready(function() {

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

  //error message
  // $(".alert").fadeOut(5000);

  //item details
  $(".itemdetail").click(function(){
      $id = $(this).find('.hidden').html();
      debugger;
      // alert($id);
      event.preventDefault();
      $.ajax({
          url:"{{ url('showitem') }}" + "/" + $id,
          method: "GET",
          contentType: false,
          dataType: "json",
          success:function(data){
              $('.modal-title').html('');
              $('.itemimage').html('');
              $('.itemdescription').html('');
                  $('.modal-title').append(data.name);
                  $('.itemimage').append('<img src="{{ URL::to('/images/') }}'+'/'+data.image+'" class="img-responsive"  alt="Image">' );
                  $('.itemdescription').append('<b><h3>'+data.description+'</h3></b>');
                  debugger;
          },
          error: function(xhr, textStatus, error){
              console.log(xhr.statusText);
              console.log(textStatus);
              console.log(error);
          }
      })
  });

  //for onload order page
    $sum=0;
    var selectedDate = $('.sopclass').children("option:selected").val();
    // alert("You have selected the option - " + selectedDate);
    // event.preventDefault();
    $.ajax({
        url:"{{ url('ajaxshow') }}" + "/" +selectedDate,
        method: "GET",
        // data: {selectedCountry },
        contentType: false,
        dataType: "json",
        success:function(data){
            // alert(data);
            $('#tbody').html('');
            $('#tfoot').html('');
            data.forEach(element => {
                $sum = $sum + element.tprice;
                $('#tbody').append('<tr><td>'+element.pname+'</td><td>$'+element.price+'.00</td><td style="text-align:center">'+element.quantity+'</td><td style="text-align:right">$'+element.tprice+'.00</td></tr>');
            });
            // alert($sum);
            $('#tfoot').append('<tr><td><b>Total</b></td><td></td><td></td><td style="text-align:right"><b>$'+$sum+'.00</b></td></tr>');
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }

    });

    //show order details  
  $(".sopclass").change(function(){
    $sum=0;
    var selectedDate = $(this).children("option:selected").val();
    // alert("You have selected the option - " + selectedDate);
    event.preventDefault();
    $.ajax({
        url:"{{ url('ajaxshow') }}" + "/" +selectedDate,
        method: "GET",
        // data: {selectedCountry },
        contentType: false,
        dataType: "json",
        success:function(data){
            // alert(data);
            $('#tbody').html('');
            $('#tfoot').html('');
            data.forEach(element => {
                $sum = $sum + element.tprice;
                $('#tbody').append('<tr><td>'+element.pname+'</td><td>$'+element.price+'.00</td><td style="text-align:center">'+element.quantity+'</td><td style="text-align:right">$'+element.tprice+'.00</td></tr>');
            });
            // alert($sum);
            $('#tfoot').append('<tr><td><b>Total</b></td><td></td><td></td><td style="text-align:right"><b>$'+$sum+'.00</b></td></tr>');
        },
        error: function(xhr, textStatus, error){
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
        }
    })
  });
});
  </script>