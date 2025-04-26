<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    @php
        $title = '404 Not Found'
    @endphp
    <title>{{ $title }}</title>
</head>
<style>
    *
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "poppins";
}

.page_404
{
    padding: 40px 0;
    background: #fff;
    font-family: 'Poppins';
}

.page_404 img
{
    width: 100%;
}

.four_zero_four_bg
{
    background: url('/gif/bg.gif');
    height: 400px;
    background-position: center;
}

h1
{
    font-size: 80px;
}

h3
{
    font-size: 80px;
}

a
{
    color: #fff;
    text-decoration: none;
    padding: 10px 20px;
    background: #39ac31;
    display: inline-block;
}

.content_box_404
{
    margin-top: -50px;
}
a:hover
{
    text-decoration: none;
    color: #fff;
}
</style>
<body>
   <section class="page_404">
       <div class="container">
           <div class="row">
               <div class="col-sm-12">
                   <div class="col-sm-10 col-sm-offset-1 text-center">
                       <div class="four_zero_four_bg">
                           <h1 class="text-center">404</h1>
                       </div>
                       <div class="content_box_404">
                           <h3 class="h2">Sepertinya Anda Tersesat</h3>
                           <p>Halaman yang Anda cari tidak tersedia</p>
                           <a href="#" class="btn-back" onclick="window.history.back();return false;">Kembali</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <strong class="">Copyright &copy; 2025 <a href="https://github.com/ArdianusCosta">SIS-APP</a>.</strong> All rights reserved.
   </section>
</body>
</html>