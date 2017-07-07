
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

            <table class="table table-striped">
                <thead>
                    <tr><?php echo $data['jUrl']; ?>
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
                        <td><?php echo $data['product'][0]['name']; ?></td>
                        <td><?php echo $data['product'][0]['type']; ?></td>
                        <td><?php echo $data['category'][0]['name']; ?></td>
                        <td><?php echo $data['product'][0]['color']; ?></td>
                        <td><?php echo $data['product'][0]['country']; ?></td>
                        <td><?php echo $data['product'][0]['quantity']; ?></td>
                        <td><?php echo $data['product'][0]['price']; ?></td>
                        <td><?php $productId = $data['product'][0]['id'];
                        echo "<a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'koszyk' . "/$productId/' class='btn btn-success'>Dodaj do koszyka</a></td>";
                 ?>   </tr>
                </tbody>
            </table>

        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>