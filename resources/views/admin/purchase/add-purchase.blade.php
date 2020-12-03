@extends('layouts.admin_master')
@section('content')
  <!-- Content Header (Page header) -->
  {{-- <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Add Purchase</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div> --}}
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
                     <a href=" {{route('purchase.list')}} " class="btn btn-block btn-info btn-flat btn-sm"> <i class="fa fa-list" ></i> Purchase List</a>
                  </div>
              </div>
              <div class="card-body">
                
                    <div class="form-group col-md-4 float-left">
                        <label>Date</label>
                        <input type="text" name="date" id="date" class="form-control datepicker" placeholder="YYYY-MM-DD" readonly>
                    </div>
                    
                    <div class="form-group col-md-4 float-left">
                        <label>Purchase No</label>
                        <input type="text" name="purchase_no" id="purchase_no" class="form-control" placeholder="Purchase No">
                    </div>

                    <div class="form-group col-md-4 float-left">
                        <label for="">Supplier Name</label>
                        <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="">Select Supplier</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group col-md-4 float-left">
                        <label for="">Category Name</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select Category</option>
                        </select>
                        
                    </div>
    
                    <div class="form-group col-md-4 float-left">
                        <label for="">Product Name</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">Select Product</option>
                        </select>
                    </div>
    
                    <div class="form-group col-md-4 float-left" style="padding-top:35px">
                       <a href="#" class="btn btn-success btn-flat btn-sm addeventmore"> <i class="fa fa-plus-circle"></i> Add Item</a>
                    </div>
              
              </div>

              <div class="card-body">
                <form action="" method="POST">
                  @csrf
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Category</th>
                        <th>Product Name</th>
                        <th width="7%">Pcs/KG</th>
                        <th width="10%">Unit Price</th>
                        <th>Description</th>
                        <th width="10%">Total Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody id="addRow" class="addRow">

                    </tbody>
                    <tbody>
                      <tr>
                        <td colspan="5"></td>
                        <td>
                          <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount"  style="background:#D8FDBA" readonly>
                        </td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                  <br>
                  {{-- table --}}
                  <div class="form-group">
                    <a  class="btn btn-primary btn-sm"> <i class="fa fa-plus-circle"></i> Add Purchase</a>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
  </div>


@endsection
@section('script')
<!----Handlebar js----->
<script id="document-template" type="text/x-handlebars-template" >
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
        <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">

        <td>
          <input type="hidden" name="category_id[]" value="@{{category_id}}">
          @{{category_name}}
        </td>

        <td>
          <input type="hidden" name="product_id[]" value="@{{product_id}}">
          @{{product_name}}
        </td>

        <td>
          <input type="number" name="bying_qty[]" value="1" min="1" class="form-control form-control-sm text-right buying_qty">
        </td>

        <td>
          <input type="number" name="unit_price[]" value="" class="form-control form-control-sm text-right unit_price">
        </td>

        <td>
          <input type="text" name="desription[]"  class="form-control form-control-sm">
        </td>

        <td>
          <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
        </td>

        <td>
          <i class="btn btn-danger btn-sm fa fa-window-close removeeventmore"></i>
        </td>
    </tr>

</script>


<!--------Add row JS------->
<script type="text/javascript">
  $(document).ready(function(){
    $(document).on("click",".addeventmore",function(){

        var date             = $('#date').val();
        var purchase_no      = $('#purchase_no').val();
        var supplier_id      = $('#supplier_id').val();
        var category_id      = $('#category_id').val();
        var category_name    = $('#category_id').find('option:selected').text();
        var product_id      = $('#product_id').val();
        var product_name    = $('#product_id').find('option:selected').text();

        

        if(date == ""){
          toastr.error("{{ Session::get('message','Date is required!') }}");
          return false;
        }
        if(purchase_no == ""){
          toastr.error("{{ Session::get('message','Purchase No is required!') }}");
          return false;
        }
        if(supplier_id == ""){
          toastr.error("{{ Session::get('message','Supplier is required!') }}");
          return false;
        }
        if(category_id == ""){
          toastr.error("{{ Session::get('message','Category is required!') }}");
          return false;
        }
        if(product_id == ""){
          toastr.error("{{ Session::get('message','Product is required!') }}");
          return false;
        }

        var source = $("#document-template").html();
        var template = Handlebars.compile(source);
        var data = {
                    date:date,
                    purchase_no:purchase_no,
                    supplier_id:supplier_id,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name
                  }; 
        var html = template(data);
        $('#addRow').append(html);
    });

    //remove row
    $(document).on('click','.removeeventmore',function(event){

      $(this).closest('.delete_add_more_item').remove();
      totalAmountPrice();
    });
    //key up event
    $(document).on('keyup click','.unit_price,.buying_qty',function(){
      var unit_price = $(this).closest("tr").find("input.unit_price").val();
      var qty        = $(this).closest("tr").find("input.buying_qty").val();
      var total      = unit_price * qty ;
      $(this).closest("tr").find("input.buying_price").val(total);
      totalAmountPrice();
    });

    //calculate sum of amount in invoice 
    function totalAmountPrice(){
      var sum = 0;
      $(".buying_price").each(function(){
         var value = $(this).val();
         if(!isNaN(value) && value.length != 0){
           sum += parseFloat(value);
         }
         //console.log(sum);
      });
      
      $("#estimated_amount").val(sum);
    }




  });
</script>


  {{-- script for Select Category --}}
<script>
  $(function(){
    $(document).on('change','#supplier_id',function(){
      var supplier_id =$(this).val();
          console.log(supplier_id);
          $.ajax({
            url:"{{route('get-category')}}",
            type:"GET",
            data:{supplier_id:supplier_id},
            success:function(data){
              var html = '<option value="">Select category</option>';
              $.each(data,function(key,v){
                html +='<option value="'+v.category_id+'">'+v.category.name+'</option>';
              });
              $('#category_id').html(html);
            }
          });
    });
  });
</script>
  {{-- script for Select Product --}}
<script>
  $(function(){
    $(document).on('change','#category_id',function(){
      var category_id =$(this).val();
          console.log(category_id);
          $.ajax({
            url:"{{route('get-product')}}",
            type:"GET",
            data:{category_id:category_id},
            success:function(data){
              var html = '<option value="">Select Product</option>';
              $.each(data,function(key,v){
                html +='<option value="'+v.id+'">'+v.name+'</option>';
              });
              $('#product_id').html(html);
            }
          });
      });
  });
</script>

  {{-- script for purchase --}}

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

<script>
    $('.datepicker').datepicker({

        uiLibrary:'bootstrap4',
        format:'yyyy-mm-dd'
    });
</script>
@endsection
                        