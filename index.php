<?php
include 'includes/functions.php';
put_head("eHostel :: Home", null, false);
include 'includes/nav.php';
?>
<div class="container-fluid">
    <h1 align="center">Welcome to eHostel Management System</h1>
    <hr>
    <div class="col-md-9">
        <!-- the carasoule -->
        <div class="row">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <?php
                $sql = "SELECT * FROM eh_banners";
                $query = mysqli_query(Database::getConnection(), $sql);
                $banners = array();
                while ($row = mysqli_fetch_assoc($query)) {
                    array_push($banners, $row);
                }
                ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php
                    for ($i = 0; $i < count($banners); $i++):
                        if ($i == 0):
                            ?>
                            <li data-target="#myCarousel" data-slide-to="<?= $i ?>" class="active"></li>
                        <?php endif; ?>
                        <li data-target="#myCarousel" data-slide-to="<?= $i ?>"></li>
                        <?php
                    endfor;
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                    for ($i = 0; $i < count($banners); $i++):
                        if ($i == 0):
                            ?>
                            <div class="item active">
                                <img src="<?= base_url($banners[$i]['banner_url']); ?>" alt="<?= $banners[$i]['banner_caption'] ?>" style="height: 450px;width: 100%;">
                            </div>
                         <?php endif; ?>
                        <div class="item">
                            <img src="<?= base_url($banners[$i]['banner_url']); ?>" alt="<?= $banners[$i]['banner_caption'] ?>" style="height: 450px;width: 100%;">
                        </div>
                        <?php
                    endfor;
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>

                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">News and Updates</h3>
            </div>
            <div class="panel-body" style="padding-left:30px;height:410px;">
                <marquee behavior="scroll" direction="up" onmouseout="this.start()" onmouseover="this.stop()" style="height: 100%;">
                    <?php 
                        $sql="SELECT * FROM `eh_updates` ORDER BY `eh_updates`.`creation_date` DESC";
                        $query=mysqli_query(Database::getConnection(),$sql);
                        if ($query->num_rows>0) {
                            while ($row=mysqli_fetch_assoc($query)) {
                                echo "<li><a href='".base_url('update.php?update_id='.$row['update_id'])."'>".$row['title']."</a></li><br>";
                            }
                        }
                        else{
                            echo "<li>No New Updates</li>";
                        }
                    ?>
                </marquee>
            </div>
        </div>
    </div>
</div>
<?php
    put_footer(true,null);
?>