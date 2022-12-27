<!DOCTYPE html>
<html lang="en">
  <head>
    @include('header')
  </head>
  <style>
      td img{
        height: 82px !important;
        width: 82px !important;
      }
      .navbar img{
        height: 70px;
        width: 161px;
        padding-top: 12px;
      }
  </style>
  <body>
    <div class="container-scroller">
    @include('navigation')
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <a href="{{url('/orderForm')}}"><div class="badge badge-outline-primary float-end">Add</div></a>
                    <h4 class="card-title">Orders</h4>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <div class="table-responsive">
                      <table class="table"  style="text-align: center;">
                        <thead>
                          <tr>
                            <th> No </th>
                            <th> Image </th>
                            <th> Status </th>
                            <th> Date </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($orders) != 0)
                          @foreach($orders as $order)
                          <tr @if($order->checked == 0) style="background: rgba(101, 100, 100, 0.2); @endif ">
                            <td>{{ ++$i }}</td>
                            <td>
                              <img src="orderImage/{{$order->image}}" alt="image" />
                            </td>
                            <td>@if($order->status == 1) Delivered @else Padding @endif</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                              <a href="{{url('/deleteOrder',$order->id)}}"><div class="badge badge-outline-warning"> Delete</div></a>
                              <a href="{{url('/viewOrder',$order->id)}}"><div class="badge badge-outline-success">View</div></a>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan="6">No results!</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
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
</html>