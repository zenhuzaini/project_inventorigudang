<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width:30%; height:40%; background-color:yellow; align="center" ">
<?php foreach ($isi as $key) { ?>
	<h3>Laporan Barang Keluar </h3>
	<hr>
	<i>
	<table>
		<tr>
			<td>ID TRANSAKSI BARANG KELUAR</td>
			<td>::</td>
			<td><?php echo $key->ID_TRANSAKSIOUT?></td>
		</tr>
		<tr>
			<td>ID BARANG</td>
			<td>::</td>
			<td><?php echo $key->ID_BARANG?></td>
		</tr>
		
		<tr>
			<td>TANGGAL BARANG KELUAR</td>
			<td>::</td>
			<td><?php echo $key->TGL_OUT?></td>
		</tr>
		<tr>
			<td>JUMLAH BARANG KELUAR</td>
			<td>::</td>
			<td><?php echo $key->JML_BARANGOUT?></td>
		</tr>
		<tr>
			<td>KETERANGAN BARANG KELUAR</td>
			<td>::</td>
			<td><?php echo $key->KET_OUT?></td>
		</tr>
	<?php } ?>
	</table>
	<hr>
	</i>
	ADMIN ~ <?php echo $this->session->userdata('NAMA_ADMIN'); ?>
</div>
</body>
</html>