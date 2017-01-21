<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width:50%; height:30%; background-color:yellow; align="center" ">
<?php foreach ($isi as $key) { ?>
	<h3>Laporan Barang <i><?php echo $key->NAMA_BARANG?></i> </h3>
	<hr>
	<table>
	
		<tr>
			<td>ID BARANG</td>
			<td>::</td>
			<td><?php echo $key->ID_BARANG?></td>
		</tr>
		<tr>
			<td>NAMA BARANG</td>
			<td>::</td>
			<td><?php echo $key->NAMA_BARANG?></td>
		</tr>
		<tr>
			<td>JUMLAH BARANG</td>
			<td>::</td>
			<td><?php echo $key->JUMLAH_BARANG?></td>
		</tr>
		<tr>
			<td>AWAL BARANG MASUK</td>
			<td>::</td>
			<td><?php echo $key->AWAL_BARANGMASUK?></td>
		</tr>
		<tr>
			
			
		</tr>
	<?php } ?>
	</table>
	<hr>
	ADMIN ~ <?php echo $this->session->userdata('NAMA_ADMIN'); ?>
</div>
</body>
</html>