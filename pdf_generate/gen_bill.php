<?php 

function fetch_data(){
	$output = '';
	$connect = mysqli_connect("localhost","root","root","society_db");

	$sql = "SELECT * from property_detail where plot_no='32323'";
	$result = mysqli_query($connect,$sql);

	while ($row = mysqli_fetch_array($result)){
		$output .= '<tr>
				<th>Reciver Id: </th>

				<td>'.$row['login_id'].'</td>
		</tr>

<tr>
				<th>Plot No: </th>

				<td>'.$row['plot_no'].'</td>
		</tr>
		<tr>
		<th>Address: </th>

				<td>'.$row['property_location'].', '.$row['property_city'].'</td>
		</tr>
		<tr>
		<th>Price: </th>

				<td>'.$row['price'].'</td>
		</tr>
		<tr>
		<th>qty</th>

				<td>'.$row['unit_qty'].', '.$row['property_unit'].'</td>
		</tr>
		';
	}

	return $output;
}

if(isset($_POST["create_pdf"]))  
 {
 require_once('./TCPDF/tcpdf.php');
  $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");

      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
       $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('helvetica');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('helvetica', '', 12);  
      $obj_pdf->AddPage(); 
       $content = '';
        $content .= '  
      <h3 align="center">Export HTML Table data to PDF using TCPDF in PHP</h3><br /><br />  
      <table border="1" cellspacing="0" cellpadding="5">  
            
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
       $obj_pdf->writeHTML($content);
       $obj_pdf->Output('sample.pdf', 'I');    

 }
 ?>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />      
 <form method="post">  
                          <input type="submit" name="create_pdf" class="btn btn-danger" value="Create PDF" />  
                     </form>  