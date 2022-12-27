<!DOCTYPE html>
<html lang="en">
  <head>
    @include('header')
  </head>
<body>
  <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <div class="card-body">
                  <a href="{{url('/')}}"><div class="badge badge-outline-primary float-end">Home</div></a>
                    <h3 class="card-title">Order</h3><br>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <form action="addOrder" method="post" enctype="multipart/form-data" id="form-order" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="image" id="input-image" value="{{ old('image') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('image'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-invoice">Invoice</label>
                        <div class="col-sm-10">
                          <input type="file" name="invoice" id="input-invoice" value="{{ old('invoice') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('invoice'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-note">Note</label>
                        <div class="col-sm-10">
                          <textarea name="note" id="input-note" placeholder="Entry Note" cols="30" rows="10" class="form-control">{{ old('note') }}</textarea>
                          <span style="color: #f44336 !important;">@error('note'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <button type="submit" form="form-order" data-toggle="tooltip" title="Save" class="badge badge-outline-success">Save</button>
                      <a href="{{url('/orderList')}}"><button type="button" data-toggle="tooltip" title="Cancel" class="badge badge-outline-warning">Cancel</button></a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iExtendLabs.com 2022</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @include('footer')
  </body>
</html>