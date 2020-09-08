<?php 
session_start();

if($_SESSION['session']){

  $username=$_SESSION['fullname'] ;
}
else{
header("location: login.php");
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
          <h1>Yazılar</h1>
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Anasayfa</a></li>
              <li class="breadcrumb-item active">Yazılar</li>
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
                <a href="articles.php" class="float-left">
                  <i class="nav-icon fas fa-list"></i>
                  Yazı Düzenle/Sil
                </a>
                <a href="add-article.php" class="btn btn-primary btn-sm float-right"><i class="nav-icon fa fa-plus"></i> Yazı Ekle</a>
              </div>
              <!-- /.card-header -->
        <div class="card-body">
            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="example1_length">
                <label>Show 
                <select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option></select> entries</label>
            </div>
        </div>
        <div class="col-sm-12 col-md-6">
            <div id="example1_filter" class="dataTables_filter">
                <label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1"></label>
                </div>
            </div>
        </div>
              <div class="row">
                  <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                  <thead>
                  <tr role="row">
                    <th style="text-align:center;"> # </th>
                    <th style="text-align:center;">Fotoğraf</th>
                    <th style="text-align:center;">Başlık</th>
                    <th style="text-align:center;">Kategori</th>
                    <th style="text-align:center;">Okunma Sayısı</th>
                    <th style="text-align:center;">Tarih</th>
                    <th style="text-align:center;">İşlemler</th>
                  </tr>
                  </thead>
                  <tbody> <?php

                $articles=$db->prepare("SELECT * FROM yazilar INNER JOIN kategoriler ON kategoriler.kategori_id=yazilar.yazi_kategori_id ORDER BY yazi_id DESC ");
                $articles->execute();
                $check_article=$articles->fetchAll(PDO::FETCH_ASSOC);
                $count_article=$articles->rowCount();
                if($count_article){
                    foreach($check_article as $row ){ ?>
                  <tr>
                    <td style="text-align:center;"><?php echo $row['yazi_id'];?></td>
                    <td style="text-align:center;"><img src="../blog/images/<?php echo $row['yazi_foto'];?>" alt="<?php echo $row['yazi_title'];?>" width="70px" height="50px" ></td>
                    <td style=""><?php echo $row['yazi_title'];?></td>
                    <td style="text-align:center;"><?php echo $row['kategori_title'];?></td>
                    <td style="text-align:center;"><?php echo $row['yazi_okunma'];?></td>
                    <td style="text-align:center;"><?php echo $row['yazi_tarih'];?></td>
                    <td style="text-align:center;">
                        <a href="edit-article.php?yazi_id=<?php echo $row['yazi_id'];?>"><button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Düzenle</button>
                        <a href="process.php?yazisil_id=<?php echo $row['yazi_id'];?>"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Sil</button>
                    </td>
                  </tr>
                  <?php }
                }else{
                  echo "<td colspan='5' style='text-align:center;'> Henüz yazılmış bir yazı yok...</td>";
                } ?>
                  </tbody>
                </table>
                <div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div>
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