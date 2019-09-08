<?php
include('db_conn.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Product filter in php</title>
        
        
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
        <!-- Custom CSS -->
        
    </head>
    <body>
        <div class="container-fluid">
            
            <div class="row">
                <br />
                <h2 align="center">Product Filter</h2>
                <br/>
                <div class="col-md-3">
                    
                    <div class="list-group">
                        
                        <h3>Price</h3>
                        <input type="hidden" id="hidden_minimun_price" value="0"  />
                        <input type="hidden" id="hidden_maximum_price" value="65000"  />
                        <p id="price_show">1000 - 65000</p>
                        <div id="price_range"></div>
                    </div>
                    <div class="list-group">
                        <h3>Brand</h3>
                        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                            <?php
                            $query = "SELECT DISTINCT(product_brand) FROM product WHERE product_status = '1'";
                            $statement = $conn->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            
                            foreach($result as $row)
                            {
                            
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector brand" name="" value="<?php echo $row['product_brand'];?>">
                                <?php echo $row['product_brand'];?>
                                <label>
                                </div>
                                <?php                    }
                                ?>
                            </div>
                        </div>
                        <div class="list-group">
                            
                            <h3>RAM</h3>
                            <?php
                            $query = "
                            SELECT DISTINCT(product_ram) FROM product WHERE product_status = '1' ORDER BY product_ram DESC
                            ";
                            $statement = $conn->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['product_ram']; ?>" > <?php echo $row['product_ram']; ?> GB</label>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="list-group">
                            <h3>Internal Storage</h3>
                            <?php
                            $query = "
                            SELECT DISTINCT(product_storage) FROM product WHERE product_status = '1' ORDER BY product_storage DESC
                            ";
                            $statement = $conn->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" class="common_selector storage" value="<?php echo $row['product_storage']; ?>"  > <?php echo $row['product_storage']; ?> GB</label>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <br />
                        <div class="row filter_data">
                        </div>
                    </div>

                </div>
            </div>
            <style>
                #loading 
                {

                    text-align: center;
                    background: url('assets/img/loader1.gif') no-repeat center;
                    height: 150px;
                }   
            </style>

            <script>
                $(document).ready(function(){
                filter_data();
                function filter_data()
                {
                     $('.filter_data').html('<div id="loading" style="" ></div>');
               
                    var action = 'fetch_data';
                    var maximum_price = $('#hidden_maximum_price').val();
                    var minimum_price = $('#hidden_minimum_price').val();
                    var brand = get_filter('brand');
                    var ram = get_filter('ram');
                    var storage = get_filter('storage');

                    $.ajax({
                        url:"fetch_data.php",
                        method:"POST",
                        data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
                        success:function(data){
                            $('.filter_data').html(data);
                        }
                    });
                }

               
              function get_filter(class_name)
              {
                var filter = [];
              $('.'+class_name+':checked').each(function(){
                    filter.push($(this).val());
                });

                return filter;

              }
         

$('.common_selector').click(function(){
    filter_data();
});

 $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
            </script>
        </body>
    </html>