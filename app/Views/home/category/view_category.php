
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
                        $categoryList = $data['categoryList'];
                        for ($i = 0; $i < sizeof($categoryList); $i++) {
                            $categoryId = $categoryList[$i]['id'];
                            $categoryAmount = $categoryList[$i]['amount'];
                            $availability = $categoryList[$i]['is_available'];
                            $categoryName = $categoryList[$i]['name'];
                            if ($availability == 'turned on') {
                                echo "<a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria' . "/$categoryId' class='list-group-item'>$categoryName<span class='badge'>$categoryAmount</span></a>";
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>
            <div class="col-md-8">
                <?php
                $productsList = $data['productsList'];
                for ($i = 0; $i < sizeof($productsList); $i++) {
                    $productName = $productsList[$i]['name'];
                    $productPrice = $productsList[$i]['price'];
                    $productId = $productsList[$i]['id'];

                    echo "<div class='col-md-4'>";
                    echo "<img src='https://upload.wikimedia.org/wikipedia/commons/d/dd/Jab%C5%82ko_-_owoc.JPG' class='sc-item-img img-responsive' />";
                    echo "<div class='text-center'><a href=''>$productName</a>";
                    echo "<p class='text-center'>$productPrice zł</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>

            </div>
        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>