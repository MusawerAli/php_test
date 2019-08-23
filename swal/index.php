<!DOCTYPE html>
<html lang="en">
<head>
  <title>Swal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   <link data-require="sweet-alert@*" data-semver="0.4.2" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
</head>
<body>
 <form  id="test" method="POST">
              <div class="row">
              <div class="col-sm-4">
              <div class="w3-panel w3-blue w3-card-4"> Transfer Plot no#</div>
              <input class="w3-input w3-animate-input w3-text-red" type="text" name="plotno" placeholder="Your Plot No#" style="width:70%">
              </div>
              <div class="col-sm-4">
              	<input type="hidden" name="id" id="id" value="32">
              <br>
              <br>
              <button class=" w3-circle  w3-orange"><span class="fa fa-exchange"></span></button>
              </div>
              <div class="col-sm-4">
              <div class="w3-panel w3-green w3-card-4"> Transfer to</div>
             
                <select class="form-control" id="sel1" name="sellist1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
              </div>
              </div>

              <div class="row">
              <div class="col-sm-4">
              <div class="w3-panel w3-orange w3-card-4"> Confirm your Password</div>
              <input class="w3-input w3-animate-input w3-text-red" type = "password" name="password" placeholder="*******" style="width:70%">
              </div>
              </div>
              <button type="submit" name="submit" class="w3-red" id="submit">Transfer</button>
              </form>





</body>
</html>


<script>
       $(document).on('submit','#test',function(event){
  event.preventDefault();
  
   var form_data = $(this).serialize();
	var id=$('#id').val();
    swal({
  title: "Are you sure to transfer your Propert",
  text: "You will not be able to recover this imaginary file!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, transfer it",
  cancelButtonText: "No, cancel plx!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {
  	$.ajax({
            url: "process.php",
            method:"POST",
            data:{id:id},
            success:function(data)
            {

              swal("Deleted!", "Your imaginary file has been deleted.", "success"+ data);
            
            }
            })
    
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
});
   

});
</script>