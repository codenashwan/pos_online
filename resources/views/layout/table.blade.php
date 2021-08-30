<table class="table table-white mt-5 table-hover table-responsive-sm table-borderless radius-20">
    <thead>
      <tr  class="text-center">
        <th scope="col">Cashier</th>
        <th scope="col">Barcode</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Price At</th>
        <th>EXPIRE DATE</th>
        <th>CREATED AT</th>
        <th>SOLD AT</th>
        <th>Piece</th>
        @if(Request::segment(1) != 'sellers')
        <th>Undo</th>
        @endif
      </tr>
    </thead>
    <tbody>
        @foreach ($solds as $sold)
        <tr class="text-center">
        <th>{{$sold->chashier->name}}</th>
        <td>
          @if($sold->one_stock->type  == 0)
            {!!DNS1D::getBarcodeSVG("$sold->stock_id", 'EAN13' , 1,24 , 'dark', false)!!}
            @else
            {!!DNS2D::getBarcodeSVG("$sold->stock_id", 'QRCODE' , 1,1)!!}
            @endif
        </td>
        <td>{{$sold->one_stock->name}}</td>
        <td>{{number_format($sold->one_stock->price , 0 , '.' , '.')}} IQD</td>
        <td>{{number_format($sold->price_at , 0 , '.' , '.')}} IQD</td>
        <td>{{$sold->one_stock->expire_date}}</td>
        <td>{{$sold->one_stock->created_at}}</td>
        <td>{{$sold->created_at}}</td>
        <td class="bg-darker text-white border border-white">{{$sold->piece}}</td>
        @if(Request::segment(1) != 'sellers')
      <td class="bg-danger text-white border border-white" onclick="undo(`{{$sold->id}}`)"><i class="ion-arrow-return-left"></i></td>
        @endif
      </tr>
      @endforeach
    </tbody>
  </table>
