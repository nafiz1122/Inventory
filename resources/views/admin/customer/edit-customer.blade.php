@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Customer</h1>
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
                     <a href=" {{route('supplier.list')}} " class="btn btn-primary btn-sm"> <i class="fa fa-list" ></i> Customer List</a>
                  </div>
              </div>
              <div class="card-body">
                <form id="quickForm" action="{{route('customer.update',$customer->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Customer Name</label>
                        <input id="input" type="text" name="name" class="form-control" value=" {{$customer->name}} ">
                        <font id="error">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                    </div>
                    <div class="form-group">
                        <label for="">Mobile No</label>
                        <input id="input" type="text" name="phone_no" class="form-control" value=" {{$customer->phone_no}} ">
                        <font id="error">{{($errors->has('phone_no'))?($errors->first('phone_no')):''}}</font>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control"value="{{$customer->email}}">
                        <font id="error">{{($errors->has('email'))?($errors->first('email')):''}}</font>
                    </div>
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" name="address" class="form-control" value=" {{$customer->address}} ">
                        <font id="error">{{($errors->has('address'))?($errors->first('address')):''}}</font>
                    </div>
                    <div class="form-group col-md-12 pull-left mt-2">
                        <input type="submit" value="Update" class="btn btn-success" >
                    </div>
                </form>
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