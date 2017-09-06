
<!-- content -->

<div class="sally-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               <table class="table">
                    <thead>
                        <tr>
                            <th>Numer</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < sizeof($data['orders']); $i++) { {

                                echo "<tr>";
                                echo "<div class='col-md-1'>";
                                echo "<td><a href='http://" . ($_SERVER['HTTP_HOST']) . "/" . 'zamowienie' . "/{$data['orders'][$i]->getOrderId()}'>"
                                . "{$data['orders'][$i]->getOrderId()}</a></td>";
                                echo "<td>{$data['orders'][$i]->getStatus()}</td>";
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