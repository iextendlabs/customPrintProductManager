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
                    <h3 class="card-title">Add Product</h3><br>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <form action="addProduct" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" placeholder="Entry Name" id="input-name" value="{{ old('name') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('name'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-drive-link">Drive Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="drive_link"  placeholder="Entry Drive Link" id="input-drive-link" value="{{ old('drive_link') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('drive_link'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sku">SKU</label>
                        <div class="col-sm-10">
                          <input type="text" name="sku" placeholder="Entry SKU" id="input-sku" value="{{ old('sku') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('sku'){{ $message }}@enderror</span>
                        </div>
                      </div><br>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="input-daraz">Daraz</label>
                        <div class="col-sm-10">
                          <div class="form-check form-switch form-switch-lg">
                            <h3><input type="checkbox" name="daraz" value="1" id="input-daraz" class="form-check-input"/></h3>
                          </div>
                        </div>
                      </div><br>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="input-decorguys">Decorguys</label>
                        <div class="col-sm-10">
                          <div class="form-check form-switch form-switch-lg">
                            <h3><input type="checkbox" name="decorguys" value="1" id="input-decorguys" class="form-check-input"/></h3>
                          </div>
                        </div>
                      </div><br>
                      <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="input-carstickers">Carstickers</label>
                        <div class="col-sm-10">
                          <div class="form-check form-switch form-switch-lg">
                            <h3><input type="checkbox" name="carstickers" value="1" id="input-carstickers" class="form-check-input"/></h3>
                          </div>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image">Image</label>
                        <div class="col-sm-10">
                          <input type="file" name="image" id="input-image" value="{{ old('image') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('image'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-artcut-file">ArtCut File</label>
                        <div class="col-sm-10">
                          <input type="file" name="artcut_file" id="input-artcut-file" value="{{ old('artcut_file') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('artcut_file'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-other-artcut-file">Other ArtCut File</label>
                        <div class="col-sm-10">
                          <input type="file" name="other_artcut_file" id="input-other-artcut-file" value="{{ old('other_artcut_file') }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('other_artcut_file'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <button type="submit" form="form-product" data-toggle="tooltip" title="Save" class="badge badge-outline-success">Save</button>
                      <a href="{{url('/')}}"><button type="button" data-toggle="tooltip" title="Cancel" class="badge badge-outline-warning">Cancel</button></a>
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