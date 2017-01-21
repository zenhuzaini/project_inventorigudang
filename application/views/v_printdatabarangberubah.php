<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<div style="width:30%; height:40%; background-color:yellow; align="center" ">
<?php foreach ($isi as $key) { ?>
	<h3>Laporan Perubahan Stok Barang </h3>
	<hr>
	<i>
	<table>
		<tr>
			<td>ID PERUBAHAN</td>
			<td>::</td>
			<td><?php echo $key->ID_PERUBAHANSTOK?></td>
		</tr>
		<tr>
			<td>ID BARANG</td>
			<td>::</td>
			<td><?php echo $key->ID_BARANG?></td>
		</tr>
		<tr>
			<td>TANGGAL CEK</td>
			<td>::</td>
			<td><?php echo $key->TGL_CEK?></td>
		</tr>
		<tr>
			<td>JUMLAH PERUBAHAN STOK</td>
			<td>::</td>
			<td><?php echo $key->PERUBAHAN_STOK?></td>
		</tr>
		<tr>
			<td>KETERANGAN PERUBAHAN</td>
			<td>::</td>
			<td><?php echo $key->KETERANGAN_PERUBAHAN?></td>
		</tr>
		<tr>
			<td>KETERANGAN DETAIL</td>
			<td>::</td>
			<td><?php echo $key->KETERANGAN_DETAIL?></td>
		</tr>
	<?php } ?>
	</table>
	<hr>
	</i>
	ADMIN ~ <?php echo $this->session->userdata('NAMA_ADMIN'); ?>
</div>
</body>
</html>