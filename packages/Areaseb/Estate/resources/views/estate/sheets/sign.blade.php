<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sheet</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="baseURL" content="{{config('app.url')}}">

    <title>Firma il Foglio di visita</title>

    <link rel="stylesheet" href="{{asset('css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/colors.css')}}">

    <style>
        .w-full {
            width: 100%;
        }

        #signature {
            position: relative;
            height: 185px;
            width: 100%;
        }
        #signature-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>

</head>
<body>
    <div class="container">
        <h1>Firma il Foglio di visita</h1>
        <div class="row">
            <div class="col-12">
                <h4>Rivedi il foglio di visita generato prima di firmarlo</h4>
                <iframe class="w-full" style="height: 65vh" src="{{ route('sheets.preview', ['uuid' => $sheet->uuid]) }}" frameborder="0"></iframe>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right">
                <button type="button" class="btn btn-danger" id="open-signature-pad">Firma il documento</button>
            </div>
        </div>
    </div>

    <div class="modal" id="signature-pad-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Firma il documento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="signature">
                    <canvas id="signature-canvas"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
                    <form action="{{ route('sheets.sign', ['uuid' => $sheet->uuid]) }}" method="POST" id="sign-form">
                        @csrf
                        <input type="hidden" name="sign" value="" id="sign-input" />
                        <button type="button" class="btn btn-danger" id="sign">Firma</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/all.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

    <script>
        let signaturePad

        function initSignaturePad() {
            let signature = document.getElementById('signature-canvas')
            signaturePad = new SignaturePad(signature, {
                backgroundColor: 'rgb(224,224,224)'
            })

            // resize fix
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio =  Math.max(window.devicePixelRatio || 1, 1);

            // This part causes the canvas to be cleared
            signature.width = signature.offsetWidth * ratio;
            signature.height = signature.offsetHeight * ratio;
            signature.getContext("2d").scale(ratio, ratio);

            // This library does not listen for canvas changes, so after the canvas is automatically
            // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
            // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
            // that the state of this library is consistent with visual state of the canvas, you
            // have to clear it manually.
            signaturePad.clear();
        }

        $('#open-signature-pad').on('click', function () {
            $('#signature-pad-modal').modal('show')
            initSignaturePad()
        })

        $('#sign').on('click', function (e) {
            e.preventDefault()
            let image = signaturePad.toDataURL("image/jpeg")
            $('#sign-input').val(image)
            $('#sign-form').submit()
        })

    </script>
</body>
</html>
