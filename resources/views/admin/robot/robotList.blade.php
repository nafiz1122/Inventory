@extends('layouts.admin_master')
@section('content')
<!---Model--->
<!-- Button trigger modal -->

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('robot.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input name="name" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input name="email" type="text" class="form-control" >
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input name="phone" type="text" class="form-control" >
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
<!---Model--->




<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Robot</h3>
                    <!----Errors-------->
                    <div class="col-md-6">
                        @if (count($errors) > 0)
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                        @endif
                    </div>
                        
                  
                    <!----Errors-------->
                    @if(Session::has('message'))
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif

                    
                    <div class="float-right">
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" > <i class="fa fa-plus" ></i> Add Robot</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table" >
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($robot as $key => $item)          
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{$item->name}} </td>
                                    <td> {{$item->email}} </td>
                                    <td> {{$item->phone}} </td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> </a>
                                        <a href="" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection


