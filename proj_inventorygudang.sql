-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 22 Jun 2016 pada 06.20
-- Versi Server: 5.6.11
-- Versi PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `proj_inventorygudang`
--
CREATE DATABASE IF NOT EXISTS `proj_inventorygudang` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `proj_inventorygudang`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
  `ID_BARANG` int(11) NOT NULL AUTO_INCREMENT,
  `ID_KATEGORI` int(11) DEFAULT NULL,
  `NAMA_BARANG` varchar(64) DEFAULT NULL,
  `JUMLAH_BARANG` int(11) DEFAULT NULL,
  `AWAL_BARANGMASUK` date NOT NULL,
  PRIMARY KEY (`ID_BARANG`),
  KEY `FK_RELATIONSHIP_1` (`ID_KATEGORI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=112 ;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID_BARANG`, `ID_KATEGORI`, `NAMA_BARANG`, `JUMLAH_BARANG`, `AWAL_BARANGMASUK`) VALUES
(100, 10, 'Indo Emmi', 946, '2016-06-12'),
(101, 11, 'Teh Busuk', 140, '2016-05-30'),
(103, 12, 'Sampo Eddop', 243, '2016-06-12'),
(104, 11, 'Indo Susu', 103, '2016-05-30'),
(105, 10, 'Roti ABC', 97, '2016-06-12'),
(106, 11, 'Sari Keledai', 1070, '2016-05-30'),
(107, 10, 'Kecap 123', 202, '2016-06-12'),
(108, 10, 'Saus Terong', 100, '2016-05-30'),
(109, 12, 'AmbuKrim', 112, '2016-05-30'),
(110, 10, 'Minuman Keras Miras', 724, '2016-05-30'),
(111, 10, 'roti tawar', 0, '2016-06-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `ID_KATEGORI` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_KATEGORI` varchar(64) DEFAULT NULL,
  `KET_KATEGORI` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID_KATEGORI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`ID_KATEGORI`, `NAMA_KATEGORI`, `KET_KATEGORI`) VALUES
