<!DOCTYPE html>
<html>
    <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Barang</title>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">
   
    </head> 
<body>
    <div class="container">
    <title>Inventory Barang</title>
        <h1 style="font-size:20pt"></h1>

       <table>
           <tr>
               <td width="30%" align="left"><a href="<?php echo base_url().'index.php/C_project/index'?>"><img src="<?php echo base_url('assets/inventory.png')?>" width="100%"></a></td>
               <td align="right">
                   <a href="<?php echo base_url().'index.php/C_project/barang/'?>"><button class="btn btn-success"><i class="glyphicon glyphicon-pencil"></i> Data Barang</button></a>
        <a href="<?php echo base_url().'index.php/C_project_barangout/barangout/'?>"><button class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Barang Keluar</button></a>
        <a href="<?php echo base_url().'index.php/C_project_barangin/barangin/'?>"><button class="btn btn-danger"><i class="glyphicon glyphicon-pencil"></i> Barang Masuk</button>
        <a href="<?php echo base_url().'index.php/C_project_barangberubah/barangberubah/'?>"><button class="btn btn-default"><i class="glyphicon glyphicon-pencil"></i> Lapor Jumlah Barang</button></a>
        <a href="<?php echo base_url().'index.php/C_printsemua/'?>"><button class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i> Print Laporan</button></a>
               </td>
           </tr>
           
       </table>
        
        
        <hr>
        <button class="btn btn-success" onclick="fungsitambah_barang()"><i class="glyphicon glyphicon-plus"></i> Tambah Barang Baru</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Masuk Awal</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                
                <th style="background-color:#ffd24d" colspan="7" align="center">WEB FRAMEWORK 2016 copyright@theboyonfire</th>
            </tr>
            </tfoot>
        </table>
    </div>

<script src="<?php echo base_url('assets/jquery/jquery-2.1.4.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>


<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('C_project/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],
    });
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});

function fungsitambah_barang()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data Barang'); // Set Title to Bootstrap modal title
}

function fungsiedit_barang(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('C_project/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.ID_BARANG);
            $('[name="nb"]').val(data.NAMA_BARANG);
            $('[name="ktgr"]').val(data.ID_KATEGORI);
            $('[name="bb"]').val(data.JUMLAH_BARANG);
            $('[name="tia"]').datepicker('update',data.AWAL_BARANGMASUK);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data Barang'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}
function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('C_project/ajax_add')?>";
    } else {
        url = "<?php echo site_url('C_project/ajax_update')?>";
    }
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reload_table();
            }

            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 
        }
    });
}

function fungsihapus_barang(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('C_project/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah Data Barang</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Barang</label>
                            <div class="col-md-9">
                                <input name="nb" placeholder="Nama Barang" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kategori</label>
                            <div class="col-md-9">
                                <select name="ktgr" class="form-control">
                                    <option value="">--Pilih Kategori Barang--</option>
                                    <?php foreach ($isi as $datanya): ?>
                                        <option value="<?php echo $datanya->ID_KATEGORI ?>"><?php echo $datanya->NAMA_KATEGORI ?></option>
                                    <?php endforeach ?>
                                    </select> 
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Banyak Barang</label>
                            <div class="col-md-9">
                                <input name="bb" placeholder="Masukan jumlah banyaknya barang..." class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Input Awal</label>
                            <div class="col-md-9">
                                <input name="tia" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>