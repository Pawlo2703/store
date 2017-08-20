
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

                            if ($data['category'][$i]->getIsAvailable() === 'turned on') {
                                echo "<a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria' . "/{$data['category'][$i]->getCategoryId()}' class='list-group-item'>"
                                . "{$data['category'][$i]->getCategoryName()}<span class='badge'>{$data['category'][$i]->getAmount()}</span></a>";
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>
            <div class="col-md-8">
                <?php
                for ($i = 0; $i < sizeof($data['product']); $i++) {
                    if ($data['product'][$i]->getIsAvailable() === 'turned on') {
                        echo "<div class='col-md-4'>";
                        echo "<img src='https://sup.dev/Shop/public/images/{$data['product'][$i]->getProductImage()}' class='sc-item-img img-responsive' />";
                        echo "<div class='text-center'><a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'produkt' . "/{$data['product'][$i]->getProductid()}'>"
                        . "{$data['product'][$i]->getProductName()}</a>";
                        echo "<p class='text-center'>{$data['product'][$i]->getProductPrice()} zł</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                ?>

            </div>
        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>