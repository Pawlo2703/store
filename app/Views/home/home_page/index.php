<!-- slider -->

<div class="sup-slider">
    <div class="container">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="http://www.nwproduction.se/portals/nwproduction/portugese/front_ban_iceland_foreveryoursdeposit1440x689.jpg" alt="...">
                </div>
                <div class="item">
                    <img src="https://irp-cdn.multiscreensite.com/e1f6a649/dms3rep/multi/desktop/481093617-6400x3874.jpg" alt="...">
                </div>
                <div class="item">
                    <img src="https://www.fluentin3months.com/wp-content/uploads/2015/11/icelandic.jpg" alt="...">
                </div>
            </div>


            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<!-- content -->

<div class="sally-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <div class="list-group">
                        <a href="#" class="list-group-item disabled">
                            Owoce:
                        </a>
                        <?php
                        for ($i = 0; $i < sizeof($data['category']); $i++) {
                            if ($data['category'][$i]->getIsAvailable() == 'turned on') {
                                echo "<a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria' . "/{$data['category'][$i]->getCategoryId()}' "
                                . "class='list-group-item'>{$data['category'][$i]->getCategoryName()}<span class='badge'>{$data['category'][$i]->getAmount()}</span></a>";
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>
            <div class="col-md-8">
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG" class="sc-item-img img-responsive" />
                    <div class="text-center"><a href="#">APL</a>
                        <p class="text-center">$ 290.00</p>
                    </div>
                </div>
            </div>


        </div>  
    </div>

    <?php
    include __DIR__ . '/../header_footer/footer.php'
    ?>