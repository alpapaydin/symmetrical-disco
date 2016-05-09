<html lang="en">
    <?php
        include 'connect.php';
    ?>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Alpino Dizayn Mağaza Kataloğu</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Alpino Dizayn</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Sipariş</a>
                    </li>
                    <li>
                        <a href="#">İletişim</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Ürünler</p>
                <div class="list-group">
                    <?php 

                        $result = mysqli_query($sqlconn,"SELECT * FROM kategoriler WHERE parentid is NULL");

                        while ($row = mysqli_fetch_array($result,MYSQL_NUM)) {                             
                    ?>
                            <a href=<?php echo "index.php?cat=".$row[0]; ?> class="list-group-item"><?php echo $row[1]; ?></a>
                    <?php
                            $result2 = mysqli_query($sqlconn,"SELECT * FROM kategoriler WHERE parentid=".$row[0]);

                            while ($row2 = mysqli_fetch_array($result2,MYSQL_NUM)) {
                                ?>
                            <a href=<?php echo "index.php?cat=".$row2[0]; ?> class="list-group-item"><?php echo "&#8226; ".$row2[1]; ?></a>
                                <?php
                            }


                        }
                    ?>
                </div>
            </div>
            <?php 

                if ( !isset($_GET['cat']) && !isset($_GET['show']) ) {

            ?>
            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                                <div class="item">
                                    <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <?php 

                        $result = mysqli_query($sqlconn,"SELECT * FROM urunler WHERE anasayfa=1");

                        while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {                             
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href=<?php echo "foto/".$row['ID']."/1.jpg" ?>  rel="lightbox"><img src=<?php echo "foto/".$row['ID']."/1.jpg" ?> alt=""></a>
                            <div class="caption">
                                <h4 class="pull-right"><?php echo number_format($row['fiyat'],0,',','.'); ?>₺</h4>
                                <h4><a href=<?php echo "index.php?show=".$row['ID']; ?>><?php echo mb_substr($row['isim'],0,16); 
                                if (strlen($row['isim'])>16) {
                                    echo "...";
                                }  ?></a>
                                </h4>   
                                <p>
                                <?php 
                                echo mb_substr($row['aciklama'],0,101); 
                                if (strlen($row['aciklama'])>101) {
                                    echo "...";
                                } 
                                ?>  
                                </p>
                            </div>
                            
                        </div>
                    </div>
                    <?php
                            }
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <h4><a href="#">Daha fazla ürün?</a>
                        </h4>
                        <p>Kalan ürünlerimize ulaşmak için sol kısımdaki kategorileri kullanabilirsiniz.<br><br>İlgilendiğiniz ürünlerle ilgili detaylı bilgi almak veya sipariş vermek için bize iletişim kısmından ulaşabilirsiniz.</p>
                    </div>

                </div>

            </div>
            <?php } elseif (isset($_GET['cat'])) { #kategoriye göre arama ?> 
                <div class="row">
                    <?php 
                        $subs = [];

                        $result2 = mysqli_query($sqlconn,"SELECT * FROM kategoriler WHERE parentid=".$_GET['cat']);
                        
                        while ($row2 = mysqli_fetch_array($result2,MYSQL_ASSOC)) {
                            $subs[] = $row2['id'];
                        }
                        
                        if(empty($subs)){
                        $query = "SELECT * FROM urunler WHERE kategoriid IN (".$_GET['cat'].")";
                            }else{
                                $query = "SELECT * FROM urunler WHERE kategoriid IN (".implode($subs,',').",".$_GET['cat'].")";
                            }
                        $result = mysqli_query($sqlconn,$query);

                        while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {                             
                    ?>
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <img src=<?php echo "foto/".$row['ID']."/1.jpg" ?> alt="">
                            <div class="caption">
                                <h4 class="pull-right"><?php echo number_format($row['fiyat'],0,',','.'); ?>₺</h4>
                                <h4><a href=<?php echo "index.php?show=".$row['ID']; ?>><?php echo mb_substr($row['isim'],0,29); #captions can be added here
                                if (strlen($row['isim'])>29) {
                                    echo "...";
                                }  ?></a>
                                </h4>
                                <p>
                                <?php 
                                echo mb_substr($row['aciklama'],0,101); 
                                if (strlen($row['aciklama'])>101) {
                                    echo "...";
                                } 
                                ?>  
                                </p>
                            </div>
                            
                        </div>
                    </div>

                    <?php
                            } 
                    ?>

                </div>

            <?php 

                } elseif (isset($_GET['show'])) { 


                        $result = mysqli_query($sqlconn,"SELECT * FROM urunler WHERE ID=".$_GET['show']);

                        while ($row = mysqli_fetch_array($result,MYSQL_ASSOC)) {                             
            

            ?>
            <div class="col-md-9">
                <div class="col-md-6">
                    <div class="col-md-9">
                    <h3><?php echo $row['isim'];?></h3>
                    </div>
                    <div class="col-md-3">
                    <h3><?php echo number_format($row['fiyat'],0,',','.'); ?>₺</h3>
                    </div>
                    <div class="col-md-12">
                    <div class="well">
                        <p><?php echo $row['aciklama'];?></p>
                    </div>
                    </div>
                </div>
                <div class="col-md-6">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                                <div class="item active">
                                    <a href=<?php echo "foto/".$row['ID']."/1.jpg" ?>  rel="lightbox"><img class="slide-image" src=<?php echo "foto/".$row['ID']."/1.jpg" ?>  alt=""></a>
                                </div>
                                <?php if(file_exists("foto/".$row['ID']."/2.jpg")) { ?>
                                <div class="item">
                                    <a href=<?php echo "foto/".$row['ID']."/2.jpg" ?>  rel="lightbox"><img class="slide-image" src=<?php echo "foto/".$row['ID']."/2.jpg" ?>  alt=""></a>
                                </div>
                                <?php } else {?>
                                <div class="item">
                                    <a href=<?php echo "foto/".$row['ID']."/1.jpg" ?>  rel="lightbox"><img class="slide-image" src=<?php echo "foto/".$row['ID']."/1.jpg" ?>  alt=""></a>
                                </div>  
                                <?php } ?>
                            </div>
                            
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                            
                        </div>
                    </div>
            </div>
            
            <?php
                }}
            ?>
        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Alpino Dizayn 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/prototype.js"></script>
    <script type="text/javascript" src="js/scriptaculous.js?load=effects"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
</body>

</html>
