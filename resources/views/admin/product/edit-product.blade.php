@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Edit Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Product</li>
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
          <div class="col-md-6">
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
                     <a href=" {{route('supplier.list')}} " class="btn btn-warning btn-sm"> <i class="fa fa-list" ></i> Customer List</a>
                  </div>
              </div>
              <div class="card-body">
                <form id="quickForm" action="{{route('product.update',$editProduct->id)}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Supplier Name</label>
                        <select class="form-control" name="supplier_id" id="">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" {{($editProduct->supplier_id == $supplier->id)?'selected':''}} >{{$supplier->name}}</option>
                            @endforeach
                        </select>
                        <font id="error">{{($errors->has('supplier_id'))?($errors->first('supplier_id')):''}}</font>
                    </div>
    
                    <div class="form-group">
                        <label for="">Category</label>
                        <select class="form-control" name="category_id" id="">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{($editProduct->category_id == $category->id)?'selected':''}} >{{$category->name}}</option>
                            @endforeach
                        </select>
                        <font id="error">{{($errors->has('category_id'))?($errors->first('category_id')):''}}</font>
                    </div>
    
                    <div class="form-group">
                        <label for="">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{$editProduct->name}}">
                        <font id="error">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                    </div>
    
                    <div class="form-group">
                        <label for="">Unit</label>
                        <select class="form-control" name="unit_id" id="">
                            @foreach ($units as $unit)
                                <option value="{{$unit->id}}" {{($editProduct->unit_id == $unit->id)?'selected':''}} >{{$unit->name}}</option>
                            @endforeach
                        </select>
                        <font id="error">{{($errors->has('unit_id'))?($errors->first('unit_id')):''}}</font>
                    </div>
    
                    <div class="form-group col-md-12 pull-left mt-2">
                        <input type="submit" value="Submit" class="btn btn-primary" >
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