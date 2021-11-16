<?php include 'db_connect.php' ?>
<style>
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        top: 0;
    }

    .imgs {
        margin: .5em;
        max-width: calc(100%);
        max-height: calc(100%);
    }

    .imgs img {
        max-width: calc(100%);
        max-height: calc(100%);
        cursor: pointer;
    }

    #imagesCarousel,
    #imagesCarousel .carousel-inner,
    #imagesCarousel .carousel-item {
        height: 60vh !important;
        background: black;
    }

    #imagesCarousel .carousel-item.active {
        display: flex !important;
    }

    #imagesCarousel .carousel-item-next {
        display: flex !important;
    }

    #imagesCarousel .carousel-item img {
        margin: auto;
    }

    #imagesCarousel img {
        width: auto !important;
        height: auto !important;
        max-height: calc(100%) !important;
        max-width: calc(100%) !important;
    }
</style>

<div class="containe-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <?php echo "Welcome back " . $_SESSION['login_nama'] . "!"  ?>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card border-info">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"> <i class="fas fa-thermometer-half"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT suhu FROM ruangan")->num_rows ?>
                                            </b></h4>
                                        <p><b>Suhu Ruangan</b></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="index.php?page=ruangan" class="text-info float-right">View More <span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card border-info">
                                <div class="card-body bg-info">
                                    <div class="card-body text-white">
                                        <span class="float-right summary_icon"> <i class="fas fa-tint"></i></span>
                                        <h4><b>
                                                <?php echo $conn->query("SELECT kelembaban FROM ruangan")->num_rows ?>
                                            </b></h4>
                                        <p><b>Kelembaban Ruangan</b></p>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <a href="index.php?page=ruangan" class="text-info float-right">View More <span class="fa fa-angle-right"></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>