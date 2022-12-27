<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include('header')
    <style>
    .zoomIn {
        top: 16px;
    }
    .zoomOut {
        top: 45px;
    }
    .zoom{
        position: absolute;
        left: 20px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        background: #000000;
        padding: 0px 7px;
        color: white;
        cursor: pointer;
        line-height: 20px;
        text-align: center;
    }
    a{
        color: white;
    }

    .card1{
      display: inline;
      padding: 20px;
    }
    </style>
  </head>
  <body>
    <div class="container-scroller">
    @include('navigation')
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="row ">
                <div class="card1">
                  <a href="{{url('/downloadInvoice',$order->invoice)}}"><div class="badge badge-outline-primary">Download Invoice</div></a>                
                  <a href="{{url('updateOrder/' . $order->id . '/' . 1 .'')}}"><div class="badge badge-outline-success">Mark As Delivered</div></a>                
                  <a href="{{url('updateOrder/' . $order->id . '/' . 0 .'')}}"><div class="badge badge-outline-warning">Mark As Padding</div></a>                
                  <a href="{{url('orderList/')}}"><div class="badge badge-outline-primary">Back</div></a>                
                </div>
            </div>
            <div class="row ">
              <div class="col-8 grid-margin">
                <div class="card">
                  <img id="pic" src="orderImage/{{$order->image}}" alt="image" height="auto" width="100%"/>   
                  <div class="zoomIn zoom">+</div>
                  <div class="zoomOut zoom">−</div>                
                </div>
              </div>
            </div>
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iExtendLabs.com 2021</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @include('footer')
    </body>
    <script>
        $(document).ready(function(){
            $(".zoomIn").click(function(){
                var pic = document.getElementById("pic");
                var width = pic.clientWidth;
                pic.style.width = width + 100 + "px";
            });
        });
        $(document).ready(function(){
            $(".zoomOut").click(function(){
                var pic = document.getElementById("pic");
                var width = pic.clientWidth;
                pic.style.width = width - 100 + "px";
            });
        });
    </script>
</html>