@extends('WF_Collection.layouts.master_web1')

@section('title')
  Produk Peckages
@endsection

@section('css')

@endsection

@section('section')

  <div class="content-wrapper" style="min-height: 1416.81px;">


    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-4">
              {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
              <h2>Produk All</h2>

          </div>
          <div class="col-sm-4">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <button type="button" class="btn btn-outline-secondary">1</button>
              <button type="button" class="btn btn-outline-secondary">2</button>

              <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="#">Dropdown link</a>
                  <a class="dropdown-item" href="#">Dropdown link</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section>
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample10" aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample10">
            <ul class="navbar-nav">
              <li class="nav-item active">
                <a class="nav-link" href="#">Centered nav only <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown10">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </section>

    <div class="content">

      <div class="row mb-3">
        <div class="col-sm-6 col-lg-9 themed-grid-col">

          <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Produk </h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body" style="display: block;">
            <div class="row">
              <div class="col-md-12">
                <form action="{{ route('addToCart') }}" method="POST">
                  @csrf
                  <div class="row">
                    @forelse ($produk as $row)
                      <div class="col-md-3">
                        <div class="card mb-3 shadow-sm text-center" >
                          <img src="{{ asset('uploads/'.$row->gambar_produk) }}"  style="width:400px;height:250px;" class="img-thumbnail" alt="...">
                          {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}
                          <div class="card-body">
                            <h4><span style="color:blue;font-weight:bold">@rupiah($row->harga)</span></h4>
                            <p class="card-text">{{ $row->nama_produk}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                              <div class="btn-group">
                                {{-- <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
                                <a href="{{ url('/produks/'. $row->kd_produk) }}" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"> View</i></a>
                              </div>
                              <small class="text-muted">{{ $row->created_at->diffforHumans()}}</small>
                            </div>
                          </div>
                        </div>
                      </div>
                    @empty
                      <div class="col-md-9">
                          <h3 class="text-center">Tidak ada produk</h3>
                      </div>
                    @endforelse
                  </div>
                </form>
              </div>
              <!-- /.col -->
            </div>
            {{ $produk->links() }}
          </div>
        </div>

        </div>

        <div class="col-6 col-lg-3 themed-grid-col">

          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Category</h3>
              </div>
              <div class="card-body">
                <div class="panel panel-default">
                   <div class="panel-heading">
                     @if (!empty($kategories))

                       @foreach ($kategories as $kat)
                         <h5 class="panel-title" >
                           <a class="text-secondary" href="{{ url('/kategories/'. $kat->slug)}} ">{{ $kat->kategori }}</a>
                         </h5>
                               @foreach ($kat->child as $child)
                                 <ul class="list" >
                                   <li>
                                     <a class="text-secondary" href="{{ url('/kategories/'. $child->slug) }}">{{ $child->kategori }}</a>
                                   </li>
                                 </ul>
                               @endforeach

                       @endforeach
                     @endif
                   </div>
                 </div>
                    <!-- /input-group -->
            </div>
                  <!-- /.card-body -->
          </div>

          <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Produk Terlaris</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Text</label>
                        <input type="text" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Text Disabled</label>
                        <input type="text" class="form-control" placeholder="Enter ..." disabled="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <!-- textarea -->
                      <div class="form-group">
                        <label>Textarea</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Textarea Disabled</label>
                        <textarea class="form-control" rows="3" placeholder="Enter ..." disabled=""></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- input states -->
                  <div class="form-group">
                    <label class="col-form-label" for="inputSuccess"><i class="fas fa-check"></i> Input with
                      success</label>
                    <input type="text" class="form-control is-valid" id="inputSuccess" placeholder="Enter ...">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputWarning"><i class="far fa-bell"></i> Input with
                      warning</label>
                    <input type="text" class="form-control is-warning" id="inputWarning" placeholder="Enter ...">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label" for="inputError"><i class="far fa-times-circle"></i> Input with
                      error</label>
                    <input type="text" class="form-control is-invalid" id="inputError" placeholder="Enter ...">
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- checkbox -->
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <label class="form-check-label">Checkbox</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <label class="form-check-label">Checkbox checked</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" disabled="">
                          <label class="form-check-label">Checkbox disabled</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <!-- radio -->
                      <div class="form-group">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1">
                          <label class="form-check-label">Radio</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="radio1" checked="">
                          <label class="form-check-label">Radio checked</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" disabled="">
                          <label class="form-check-label">Radio disabled</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>Select</label>
                        <select class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Disabled</label>
                        <select class="form-control" disabled="">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <!-- Select multiple-->
                      <div class="form-group">
                        <label>Select Multiple</label>
                        <select multiple="" class="form-control">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Select Multiple Disabled</label>
                        <select multiple="" class="form-control" disabled="">
                          <option>option 1</option>
                          <option>option 2</option>
                          <option>option 3</option>
                          <option>option 4</option>
                          <option>option 5</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>

        </div>
      </div>

    </div>

  </div>

@endsection

@section('script')

@endsection
