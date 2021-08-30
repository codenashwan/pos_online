@extends('layout.nav')
@section('content')


<div class="row m-3 justify-content-center">


    <div class="col-lg-4 col-12 text-center">
        <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
        <br>
        <span class="text-center mt-3 mb-3 text-white">Barcode : <b id="barcode"></b></span>
        <br>
        <span class="notify text-center mt-3 mb-3 text-danger"></span>
        <br>
        <button title="Play" class="btn btn-white m-2" id="play" type="button" data-toggle="tooltip">Play</button>
        <select class="form-control border-0 mt-2 mb-2" id="camera-select"></select>
    </div>


    <div class="col-lg-3 col-12 text-center invoice">

    </div>

</div>


<div class="tb"></div>






<script type="text/javascript" src="{{asset('assets/lib/qrcodelib.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/lib/webcodecamjs.js')}}"></script>
<script>
    function sound(sound) {
        var obj = document.createElement("audio");
        obj.src = "assets/audio/" + sound + ".mp3";
        obj.play();
    }

    function table() {
        $.post('viewtb', {
            _token: '{{csrf_token()}}'
        }, function (response) {
            $(".tb").html(response);
        })
    }

    
    function invoice(){
        $.post('invoice' , {
            _token: '{{csrf_token()}}'
        },  function(response){
            $(".invoice").html(response);
        })
    }


    function undo(sold_id) {
        $.post('undo', {
            sold_id: sold_id,
            _token: '{{csrf_token()}}'
        }, function (response) {
            if (response === "success") {
                table();
                invoice();
                sound('undo');
            } else {
                table();
                sound('fail');
            }
        });
    }


    (function (undefined) {
        "use strict";

        function Q(el) {
            if (typeof el === "string") {
                var els = document.querySelectorAll(el);
                return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
            }
            return el;
        }
        var play = Q("#play"),
            args = {
                resultFunction: function (res) {
                    var id = res.code;
                    $("#barcode").html(id);
                    $.post('sale', {
                        id: id,
                        _token: '{{csrf_token()}}'
                    }, function (response) {
                        if (response === "success") {
                            table();
                            invoice();
                        } else {
                            sound('fail')
                            $(".notify").html(response);
                        }
                    })
                }

            };
        var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back")
            .init(args);
        play.addEventListener("click", function () {
            decoder.play();
        }, false);

        document.querySelector("#camera-select").addEventListener("change", function () {
            if (decoder.isInitialized()) {
                decoder.stop().play();
            }
        });
    }).call(window.Page = window.Page || {});

</script>



@endsection
