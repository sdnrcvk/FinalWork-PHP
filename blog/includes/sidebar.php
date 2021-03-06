 </div> <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="search" class="search-form">
                <div class="form-group">
                  <span class="icon icon-search"></span>
                  <input type="text" class="form-control" name="search" placeholder="Search...">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
            	<h3 class="heading-sidebar">Categories</h3>
              <ul class="categories">
              <?php
            $categories=$db->prepare("SELECT * FROM kategoriler");
            $categories->execute();
            $check_categories=$categories->fetchAll(PDO::FETCH_ASSOC);
            foreach($check_categories as $row){
           
            $articles=$db->prepare("SELECT * FROM yazilar WHERE yazi_kategori_id=?");
            $articles->execute(array($row['kategori_id']));
            $check_articles=$articles->fetchAll(PDO::FETCH_ASSOC);
            $count_articles=$articles->rowCount(); ?>

                <li><a href="list_categories?kategori_id=<?php echo $row['kategori_id'];?>&sayfa=<?php echo $row['kategori_url'];?>"><?php echo $row['kategori_title'];?><span><?php echo $count_articles;?></span></a></li>
            <?php } ?>
              </ul>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3 class="heading-sidebar">Recent Blog</h3>
              <?php 
                $kategori_id=$_GET['kategori_id'];
                $articles=$db->prepare("SELECT * FROM yazilar INNER JOIN kategoriler ON kategoriler.kategori_id=yazilar.yazi_kategori_id ORDER BY yazi_id DESC LIMIT 3");
                $articles->execute();
                $check_articles=$articles->fetchAll(PDO::FETCH_ASSOC);
                foreach($check_articles as $row){
                  $comments=$db->prepare("SELECT * FROM yorumlar WHERE yorum_yazi_id=? AND yorum_durum=1");
                  $comments->execute(array($row['yazi_id']));
                  $comments->fetchAll(PDO::FETCH_ASSOC);
                  $comments->fetchAll(PDO::FETCH_ASSOC);
                  $count_comment=$comments->rowCount();
                ?>
              <div class="block-21 mb-4 d-flex">
                <a href="single?yazi_id=<?php echo $row['yazi_id'];?>&kategori_id=<?php echo $row['kategori_id'];?>" class="blog-img mr-4" alt="<?php echo $row['yazi_title'];?>" style="background-image: url(images/yazilar/<?php echo $row['yazi_foto'];?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="single?yazi_id=<?php echo $row['yazi_id'];?>&kategori_id=<?php echo $row['kategori_id'];?>"><?php echo $row['yazi_title'];?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span><?php echo $row['yazi_tarih'];?></a></div>
                    <div><a href="#"><span class="icon-person"></span><?php echo $row['yazi_yazan'];?></a></div>
                    <div><a href="#"><span class="icon-chat"></span><?php echo $count_comment ;?></a></div>
                  </div>
                </div> 
              </div> <?php } ?>
            </div>
            
            <!--Related post-->
            <div class="sidebar-box ftco-animate">
              <h3 class="heading-sidebar">Related Post</h3>
                  
                <?php 
                $kategori_id=$_GET['kategori_id'];
                $articles=$db->prepare("SELECT * FROM yazilar INNER JOIN kategoriler ON kategoriler.kategori_id=yazilar.yazi_kategori_id WHERE kategori_id=? ORDER BY yazi_id DESC LIMIT 3");
                $articles->execute(array($kategori_id));
                $check_articles=$articles->fetchAll(PDO::FETCH_ASSOC);
                foreach($check_articles as $row){ 
                  $comments=$db->prepare("SELECT * FROM yorumlar WHERE yorum_yazi_id=? AND yorum_durum=1");
                  $comments->execute(array($row['yazi_id']));
                  $comments->fetchAll(PDO::FETCH_ASSOC);
                  $comments->fetchAll(PDO::FETCH_ASSOC);
                  $count_comment=$comments->rowCount();
                  ?>
              
              <div class="block-21 mb-4 d-flex">
                <a href="single?yazi_id=<?php echo $row['yazi_id'];?>&kategori_id=<?php echo $row['kategori_id'];?>" class="blog-img mr-4" alt="<?php echo $row['yazi_title'];?>" style="background-image: url(images/yazilar/<?php echo $row['yazi_foto'];?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="single?yazi_id=<?php echo $row['yazi_id'];?>&kategori_id=<?php echo $row['kategori_id'];?>"><?php echo mb_strimwidth($row['yazi_title'],0,20,"...");?></a></h3>
                  <div class="meta">
                    <a href="list_categories?kategori_id=<?php echo $row['kategori_id'];?>" class="mr-2" title="<?php echo $row['kategori_title'];?>"><?php echo $row['kategori_title'];?></a>
                    <div><a href="#"><span class="icon-calendar"></span><?php echo $row['yazi_tarih'];?></a></div>
                    <div><a href="#"><span class="icon-person"></span><?php echo $row['yazi_yazan'];?></a></div>
                    <div><a href="#"><span class="icon-chat"></span><?php echo $count_comment ;?></a></div>
                  </div>
                </div> 
              </div> <?php } ?> 
            </div>
            
            </div>
        </div>
      </div>
    </section> <!-- .section -->