(10, 'Makanan', NULL),
(11, 'Minuman', NULL),
(12, 'Mandi dan Cuci', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `lokasi`
--

CREATE TABLE IF NOT EXISTS `lokasi` (
  `ID_LOKASI` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_LOKASI` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`ID_LOKASI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=305 ;

--
-- Dumping data untuk tabel `lokasi`
--

INSERT INTO `lokasi` (`ID_LOKASI`, `NAMA_LOKASI`) VALUES
(300, 'GUDANG 1'),
(301, 'GUDANG 2'),
(302, 'GUDANG 3'),
(303, 'GUDANG 4'),
(304, 'GUDANG 5');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahan_stok`
--

CREATE TABLE IF NOT EXISTS `perubahan_stok` (
  `ID_PERUBAHANSTOK` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BARANG` int(11) DEFAULT NULL,
  `TGL_CEK` date DEFAULT NULL,
  `PERUBAHAN_STOK` int(11) DEFAULT NULL,
  `KETERANGAN_PERUBAHAN` varchar(200) DEFAULT NULL,
  `KETERANGAN_DETAIL` varchar(200) NOT NULL,
  PRIMARY KEY (`ID_PERUBAHANSTOK`),
  KEY `FK_RELATIONSHIP_5` (`ID_BARANG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7013 ;

--
-- Dumping data untuk tabel `perubahan_stok`
--

INSERT INTO `perubahan_stok` (`ID_PERUBAHANSTOK`, `ID_BARANG`, `TGL_CEK`, `PERUBAHAN_STOK`, `KETERANGAN_PERUBAHAN`, `KETERANGAN_DETAIL`) VALUES
(7007, 109, '2016-06-15', 2, 'Bertambah', 'Barang Hari ini bertambah, padahal tidak ada transkasi apapun, Admin Pengecek : <span class=''label label-danger''>zen</span>'),
(7008, 100, '2016-06-29', 5, 'Berkurang', 'Barang Berkurang, namun 2 jam yang lalu saat di cek pas, Admin Pengecek : <span class=''label label-danger''>zen</span>'),
(7009, 105, '2016-06-01', 1, 'Berkurang', 'Barang Berkurang saat makan siang,,, Admin Pengecek : <span class=''label label-danger''>zen</span>'),
(7010, 110, '2016-05-08', 1, 'Berkurang', 'Barang Berkurang 1 botol, entah kemana, Admin Pengecek : <span class=''label label-danger''>zen</span>'),
(7011, 107, '2016-05-25', 2, 'Bertambah', 'Barang Kecap bertambah 2 botol, Admin Pengecek : <span class=''label label-danger''>zen</span>'),
(7012, 111, '2016-06-15', 10, 'Bertambah', 'Barang haj, Admin Pengecek : <span class=''label label-danger''>zen</span>');

--
-- Trigger `perubahan_stok`
--
DROP TRIGGER IF EXISTS `lapor_stokberubah`;
DELIMITER //
CREATE TRIGGER `lapor_stokberubah` AFTER INSERT ON `perubahan_stok`
 FOR EACH ROW begin
       declare a decimal;

       set a = new.PERUBAHAN_STOK;
       
       
       if new.KETERANGAN_PERUBAHAN = 'Bertambah' then
       	update barang set JUMLAH_BARANG = JUMLAH_BARANG+new.PERUBAHAN_STOK
    	where ID_BARANG = new.ID_BARANG;
       
       
       elseif new.KETERANGAN_PERUBAHAN = 'Berkurang' then
       	update barang set JUMLAH_BARANG = JUMLAH_BARANG-new.PERUBAHAN_STOK
    	where ID_BARANG = new.ID_BARANG;
        
       end if;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `lapor_stokberubah_update`;
DELIMITER //
CREATE TRIGGER `lapor_stokberubah_update` AFTER UPDATE ON `perubahan_stok`
 FOR EACH ROW begin	
           	if old.KETERANGAN_PERUBAHAN = 'Bertambah' and new.KETERANGAN_PERUBAHAN = 'Bertambah' then
                update barang set JUMLAH_BARANG = JUMLAH_BARANG-old.PERUBAHAN_STOK
                where ID_BARANG = new.ID_BARANG;
                
                update barang set JUMLAH_BARANG = JUMLAH_BARANG+new.PERUBAHAN_STOK
                where ID_BARANG = new.ID_BARANG;
            
			elseif old.KETERANGAN_PERUBAHAN = 'Bertambah' and new.KETERANGAN_PERUBAHAN = 'Berkurang' then
                update barang set JUMLAH_BARANG = JUMLAH_BARANG-old.PERUBAHAN_STOK
                where ID_BARANG = new.ID_BARANG;
                
                 update barang set JUMLAH_BARANG = JUMLAH_BARANG-new.PERUBAHAN_STOK
                where ID_BARANG = new.ID_BARANG;
            
 
       
       		elseif old.KETERANGAN_PERUBAHAN = 'Berkurang' and new.KETERANGAN_PERUBAHAN = 'Bertambah' then
                    update barang set JUMLAH_BARANG = JUMLAH_BARANG+old.PERUBAHAN_STOK
                    where ID_BARANG = new.ID_BARANG;
                    
                    update barang set JUMLAH_BARANG = JUMLAH_BARANG+new.PERUBAHAN_STOK
                    where ID_BARANG = new.ID_BARANG;
                
            elseif old.KETERANGAN_PERUBAHAN = 'Berkurang' and new.KETERANGAN_PERUBAHAN = 'Berkurang' then
                    update barang set JUMLAH_BARANG = JUMLAH_BARANG+old.PERUBAHAN_STOK
                    where ID_BARANG = new.ID_BARANG;
                    
                     update barang set JUMLAH_BARANG = JUMLAH_BARANG-new.PERUBAHAN_STOK
                    where ID_BARANG = new.ID_BARANG;
         	
		end if;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `setelahhapus`;
DELIMITER //
CREATE TRIGGER `setelahhapus` AFTER DELETE ON `perubahan_stok`
 FOR EACH ROW if old.KETERANGAN_PERUBAHAN = 'Bertambah' then
		update barang set JUMLAH_BARANG = JUMLAH_BARANG-old.PERUBAHAN_STOK
    	where ID_BARANG = old.ID_BARANG;
	
       
       
       elseif old.KETERANGAN_PERUBAHAN = 'Berkurang' then
		update barang set JUMLAH_BARANG = JUMLAH_BARANG+old.PERUBAHAN_STOK
    	where ID_BARANG = old.ID_BARANG;

        
       end if
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_inbarang`
--

CREATE TABLE IF NOT EXISTS `t_inbarang` (
  `ID_TRANSAKSI_IN` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BARANG` int(11) DEFAULT NULL,
  `ID_LOKASI` int(11) DEFAULT NULL,
  `TGL_IN` date DEFAULT NULL,
  `JML_BARANGIN` int(11) DEFAULT NULL,
  `KET_IN` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_TRANSAKSI_IN`),
  KEY `FK_RELATIONSHIP_2` (`ID_LOKASI`),
  KEY `FK_RELATIONSHIP_3` (`ID_BARANG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1022 ;

--
-- Dumping data untuk tabel `t_inbarang`
--

INSERT INTO `t_inbarang` (`ID_TRANSAKSI_IN`, `ID_BARANG`, `ID_LOKASI`, `TGL_IN`, `JML_BARANGIN`, `KET_IN`) VALUES
(1016, 100, 300, '2016-06-14', 50, 'Supplier : Supplier : Indo TBK, Admin :, Admin : <span class=''label label-danger''>lina</span>'),
(1017, 103, 303, '2016-05-18', 20, 'Supplier : Eddop TBK, Admin : <span class=''label label-danger''>zen</span>'),
(1018, 109, 304, '2016-07-12', 10, 'Supplier : PT Ambu bingit , Admin : <span class=''label label-danger''>zen</span>'),
(1019, 107, 301, '2016-06-06', 100, 'Supplier : ABC Jaya, Admin : <span class=''label label-danger''>zen</span>'),
(1020, 110, 300, '2016-06-23', 30, 'Supplier : Haus TBK, Admin : <span class=''label label-danger''>zen</span>'),
(1021, 111, 301, '2016-06-15', 5, 'Supplier : ww, Admin : <span class=''label label-danger''>zen</span>');

--
-- Trigger `t_inbarang`
--
DROP TRIGGER IF EXISTS `gantistok_delete`;
DELIMITER //
CREATE TRIGGER `gantistok_delete` AFTER DELETE ON `t_inbarang`
 FOR EACH ROW begin
       
		update barang set JUMLAH_BARANG = JUMLAH_BARANG-old.JML_BARANGIN
    	where ID_BARANG = old.ID_BARANG;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `gantistok_update`;
DELIMITER //
CREATE TRIGGER `gantistok_update` AFTER UPDATE ON `t_inbarang`
 FOR EACH ROW begin
       
		update barang set JUMLAH_BARANG = JUMLAH_BARANG-old.JML_BARANGIN
    	where ID_BARANG = new.ID_BARANG;
		
       	update barang set JUMLAH_BARANG = JUMLAH_BARANG+new.JML_BARANGIN
    	where ID_BARANG = new.ID_BARANG;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_tambahStok`;
DELIMITER //
CREATE TRIGGER `update_tambahStok` AFTER INSERT ON `t_inbarang`
 FOR EACH ROW begin 

update barang set JUMLAH_BARANG = (JUMLAH_BARANG + new.JML_BARANGIN) where ID_BARANG = new.ID_BARANG; end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_outbarang`
--

CREATE TABLE IF NOT EXISTS `t_outbarang` (
  `ID_TRANSAKSIOUT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_BARANG` int(11) DEFAULT NULL,
  `TGL_OUT` date DEFAULT NULL,
  `JML_BARANGOUT` int(11) DEFAULT NULL,
  `KET_OUT` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID_TRANSAKSIOUT`),
  KEY `FK_RELATIONSHIP_4` (`ID_BARANG`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10008 ;

--
-- Dumping data untuk tabel `t_outbarang`
--

INSERT INTO `t_outbarang` (`ID_TRANSAKSIOUT`, `ID_BARANG`, `TGL_OUT`, `JML_BARANGOUT`, `KET_OUT`) VALUES
(10001, 110, '2016-06-14', 5, 'Konsumen : Warung Emak Dinah, Admin : <span class=''label label-danger''>zen</span>'),
(10002, 106, '2016-06-15', 10, 'Konsumen : Pasar Kamal, Admin : <span class=''label label-danger''>zen</span>'),
(10003, 101, '2016-06-13', 5, 'Konsumen : Rumah Makan Racun dunia, Admin : <span class=''label label-danger''>zen</span>'),
(10004, 105, '2016-06-30', 2, 'Konsumen : Anak Tetangga, Admin : <span class=''label label-danger''>zen</span>'),
(10005, 100, '2016-07-09', 2, 'Konsumen : Tukiyem anak Desa, Admin : <span class=''label label-danger''>zen</span>'),
(10006, 111, '2016-06-20', 5, 'Konsumen : qq, Admin : <span class=''label label-danger''>zen</span>'),
(10007, 111, '2016-06-15', 30, 'Konsumen : www, Admin : <span class=''label label-danger''>zen</span>');

--
-- Trigger `t_outbarang`
--
DROP TRIGGER IF EXISTS `gantistokout_delete`;
DELIMITER //
CREATE TRIGGER `gantistokout_delete` AFTER DELETE ON `t_outbarang`
 FOR EACH ROW begin
       
		update barang set JUMLAH_BARANG = JUMLAH_BARANG+old.JML_BARANGOUT
    	where ID_BARANG = old.JML_BARANGOUT;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `gantistokout_update`;
DELIMITER //
CREATE TRIGGER `gantistokout_update` AFTER UPDATE ON `t_outbarang`
 FOR EACH ROW begin
       
		update barang set JUMLAH_BARANG = JUMLAH_BARANG+old.JML_BARANGOUT
    	where ID_BARANG = new.ID_BARANG;
		
       	update barang set JUMLAH_BARANG = JUMLAH_BARANG-new.JML_BARANGOUT
    	where ID_BARANG = new.ID_BARANG;
       
end
//
DELIMITER ;
DROP TRIGGER IF EXISTS `update_kurangStok`;
DELIMITER //
CREATE TRIGGER `update_kurangStok` AFTER INSERT ON `t_outbarang`
 FOR EACH ROW begin 

update barang set JUMLAH_BARANG = (JUMLAH_BARANG - new.JML_BARANGOUT) where ID_BARANG = new.ID_BARANG; end
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_ADMIN` int(11) NOT NULL AUTO_INCREMENT,
  `NAMA_ADMIN` varchar(50) DEFAULT NULL,
  `PWD_ADMIN` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_ADMIN`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_ADMIN`, `NAMA_ADMIN`, `PWD_ADMIN`) VALUES
(1, 'zen', 'zen'),
(2, 'afifah', 'afifah'),
(3, 'lina', 'lina');

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `FK_RELATIONSHIP_1` FOREIGN KEY (`ID_KATEGORI`) REFERENCES `kategori` (`ID_KATEGORI`);

--
-- Ketidakleluasaan untuk tabel `perubahan_stok`
--
ALTER TABLE `perubahan_stok`
  ADD CONSTRAINT `FK_RELATIONSHIP_5` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Ketidakleluasaan untuk tabel `t_inbarang`
--
ALTER TABLE `t_inbarang`
  ADD CONSTRAINT `FK_RELATIONSHIP_2` FOREIGN KEY (`ID_LOKASI`) REFERENCES `lokasi` (`ID_LOKASI`),
  ADD CONSTRAINT `FK_RELATIONSHIP_3` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

--
-- Ketidakleluasaan untuk tabel `t_outbarang`
--
ALTER TABLE `t_outbarang`
  ADD CONSTRAINT `FK_RELATIONSHIP_4` FOREIGN KEY (`ID_BARANG`) REFERENCES `barang` (`ID_BARANG`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
