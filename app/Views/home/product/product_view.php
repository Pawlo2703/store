
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
                                echo "<a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'kategoria' . "/{$data['category'][$i]->getCategoryId()}' class='list-group-item'>"
                                . "{$data['category'][$i]->getCategoryName()}<span class='badge'>{$data['category'][$i]->getAmount()}</span></a>";
                            }
                        }
                        ?>
                    </div>
                </ul>
            </div>

            <table class="table table-striped">
                <thead>
                <a href=<?php echo $data['navigation'] ?>>Product</a>
                <tr>
                    <th>nazwa</th>
                    <th>typ</th>
                    <th>kategoria</th>
                    <th>kolor</th>
                    <th>kraj pochodzenia</th>
                    <th>ilość</th>
                    <th>cena</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $data['product']['name']; ?></td>
                        <td><?php echo $data['product']['type']; ?></td>
                        <td><?php echo $data['categoryName']['name']; ?></td>
                        <td><?php echo $data['product']['color']; ?></td>
                        <td><?php echo $data['product']['country']; ?></td>
                        <td><?php echo $data['product']['quantity']; ?></td>
                        <td><?php echo $data['product']['price']; ?></td>
                        <td><?php $productId = $data['product']['id']; ?>
                            <form method="post" action="http://sup.dev/koszyk" role="form">

                                <div class="form-group">
                                    <input required type="text" name="amount" value="1" class="form-control input-sm" placeholder="ilość">
                                </div>

                                <input type="submit" class="btn btn-info btn-block" value="Dodaj produkt(y)">

                            </form>
                    </tr>
                </tbody>
            </table>

        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>