<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    </head>
<body>


<div class="container mt-4">
<div class="card">
  <div class="card-body">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">View</a>
  </li>

</ul>
<!-- content -->
<div class="tab-content" id="myTabContent">
  
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <h4 class="text-center mt-3">Add Product Details</h4><hr>
    <form action="<?php echo base_url('save');?>" method="POST">
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="">Product Name</label>
            <input type="text" class="form-control" id="" name="product_name" placeholder="Eg. Polo T-shirt">
            </div>
            <div class="form-group col-md-6">
            <label for="">Product Id</label>
            <input type="" class="form-control" id="" name="product_id" placeholder="Eg. TEMP0099">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="">MRP</label>
            <input type="" class="form-control" id="" name="mrp" placeholder="Eg. 1299">
            </div>
            <div class="form-group col-md-6">
            <label for="">Invoice No.</label>
            <input type="" class="form-control" id="" name="invoice_no" placeholder="Eg. 7821989812345124">
            </div>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
        </form>
            
        </div><!--end of tab-pane-->

        <!-- views for Table -->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <h4 class="text-center mt-3">Invoice</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">MRP</th>
                    <th scope="col">Invoice No</th>
                    <!-- <th scope="col">View</th> -->
                    <th scope="col">Print</th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                    if(!empty($productList)){
                    foreach($productList as $data){ 
                        ?>
                    <tr>
                        <th scope="row"><?php echo $data['id'];?></th>
                        <td><?php echo $data['product_name'];?></td>
                        <td><?php echo $data['product_id'];?></td>
                        <td><?php echo $data['mrp'];?></td>
                        <td><?php echo $data['invoice_no'];?></td>
                        <td>
                        <a href="<?php echo base_url('InvoiceController/fetchSingleProduct/'.$data['id']);?>"  role="button" class="btn btn-outline-info btn-sm">Invoice</a>
                        </td>
                        <td>
                        <!-- <a href="<//?php echo base_url('/'.$data['id']);?>"  role="button" class="btn btn-outline-info btn-sm">Invoice</a> -->
                        </td>
                    </tr>
                  <?php }}else{echo("----------------------------------NO DATA FOUND--------------------------------------");} ?>
                </tbody>
            </table>
        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>

        </div>
</div>
</div>














     <!-- script -->
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

    <script>
        $('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
    </script>
</body>
</html>