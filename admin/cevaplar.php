<?php 
session_start();

if($_SESSION['session']){

  $username=$_SESSION['fullname'] ;
}
else{
header("location: giris.php");
}


include("includes/header.php"); ?>
<?php 
include("includes/sidebar.php");?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <h1>Cevaplar</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Cevaplar</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <?php 

    if (isset($_GET['update'])){
                
      $update=$_GET['update'];

            if($update=="empty"){ ?>
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Dikkat!</h5>
            Lütfen boş alan bırakmayınız...
        </div>
            <?php }elseif($update=="no"){ ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Hata!</h5>
           Güncelleme işlemi yapılırken bir hata oluştu...
        </div>
            <?php }elseif($update=="yes"){ ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Tebrikler!</h5>
            Güncelleme işlemi başarıyla yapıldı...
        </div>
        <?php }
         } ?>
    </section>  
    
 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
            <div class="card card-primary">
              <div class="card-header">
                <a href="yorumlar.php" class="float-left">
                  <i class="nav-icon fas fa-check"></i>
                  Cevaplar
                </a>
              </div>
              <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="example1_length">
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div id="example1_filter" class="dataTables_filter">
                </div>
            </div>
        </div>
              <div class="row">
                  <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                    <th style="text-align:center;" title="Cevaplanan Yorum No"> C.Yorum No </th>
                    <th style="text-align:center;">Yorum Ekleyen</th>
                    <th style="text-align:center;">Yazı Konu</th>
                    <th style="text-align:center;">Tarih</th>
                    <th style="text-align:center;">İşlemler</th>
                  </tr>
                </thead>
            <tbody> 
            
            <?php
            $cevaplar=$db->prepare("SELECT * FROM yorumlar INNER JOIN yazilar ON yazilar.yazi_id=yorumlar.yorum_yazi_id WHERE yorum_ust!=0 ORDER BY yorum_id DESC ");
            $cevaplar->execute(array());
            $c_cek=$cevaplar->fetchAll(PDO::FETCH_ASSOC);
            $c_say=$cevaplar->rowCount();
            if($c_say){
                    foreach($c_cek as $row ){ ?>
            <tr>
            <td style="text-align:center;"><?php echo $row['yorum_ust'];?></td>
            <td style="text-align:center;"><?php echo $row['yorum_yapan'];?></td>
            <td style="text-align:center;"><?php echo $row['yazi_title'];?></td>
            <td style="text-align:center;"><?php echo $row['yorum_tarih'];?></td>
            <td style="text-align:center;">
                <a href="cevap_duzenle.php?yorum_id=<?php echo $row['yorum_id'];?>"><button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Düzenle</button>
                <a href="islem.php?cevapsil_id=<?php echo $row['yorum_id'];?>"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
            </td>
            </tr>
            <?php }
                }else{
                  echo "<td colspan='5' style='text-align:center;'> Henüz verilmiş bir cevap yok...</td>";
                } ?>
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
                  </div>
                  <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"></div>
                    </div>
                  </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<?php
include("includes/footer.php"); 
?>