@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Customer</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!--------Modal--------->
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Add Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="quickForm" action="{{route('customer.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Customer Name</label>
                    <input id="input" type="text" name="name" class="form-control" placeholder="Name">
                    <font id="error">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                </div>
                <div class="form-group">
                    <label for="">Mobile No</label>
                    <input id="input" type="text" name="phone_no" class="form-control" placeholder="Mobile No">
                    <font id="error">{{($errors->has('phone_no'))?($errors->first('phone_no')):''}}</font>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="Email">
                    <font id="error">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control" placeholder="Address">
                    <font id="error">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                </div>
                <div class="form-group col-md-12 pull-left mt-2">
                    <input type="submit" value="Submit" class="btn btn-primary" >
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!--------Modal--------->
  <div class="container">
      <div class="row">
          <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                  <div class="float-left">
                    @if (count($errors) > 0)
                    <div class="alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                  </div>
                  <div style="float: right" class="pull-right">
                     <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" > <i class="fa fa-plus" ></i> Add Customer</a>
                  </div>
              </div>
              <div class="card-body">
                <table id="mydatatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $key => $customer)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$customer->name}} </td>
                                <td> {{$customer->phone_no}} </td>
                                <td>{{$customer->email}} </td>
                                <td>{{$customer->address}} </td>
                                <td width="15%" >
                                    <a class="btn btn-outline-info btn-sm" href=" {{route('customer.edit',$customer->id)}} "> <i class="fa fa-edit" ></i> </a>
                                    <a id="delete" class="btn btn-outline-danger btn-sm" href="{{route('customer.delete',$customer->id)}}"> <i class="fa fa-trash" ></i> </a>
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
@section('script')
    

  {{-- JQUERY jquery-validation --}}
<script>
    $(function () {
    //   $.validator.setDefaults({
    //     submitHandler: function () {
    //       alert( "Form successful submitted!" );
    //     }
    //   });
      $('#quickForm').validate({
        rules: {
          email: {
            required: true,
            email: true,
          },
          name: {
            required: true,
          },
          phone_no: {
            required: true,
          },
          address: {
            required: true,
          },
    
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });
    });
</script>
@endsection