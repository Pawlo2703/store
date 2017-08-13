<script>
    function minus(element) {
        $(document).ready(function () {
            var value = parseInt($(element).next().val());
            $(element).next().val(value - 1);
        });
    }

    function add(element, int) {
        $(document).ready(function () {
            var value = parseInt($(element).prev().val());
            $(element).prev().val(value + 1);
            if (value > (int - 1)) {
                $(element).prev().val(value = int);
            }

        });
    }

</script>
<!-- content -->
<div class="sally-content">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                    <div class="list-group">
                    </div>
                </ul>
            </div>
            <table class="table table-striped">
                <thead>
                <button type="button" value="checkEmail" onclick="checkEmail()" />Check availability</button>
                <tr>
                    <th>Nazwa</th>
                    <th>Ilość</th>
                    <th>Cena za sztukę</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $productManagement = $data['productManagement'];

                    for ($i = 0; $i < sizeof($data['cart']); $i++) {
                        echo '<tr><td>';
                        echo $data['cart'][$i]->getProductName();
                        $productManagement->loadProduct($data['cart'][$i]->getProductId());
                        $product_id = $data['cart'][$i]->getProductId();
                        echo '</td>';
                        echo '<td>';
                        ?>
                    <button type="button" value="-" onclick="minus(this)" />-</button>
                    <input type="text" value="<?php echo $data['cart'][$i]->getProductQuantity(); ?>" max="10" class='qty<?php echo $i ?>'/>
                    <button type="button" value="-" onclick="add(this, <?php echo $productManagement->getProductQuantity(); ?>)" />+</button>
                    <?php
                    echo "</td>";
                    echo "<td>";
                    echo $data['cart'][$i]->getProductPrice();
                    echo "zł";
                    echo "</td>";
                    echo "<td>";
                    echo "<a href=' http://" . ($_SERVER['HTTP_HOST']) . "/" . 'usun_z_koszyka' . "/" . "{$product_id}" . "'>usuń</a>";
                    echo "</td>";
                }
                echo "</td>";

                echo "</tr>";
                ?>
                </tbody>
            </table>
        </div>
    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>