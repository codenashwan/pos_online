@extends('layout.nav')
@section('content')
<div class="container">
    <br>
    @if($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach
    @endif
    @if(session('result'))
    <div class="alert alert-warning">{{session('result')}}</div>
    @endif
    <form action="cashier" method="POST" class="text-center">
        @csrf
        <div class="row m-5 justify-content-center">

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Name Cashier</label>
                <input name="name" type="text" placeholder="Name Cashier" class="form-control radius-20 border-0" required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Email Cashier</label>
                <input name="email" type="email" placeholder="Email Cashier" class="form-control radius-20 border-0" required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Password Cashier</label>
                <input name="password" type="password" placeholder="Password Cashier"
                    class="form-control radius-20 border-0" required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Rule Cashier</label>
                <select name="rule" class="form-control radius-20 border-0" required>
                    <option value="0">Cashier</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
        <button class="btn btn-white radius-20 mt-3 w-50">Submit</button>
    </form>
    <hr>

    <div class="row justify-content-center">
        @foreach ($cashiers as $cashier)
            <div class="card text-center radius-20 m-2" style="width: 18rem;">
            <i class="ion-person text-success" style="font-size: 100px"></i>
            <div class="card-body">
            <small class="card-title">Name : {{$cashier->name}}</small><br>
            <small class="card-title">Email : {{$cashier->email}}</small><br>
            <small class="card-title">Rule : {{$cashier->rule == 1 ? "Admin" : "Cashier"}}</small><br>
            </div>
        </div>
        @endforeach
    </div>


</div>
@endsection
