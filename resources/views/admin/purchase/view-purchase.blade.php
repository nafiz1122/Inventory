@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Purchase</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
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
                     <a href="{{route('purchase.add')}}" class="btn btn-primary btn-sm" > <i class="fa fa-plus" ></i> Add Purchase</a>
                  </div>
              </div>
              <div class="card-body">
                <table id="mydatatable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL.</th>
                            <th>Purchase No</th>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $key => $purchase)
                            {{-- <tr>
                                <td> {{$key+1}} </td>
                                <td> {{$purchase->supplier->name}} </td>
                                <td> {{$purchase->category['name']}} </td>
                                <td>{{$purchase->name}} </td>
                                <td>{{$purchase->unit['name']}} </td>
                                <td width="15%" >
                                    <a class="btn btn-outline-info btn-sm" href=" {{route('purchase.edit',$purchase->id)}} "> <i class="fa fa-edit" ></i> </a>
                                    <a id="delete" class="btn btn-outline-danger btn-sm" href="{{route('purchase.delete',$purchase->id)}}"> <i class="fa fa-trash" ></i> </a>
                                </td>
                            </tr> --}}
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