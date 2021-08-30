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
    <form action="buy/0/0" method="POST" class="text-center">
        @csrf
        <div class="row m-5 justify-content-center">

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Barcode Stocks</label>
                <input name="id" type="text" placeholder="Code Barcode" class="form-control radius-20 border-0"
                    required>
            </div>


            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Name Stocks</label>
                <input name="name" type="text" placeholder="Name Stocks" class="form-control radius-20 border-0"
                    required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Supplier</label>
                <select name="supplier_id" class="form-control radius-20 border-0" required>
                    @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Count Stocks</label>
                <input name="count" type="number" placeholder="Count Stocks" class="form-control radius-20 border-0"
                    required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Price Stocks</label>
                <input name="price" type="number" placeholder="Price Stocks" class="form-control radius-20 border-0"
                    required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Expire Stocks</label>
                <input name="expire_date" type="date" class="form-control radius-20 border-0" required>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">is Debt?</label>
                <select name="is_debt" class="form-control radius-20 border-0" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>

            <div class="col text-center col-lg-4 col-12 mt-3">
                <label class="text-white">Type</label>
                <select name="type" class="form-control radius-20 border-0" required>
                    <option value="0">Barcode</option>
                    <option value="1">Qrcode</option>
                </select>
            </div>

        </div>
        <button class="btn btn-white radius-20 mt-3 w-25">Submit</button>
    </form>
    <hr>


    @include('layout.card')


    <div class="d-flex justify-content-center mt-4">
        {{$stocks->links()}}
    </div>
</div>







@endsection
