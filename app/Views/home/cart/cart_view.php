
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

                    <tr>
                        <th>Nazwa</th>
                        <th>Ilość</th>
                        <th>Cena za sztukę</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < sizeof($data['cart']); $i++) {
                      ?>
                    
                    <td><?php echo $data['cart'][$i]->getProductName(); ?></td>
                    <td><?php echo $data['cart'][$i]->getProductQuantity(); ?></td>
                    <td><?php echo $data['cart'][$i]->getProductPrice(); ?> zł</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>