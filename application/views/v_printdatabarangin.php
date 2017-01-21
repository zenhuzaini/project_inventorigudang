<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width:30%; height:40%; background-color:yellow; align="center" ">
<?php foreach ($isi as $key) { ?>
	<h3>Laporan Barang Masuk </h3>
	<hr>
	<i>
	<table>
	
		<tr>
			<td>ID TRANSAKSI BARANG MASUK</td>
			<td>::</td>
			<td><?php echo $key->ID_TRANSAKSI_IN?></td>
		</tr>
		<tr>
			<td>ID BARANG</td>
			<td>::</td>
			<td><?php echo $key->ID_BARANG?></td>
		</tr>
		<tr>
			<td>ID LOKASI</td>
			<td>::</td>
			<td><?php echo $key->ID_LOKASI?></td>
		</tr>
		<tr>
			<td>TANGGAL BARANG MASUK</td>
			<td>::</td>
			<td><?php echo $key->TGL_IN?></td>
		</tr>
		<tr>
			<td>JUMLAH BARANG MASUK</td>
			<td>::</td>
			<td><?php echo $key->JML_BARANGIN?></td>
		</tr>
		<tr>
			<td>KETERANGAN BARANG MASUK</td>
			<td>::</td>
			<td><?php echo $key->KET_IN?></td>
		</tr>
	<?php } ?>
	</table>
	<hr>
	</i>
	ADMIN ~ <?php echo $this->session->userdata('NAMA_ADMIN'); ?>
</div>
</body>
</html>