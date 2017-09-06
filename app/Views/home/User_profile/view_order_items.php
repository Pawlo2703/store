
<!-- content -->

<div class="sally-content">
    <div class="container">
        <div class="row">
            <div class="container">
                <table class="table">

                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Ilość</th>
                            <th>Cena</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($data['ordersItems']); $i++) { {


                                echo "<tr>";
                                echo "<div class='col-md-1'>";
                                echo "<td> {$data['ordersItems'][$i]->getProductName()}</td>";
                                echo "<td> {$data['ordersItems'][$i]->getProductQuantity()}</td>";
                                echo "<td> {$data['ordersItems'][$i]->getProductPrice()}</td>";
                                echo "</div>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>