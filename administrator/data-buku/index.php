<?php
$page = 'produk';
require_once "../database/config.php";
$tahunini = date('Y');
if (isset($_SESSION['status']))
{
  if ($_SESSION['status']!="Admin")
  {
    unset($_SESSION['status']);
    unset($_SESSION['username']);
    unset($_SESSION['nama']);
    unset($_SESSION['Id']);
    echo "<script>window.location='".base_url('auth')."';</script>";       
  } 
  else
  {
    
  }
  
} 
else 
{
  echo "<script>window.location='".base_url('auth')."';</script>";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php
include "../1header.php"; 
?>
<style type="text/css">
.img-kotak {
  width: 80px;
  height: 80px;
  /*border: solid red; */
  
}
.modified-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
 <?php
 include "../2navbar.php"; 
 ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php 
  include "../3sidebar.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
       <!--  <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div> -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card card-primary">
              <div class="card-header" style="background-color: #<?php echo $warna1; ?>">
                <h3 class="card-title"><i class="fas fa-clipboard mr-2"></i>Data Buku</h3> 
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="button">                
                  <button type="button" class="btn btn-default btn-md" style="background-color:#<?php echo $warna2; ?>;" data-toggle="modal" data-target="#modal-tambah"><font color="white"><i class="fas fa-plus"></i>Tambah Data</font></button>
                </div> 
                <br>
                <div class="table-responsive">
                  <table id="cobatabel" class="table table-sm table-bordered table-striped table-hover ">
                    <thead>
                      <tr>
                        <th bgcolor="#ffffff" width="3%"><center>No</center></th>
                        <th bgcolor="#ffffff" ><center>Cover</center></th>
                        <th bgcolor="#ffffff" ><center>Judul Buku</center></th>
                        <th bgcolor="#ffffff" ><center>Penulis Buku</center></th>
                        <th bgcolor="#ffffff" style="width: 5%;"><center>ISBN</center></th>
                        <th bgcolor="#ffffff" style="width: 5%;"><center>Link</center></th>
                        <th bgcolor="#ffffff" style="width: 40%;"><center>Sinopsis</center></th>
                        <th bgcolor="#ffffff" style="width: 10%;"><center>Aksi</center></th>                    

                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $no = 1;
                      $query = "SELECT * FROM tb_buku ";
                      $sql_peran = mysqli_query($con, $query) or die (mysqli_error($con));
                      if (mysqli_num_rows($sql_peran) >0 )
                      {
                        while($data = mysqli_fetch_array($sql_peran))
                        {
                          ?>
                          <tr data-widget="expandable-table" aria-expanded="false">
                            <td>
                              <h6>
                                <?=$no++;?> 
                              </h6>
                            </td>                        
                            <td>
                              <center>
                                <h6>
                                  <?php if($data['cover']=="") {?>
                                    <div class="img-kotak">
                                      <img src="../img/noimage.png" width="50px" height="50px" class="modified-img">
                                    </div><br>
                                    <button type="button" class="btn btn-default btn-sm" style="background-color:#<?php echo $warna2; ?>;" data-toggle="modal" data-target="#modal-upload" data-id="<?php echo $data['Id'] ;?>"><font color="white"><i class="fas fa-download"></i>Upload</font></button>  
                                  <?php }else{ ?> 
                                    <div class="img-kotak">                         
                                      <img src="cover/<?=$data['cover']?>" width="50px" class="modified-img">
                                    </div><br>                          
                                    <button type="button" class="btn btn-default btn-sm" style="background-color:#<?php echo $warna2; ?>;" data-toggle="modal" data-target="#modal-upload" data-id="<?php echo $data['Id'] ;?>"><font color="white"><i class="fas fa-download"></i>Update</font></button>
                                  <?php } ?>
                                </h6>
                              </center>
                            </td>
                            <td>
                              <h6> 
                                <?=$data['judul_buku']?>
                              </h6>
                            </td>
                            <td>
                              <h6>
                                <?=$data['penulis_buku']?>
                              </h6>
                            </td>
                            <td>
                              <h6>
                                <?=$data['isbn'];?>  
                              </h6>
                            </td>
                            <td>
                              <h6>
                                <a href="<?php echo $data['link']; ?>" target="_blank"><?=$data['link'];?>  </a>
                              </h6>
                            </td>
                            <td>
                              <h6>
                                <?=$data['sinopsis'];?>  
                              </h6>
                            </td>
                            <td >
                              <h6>
                                <center>
                                  <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#modal-edit" data-id="<?=$data['Id'];?>" data-judul_buku="<?=$data['judul_buku'];?>" data-penulis_buku="<?=$data['penulis_buku'];?>" data-isbn="<?=$data['isbn'];?>"  data-link="<?=$data['link'];?>" data-sinopsis="<?=$data['sinopsis'];?>">
                                    <font color="white"><i class="fas fa-edit"></i>
                                    </font>
                                  </button>
                                  <a href="hapus.php?id=<?=$data['Id'];?>" onclick="return confirm('Anda akan menghapus data ini ?')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                </center>
                              </h6>
                            </td>
                          </tr>    
                          <?php
                        }
                      }
                      else
                      {
                        echo "<tr><td colspan=\"8\" align=\"center\"><h6>Data Tidak Ditemukan!</h6></td></tr>";
                      }
                      ?>
                    </tbody>                         
                  </table>
                </div>      
              </div><!-- /.card-body -->            
            </div> <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->


      <div class="modal fade" id="modal-tambah" >
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#<?php echo $warna2; ?>;">
              <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-clipboard"></i> Tambah Data Buku</font></h4>
            </div>
            <form class="form-horizontal" action="tambah.php" method="POST" id="peranan" enctype="multipart/form-data">
              <div class="modal-body" >
                <div class="col-md-12">                
                  <div class="card card-info">                
                    <div class="card-body" class="bootstrap-timepicker">

                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Judul Buku </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="judul_buku" id="judul_buku" placeholder="Judul Buku" autofocus required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Penulis Buku </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="penulis_buku" id="penulis_buku" placeholder="Nama Penulis Buku" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">ISBN  </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Link </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="link" id="link" placeholder="Link" >
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="inputEmail3" class="col-sm-12 control-label">Sinopsis Buku </label> 
                          <textarea class="form-control" rows="4" name="sinopsis" id="sinopsis" placeholder="Sinopsis Buku ..." required></textarea>
                        </div>
                      </div>
                      
                    </div>
                    <div class="modal-footer justify-content-between" style="background-color:#e5eaf0;">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
                      <button type="submit" name="tambah" class="btn btn-secondary swalDefaultSuccess" style="background-color:#<?php echo $warna1; ?>"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->
      
       <div class="modal fade" id="modal-edit" >
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#<?php echo $warna2; ?>;">
              <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-clipboard"></i> Edit Data Buku</font></h4>
            </div>
            <form class="form-horizontal" action="edit.php" method="POST" id="peranan" enctype="multipart/form-data">
              <div class="modal-body" >
                <div class="col-md-12">                
                  <div class="card card-info">                
                    <div class="card-body" class="bootstrap-timepicker">

                          <input type="hidden" class="form-control" name="id" id="id" >
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Judul Buku </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="judul_buku" id="judul_buku" placeholder="Judul Buku" autofocus required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Penulis Buku </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="penulis_buku" id="penulis_buku" placeholder="Nama Penulis Buku" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">ISBN  </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="isbn" id="isbn" placeholder="ISBN" >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-sm-12 control-label">Link </label>
                        <div class="col-sm-12">
                          <input type="text" class="form-control" name="link" id="link" placeholder="Link" >
                        </div>
                      </div>                      
                      <div class="form-group row">
                        <div class="col-sm-12">
                          <label for="inputEmail3" class="col-sm-12 control-label">Sinopsis Buku </label> 
                          <textarea class="form-control" rows="4" name="sinopsis" id="sinopsis" placeholder="Sinopsis Buku ..." required></textarea>
                        </div>
                      </div>

                    </div>
                    <div class="modal-footer justify-content-between" style="background-color:#e5eaf0;">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
                      <button type="submit" name="edit" class="btn btn-secondary swalDefaultSuccess" style="background-color:#<?php echo $warna1; ?>;"><i class="fas fa-edit"></i> Edit</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->


      <div class="modal fade" id="modal-upload" >
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header" style="background-color:#<?php echo $warna2; ?>;">
              <h4 class="modal-title"><font color="#ffffff"><i class="fas fa-clipboard"></i> Upload Cover</font></h4>
            </div>
            <form class="form-horizontal" action="upload.php" method="POST" id="peranan" enctype="multipart/form-data">
              <div class="modal-body" >
                <div class="col-md-12">                
                  <div class="card card-info">                
                    <div class="card-body" class="bootstrap-timepicker">

                      <input type="text" class="form-control" name="id" id="id" value="id"  hidden>

                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-12 control-label">Pilih File </label>
                        <div class="col-sm-12">
                          <input type="file" class="form-control" name="foto" id="foto" accept="image/*" >
                        </div>
                      </div>
                      

                    </div>
                    <div class="modal-footer justify-content-between" style="background-color:#e5eaf0;">
                      <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-times"></i></button>
                      <button type="submit" name="upload" class="btn btn-secondary swalDefaultSuccess" style="background-color:#<?php echo $warna1; ?>"><i class="fas fa-upload"></i> Upload</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php 
  include "../4footer.php";
   ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../_aset/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../_aset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../_aset/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../_aset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../_aset/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../_aset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../_aset/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../_aset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../_aset/plugins/jszip/jszip.min.js"></script>
<script src="../_aset/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../_aset/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../_aset/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../_aset/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../_aset/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../_aset/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../_aset/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#cobatabel").DataTable(); 
     $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');   
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
</script>

<script type="text/javascript">
$('#modal-edit').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var id          = $(e.relatedTarget).data('id');
     var judul_buku         = $(e.relatedTarget).data('judul_buku');
     var penulis_buku        = $(e.relatedTarget).data('penulis_buku');
     var isbn  = $(e.relatedTarget).data('isbn');
     var link      = $(e.relatedTarget).data('link');
     var sinopsis      = $(e.relatedTarget).data('sinopsis');

    $(e.currentTarget).find('input[name="id"]').val(id);
    $(e.currentTarget).find('input[name="judul_buku"]').val(judul_buku);
    $(e.currentTarget).find('input[name="penulis_buku"]').val(penulis_buku);
    $(e.currentTarget).find('input[name="isbn"]').val(isbn);
    $(e.currentTarget).find('input[name="link"]').val(link);
    $(e.currentTarget).find('textarea[name="sinopsis"]').val(sinopsis);
      
   
});
</script>
<script type="text/javascript">
$('#modal-upload').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
     var id          = $(e.relatedTarget).data('id');  
    $(e.currentTarget).find('input[name="id"]').val(id);
      
   
});
</script>


</body>
</html>