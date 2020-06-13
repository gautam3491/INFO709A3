<!--contact page-->
@extends('layout')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-8">
            @if(session('success'))
                <div class="alert alert-success">
                    <strong>Great!</strong> {{session('success')}}
                </div>
            @endif
            <div class="well well-sm">
            <form method="post" action="{{url('addcontact')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required="required" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">
                                Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                </span>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="required" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone">
                                Phone</label>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span>
                                </span>
                                <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone" required="required" />
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">
                                Message</label>
                            <textarea name="message" id="message" name="message" class="form-control" rows="9" cols="25" required="required"
                                placeholder="Message"></textarea>
                                @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary pull-right" id="btnContactUs">
                            Send Message</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <form>
            <legend><span class="glyphicon glyphicon-globe"></span> Our office</legend>
            <address>
                <strong>Food, Inc.</strong><br>
                10 O Neill St, Claudelands 3214<br>
                Hamilton, New Zealand<br>
                <abbr title="Phone">
                    </abbr>
                (021) 073-0647
            </address>
            <address>
                <strong>Gautam Shrestha</strong><br>
                <a href="mailto:#">gaushr10@student.wintec.ac.nz</a>
            </address>
            </form>
        </div>
    </div>
</div>
@endsection