@extends('layouts.main')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-12">
            <h1 class="m-0 text-center">Tanda Tangan Elektronik</h1>
        </div>
    </div>
</div>

<style>
  .btn-outline-indigo {
    color: #fff !important;
    background-color: #6610f2 !important;
  }

  .btn-outline-indigo:hover {
      background-color: #5101d2 !important;
      color: #fff !important;
  }

  .btn-pink {
      background-color: #F7A5A5 !important;
      color: #fff !important;
  }

  .btn-pink:hover {
      background-color: #ff8a8a !important;
      color: #fff !important;
  }

  .btn-gelap{
    background-color: #FF714B;
    color: #fff;
  }
  .btn-gelap:hover{
    background-color: #ff5f32;
    color: #fff;
  }
  .btn-save{
    background-color: #6a2424;
    color: #fff;
  }

  .btn-save:hover{
    background-color: #512323;
    color: #fff;
  }
</style>
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<div class="d-flex justify-content-center">
    <form action="{{ route('ttd-electronik.store') }}" method="POST" class="text-center">
        @csrf
        <div class="mb-3">
            <canvas id="signature-pad" 
                    width="600" 
                    height="300" 
                    style="border:1px solid #000; border-radius: 5px; background:#fff;">
            </canvas>

            <div class="mt-3">
                <button type="button" id="clear" class="btn btn-danger btn-sm">Clear</button>
                <button type="button" id="undo" class="btn btn-warning btn-sm">Undo</button>
                <button type="button" id="redo" class="btn btn-secondary btn-sm">Redo</button>
                <button type="button" id="color" class="btn btn-info btn-sm">Change Color</button>
                <button type="button" id="background-color" class="btn btn-pink btn-sm">Change Background Color</button>
            </div>

            <div class="mt-3">
                <button type="button" id="save-png" class="btn btn-success btn-sm">Save as PNG</button>
                <button type="button" id="save-jpg" class="btn btn-primary btn-sm">Save as JPG</button>
                <button type="button" id="save-svg" class="btn btn-save btn-sm">Save as SVG</button>
                <button type="button" id="width" class="btn btn-dark btn-sm">Change Width</button>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-gelap">Simpan ke Server</button>
            </div>

            <div class="mt-3">
                <button type="button" id="open-window" class="btn btn-outline-indigo btn-sm">Open in Window</button>
            </div>

            <input type="hidden" name="signature" id="signature">
        </div>
    </form>
</div>

<script>
    const canvas = document.getElementById('signature-pad');
    const ctx = canvas.getContext('2d');
    const signaturePad = new SignaturePad(canvas);

    setCanvasBackground('#fff');

    function setCanvasBackground(color) {
        ctx.fillStyle = color;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        signaturePad.clear(); 
    }

    document.getElementById('clear').addEventListener('click', () => signaturePad.clear());

    document.getElementById('undo').addEventListener('click', () => {
        const data = signaturePad.toData();
        if (data) {
            data.pop();
            signaturePad.fromData(data);
        }
    });

    let history = [];
    signaturePad.onEnd = () => {
        history.push(signaturePad.toData());
    };
    document.getElementById('redo').addEventListener('click', () => {
        if (history.length > 0) {
            signaturePad.fromData(history[history.length - 1]);
        }
    });

    document.getElementById('color').addEventListener('click', () => {
        const r = Math.round(Math.random() * 255);
        const g = Math.round(Math.random() * 255);
        const b = Math.round(Math.random() * 255);
        signaturePad.penColor = `rgb(${r},${g},${b})`;
    });

    document.getElementById('background-color').addEventListener('click', () => {
        const r = Math.round(Math.random() * 255);
        const g = Math.round(Math.random() * 255);
        const b = Math.round(Math.random() * 255);
        const color = `rgb(${r},${g},${b})`;
        setCanvasBackground(color);
    });

    document.getElementById('width').addEventListener('click', () => {
        const min = Math.floor(Math.random() * 5) + 1;
        const max = min + Math.floor(Math.random() * 5) + 2;
        signaturePad.minWidth = min;
        signaturePad.maxWidth = max;
        alert(`Width set ke min:${min}, max:${max}`);
    });

    document.getElementById('save-png').addEventListener('click', () => saveSignature("image/png", "signature.png"));

    document.getElementById('save-jpg').addEventListener('click', () => saveSignature("image/jpeg", "signature.jpg"));

    document.getElementById('save-svg').addEventListener('click', () => saveSignature("image/svg+xml", "signature.svg"));

    function saveSignature(type, filename) {
        if (!signaturePad.isEmpty()) {
            const dataURL = signaturePad.toDataURL(type);
            download(dataURL, filename);
        } else {
            alert("Tanda tangan masih kosong!");
        }
    }

    function download(dataURL, filename) {
        const a = document.createElement("a");
        a.href = dataURL;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    document.querySelector('form').addEventListener('submit', function () {
        if (!signaturePad.isEmpty()) {
            document.getElementById('signature').value = signaturePad.toDataURL();
        }
    });

    document.getElementById('open-window').addEventListener('click', () => {
        if (!signaturePad.isEmpty()) {
            const dataURL = signaturePad.toDataURL("image/png");
            const win = window.open("", "_blank", "width=700,height=500");
            win.document.write('<title>Preview Tanda Tangan</title>');
            win.document.write('<body style="text-align:center; background:#f4f4f4; margin:0; padding:20px;">');
            win.document.write('<img src="' + dataURL + '" style="max-width:100%; border:1px solid #000; border-radius:5px;"/>');
            win.document.write('</body>');
        } else {
            alert("Tanda tangan masih kosong!");
        }
    });
</script>
@endsection
