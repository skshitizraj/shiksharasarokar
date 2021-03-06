
<?php
include('include/home_header.php');
 ?>

      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0">
          <h1 class="display-4 font-italic"> Title </h1>
          <p class="lead my-3">kachyang kuchung jindabad</p>
          <p class="lead mb-0"><a href="" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>
      
      <div class="row mb-2">
      <?php 
        include('db/connection.php');
    
        $query=mysqli_query($conn,"select * from news order by id desc limit 1,2");
        while($row=mysqli_fetch_array($query)){

        ?>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
              <strong class="d-inline-block mb-2 text-primary"><?php echo $row['category'];?></strong>
              <h3 class="mb-0">
                <a class="text-dark" onclick="removeday()"  href="single_news.php?single=<?php echo $row["id"];  ?>"> <?php echo $row['title'];?></a>
              </h3>
              <div class="mb-1 text-muted"><?php echo $row['date'];?></div>
              <p class="card-text mb-auto"><?php echo substr( $row['description'],0,300);?></p>
              <a href="single_news.php?single=<?php echo $row["id"];  ?>">Continue reading</a>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Card image cap">
          </div>
        </div>

    <?php } ?>

    <main role="main" class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
            From the Firehose
          
        </h3>

        <?php 
        include('db/connection.php');
            $page=(isset($_GET['page']) ? $_GET['page'] : null); 
            if($page=="" || $page=="1"){
                $page1=0;
            }else{
                $page1=($page*4)-4;
            }

        $query=mysqli_query($conn,"select * from news limit $page1,4");
        while($row=mysqli_fetch_array($query)){

        ?>
          <div class="blog-post"> 
            <h2 class="blog-post-title"><a class="text-dark" href="single_news.php?single=<?php echo $row["id"];  ?>">  <?php echo $row['title'];?>  </a></h2>
            <p class="blog-post-meta"><?php echo date("F jS,y",strtotime($row['date']));?></p>
            <p class="blog-post-meta"></p><img  style="width:50%;height:50%" class="img img-thumbnail" src="images/<?php echo $row['thumbnail'];?>" ></p>
            

            <p><?php echo substr( $row['description'],0,300);?></p>
            <a class="btn btn-outline-primary" href="single_news.php?single=<?php echo $row["id"];  ?>">Read More</a>
            
          </div><!-- /.blog-post -->

          <?php } ?>

          <ul class="pagination">
            <li class="page-item disabled">
            <a href="#" class="page-link">Prev </a> </li>
        <?php

            $sql= mysqli_query($conn,"select * from news");
            $count=mysqli_num_rows($sql);
            $a=$count/4;
            ceil($a);
            for($b=1;$b<=$a;$b++){
                ?>
            
                <li class="page-item"><a class="page-link" href="news_home.php?page=<?php echo $b;?>"
            ><?php echo $b; ?></a></li>
            <?php } ?>
                    <li class="page-item disabled">
                            <a href="#" class="page-link">Next </a> </li>
                        </ul>

        </div><!-- /.blog-main -->



        <?php
      include('include/home_footer.php');
      ?>