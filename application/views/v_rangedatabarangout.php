<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/css/jquery.dataTables.min.css">

    <script type= 'text/javascript' src="<?php echo base_url();?>assets/datatables/js/jquery.js"></script>
    <script type= 'text/javascript' src="<?php echo base_url();?>assets/datatables/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/bootstrap/css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>

<style type="text/css">
	body {
font-family: 'Raleway', sans-serif;
}
th,td{
	padding: 15px;
	text-align: center;
}

</style>
 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.js"></script>
	<title></title>

</head>
<body>
<div class="container">
<div class="jumbotron">
		<a href="<?php echo base_url().'index.php/C_project/index'?>" title=""><img src="<?php echo base_url('assets/inventory.png')?>" width="100%"></a>
		<h1>Data Barang Keluar</h1>
</div>

<table border="1">
		<tr style="background-color:yellow">
			<td>ID Transaksi</td>
			<td>ID Barang</td>
			
			<td>Tanggal Transaksi</td>
			<td>Jumlah Barang</td>
			<td>Keterangan</td>
		</tr>
	<tbody>
	<?php
	foreach ($datanya as $key ) {  //menggunakan libarary table add_row
	?>
		<tr>
			<td><?php echo $key->ID_TRANSAKSIOUT ?></td>
			<td><?php echo $key->ID_BARANG ?></td>
			
			<td><?php echo $key->TGL_OUT ?></td>
			<td><?php echo $key->JML_BARANGOUT ?></td>
			<td><?php echo $key->KET_OUT ?></td>
		</tr>
	<?php
        }
	?>

		
	</tbody>
</table>

<table style="margin-left: 70%">
	<tr>
		<td> Admin  </td>
		<td> <?php print_r($this->session->userdata('NAMA_ADMIN')) ?> </td>
	</tr>
</table>

</div>
</body>
</html>