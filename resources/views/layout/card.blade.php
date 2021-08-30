<div class="row justify-content-center m-2">
    @foreach ($stocks as $stock)
    <div class="card m-2 radius-20 text-center" style="width: 18rem;">

        <div class="mt-5" style="min-height:50px">
            @if($stock->type  == 0)
            {!!DNS1D::getBarcodeSVG("$stock->id", 'C128',1,53)!!}
            @else
            {!!DNS2D::getBarcodeSVG("$stock->id", 'QRCODE')!!}
            @endif
        </div>
        <div class="card-body text-left">
            @if($stock->is_debt == 1)
            <span class="btn btn-warning btn-sm m-2 radius-20" style="position: absolute;top:0;left:0">Debt !</span>
            @endif
            <small class="card-title">Barcode : {{$stock->id}}</small><br>
            <small class="card-title">Name : {{$stock->name}}</small><br>
            <small class="card-title">Supplier : {{$stock->one_supplier->company_name}}</small><br>
            <small class="card-title">Count : {{$stock->count}}</small><br>
            <small class="card-title">Price : {{number_format($stock->price , 0 , '.' , '.')}} IQD</small><br>
            <small class="card-title">Expire : {{$stock->expire_date}}</small><br>
            <small class="card-title">Create At : {{$stock->created_at}}</small><br>
            <span class="btn btn-primary btn-sm mt-3" data-toggle="modal"
                data-target="#edit{{$stock->id}}">Edit</span>
            <span class="btn btn-danger btn-sm mt-3" data-toggle="modal"
                data-target="#delete{{$stock->id}}">Delete</span>
            <!-- Modal Delete -->
            <div class="modal fade" id="delete{{$stock->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <span>Do You Want To Delete {{$stock->name}}</span>

                            <form action="buy/1/{{$stock->id}}" method="POST">
                                @csrf
                                <button class="btn btn-danger w-100 mt-4 radius-20">Yes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Edit -->
            <div class="modal fade" id="edit{{$stock->id}}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="buy/2/{{$stock->id}}" method="POST">
                                @csrf
                                <div class="row m-2 justify-content-center">
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Barcode Stock</label>
                                        <input name="id" type="text" placeholder="Barcode Stock"
                                            class="form-control radius-20" value="{{$stock->id}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Name Stock</label>
                                        <input name="name" type="text" placeholder="Name Supplier"
                                            class="form-control radius-20" value="{{$stock->name}}" required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Supplier</label>
                                        <select name="supplier_id" class="form-control radius-20" required>
                                            <option value="{{$stock->supplier_id}}">
                                                {{$stock->one_supplier->company_name}}</option>
                                            @foreach ($suppliers as $supplier)
                                            <option value="{{$supplier->id}}">{{$supplier->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Count Stock</label>
                                        <input name="count" type="text" placeholder="Count"
                                            class="form-control radius-20" value="{{$stock->count}}" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Price</label>
                                        <input name="price" type="text" placeholder="Price"
                                            value="{{$stock->price}}" class="form-control radius-20" required>
                                    </div>
                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Expire</label>
                                        <input name="expire_date" type="date" class="form-control radius-20"
                                            required>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">is Debt?</label>
                                        <select name="is_debt" class="form-control radius-20" required>
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>

                                    <div class="col text-center  col-12 mt-3">
                                        <label class="text-darker">Type</label>
                                        <select name="type" class="form-control radius-20" required>
                                            <option value="0">Barcode</option>
                                            <option value="1">Qrcode</option>
                                        </select>
                                    </div>
                                </div>
                                <button class="btn btn-primary radius-20 mt-3 w-25">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>