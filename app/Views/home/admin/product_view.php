<?php
include __DIR__ . '/../header_footer/admin_header.php'
?>


<h2>Administrator Panel</h2>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>                      
                        <tr><a href= <?php echo $data['categoryNavigation'] ?> >Category</a>-><a href= <?php echo $data['productNavigation'] ?> >Product</a>
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
                            <td> <?php echo $data['product']['name']; ?></td>
                            <td><?php echo $data['product']['type']; ?></td>
                            <td><?php echo $data['category']['name']; ?></td>
                            <td><?php echo $data['product']['color']; ?></td>
                            <td><?php echo $data['product']['country']; ?></td>
                            <td><?php echo $data['product']['quantity']; ?></td>
                            <td><?php echo $data['product']['price']; ?></td>
                        </tr>
                        <tr> <form method="post" action="http://sup.dev/zmiana_produktu" role="form">
                        <td><input type="text" name="name" placeholder="zmień nazwę"></td>
                        <td><input type="text" name="type" placeholder="zmień typ"></td>
                        <td><select name="category">
                                <option required style="display:none">Wybierz kategorię</option>
                                <?php
                                for ($i = 0; $i < sizeof($data['collection']); $i++) {
                                    echo "<option>{$data['collection'][$i]->getCategoryName()}</option>";
                                }
                                ?>

                            </select></td>
                        <td><input type="text" name="color" placeholder="zmień kolor"></td>
                        <td><input type="text" name="country" placeholder="zmień kraj"></td>
                        <td><input type="text" name="quantity" placeholder="zmień ilość"></td>
                        <td><input type="text" name="price" placeholder="zmień cenę"></td>

                        </tr>
                        </tbody>
                </table><input type="submit" class="btn btn-info btn-block">
            </div><!--end of .table-responsive-->
        </div>
    </div>
</div>

<p class="p">Demo by George Martsoukos. <a href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target="_blank">See article</a>.</p>

</html>