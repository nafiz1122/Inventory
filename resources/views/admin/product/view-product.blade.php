@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Product</h1>
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
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="quickForm" action="{{route('product.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Supplier Name</label>
                    <select class="form-control" name="supplier_id" id="">
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value=" {{$supplier->id}} ">{{$supplier->name}}</option>
                        @endforeach
                    </select>
                    <font id="error">{{($errors->has('supplier_id'))?($errors->first('supplier_id')):''}}</font>
                </div>

                <div class="form-group">
                    <label for="">Category</label>
                    <select class="form-control" name="category_id" id="">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value=" {{$category->id}} ">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <font id="error">{{($errors->has('category_id'))?($errors->first('category_id')):''}}</font>
                </div>

                <div class="form-group">
                    <label for="">Product Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                    <font id="error">{{($errors->has('name'))?($errors->first('name')):''}}</font>
                </div>

                <div class="form-group">
                    <label for="">Unit</label>
                    <select class="form-control" name="unit_id" id="">
                        <option value="">Select Unit</option>
                        @foreach ($units as $unit)
                            <option value=" {{$unit->id}} ">{{$unit->name}}</option>
                        @endforeach
                    </select>
                    <font id="error">{{($errors->has('unit_id'))?($errors->first('unit_id')):''}}</font>
                </div>

                <div class="form-group col-md-12 pull-left mt-2">
                    <input type="submit" value="submit" class="btn btn-success" >
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
                     <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" > <i class="fa fa-plus" ></i> Add product</a>
                  </div>
              </div>
              <div class="card-body">
                <table id="mydatatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Supplier Name</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$product->supplier->name}} </td>
                                <td> {{$product->category['name']}} </td>
                                <td>{{$product->name}} </td>
                                <td>{{$product->unit['name']}} </td>
                                <td width="15%" >
                                    <a class="btn btn-outline-info btn-sm" href=" {{route('product.edit',$product->id)}} "> <i class="fa fa-edit" ></i> </a>
                                    <a id="delete" class="btn btn-outline-danger btn-sm" href="{{route('product.delete',$product->id)}}"> <i class="fa fa-trash" ></i> </a>
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
          supplier_id: {               
            required: true,
            
          },            
          category_id: {               
            required: true,
            
          },            
          unit_id: {               
            required: true,
            
          },            
         
    
        },
        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a vaild email address"
          },
          supplier_id: {               
            required: "Please select a supplier!",
            
          },  
          category_id: {               
            required: "Please select a category!",
            
          },  
          unit_id: {               
            required: "Please select an unit!",
            
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