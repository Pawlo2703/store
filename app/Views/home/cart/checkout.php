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
                <thead><a href="http://sup.dev/loginCheck" class="btn btn-success">Zapłać</a>
                    <tr>
                        <th>Nazwa</th>
                        <th>Ilość</th>
                        <th>Cena za sztukę</th>

                    </tr>
                </thead>
                <tbody>
                <h1>Podsumowanie:</h1>
                                   <?php
                    for ($i = 0; $i < sizeof($data['cartCollection']); $i++) {
                        echo '<tr><td>';
                        echo $data['cartCollection'][$i]->getProductName();
                        echo '</td>';
                        echo '<td>';
                        echo $data['cartCollection'][$i]->getProductQuantity();
                        echo "</td>";
                        echo "<td>";
                        echo $data['cartCollection'][$i]->getProductPrice();
                        echo "zł";
                        echo "</td>";
                    }
                    echo "</td>";

                    echo "</tr>";
                    ?>
                <thead>
                    <tr>
                        <th>Łącznie: </th>
                        <th><?php echo $data['product']->getTotalQuantity(); ?></th>
                        <th><?php echo $data['product']->getTotalPrice(); ?>zł</th>

                    </tr>
                </thead>
                                </table>
        </div>
    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>