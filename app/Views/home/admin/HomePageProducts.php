<?php
include __DIR__ . '/../header_footer/admin_header.php'
?>


<h2>Administrator Panel</h2>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                    <form action="http://sup.dev/savefrontproducts" method="post">
                        <tbody>
                            <?php
                            for ($i = 0; $i < sizeof($data['productCollection']); $i++) {

                                echo '<tr>';
                                echo "<td><label><input type='checkbox' value='{$data['productCollection'][$i]->getProductId()}' name='id[]'> {$data['productCollection'][$i]->getProductName()}";
                                echo '</tr>';
                            }
                            ?>
                        <input type="submit" name="submit" value="submit"></form> </tbody>
                        <tfoot>
                        <form action="http://sup.dev/removeFrontProducts" >
                            <button type="submit">Wyłącz</button></form>
                            <tr>
                                <td colspan="5" class="text-center">Data retrieved from <a href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a> and <a href="http://www.worldometers.info/world-population/population-by-country/" target="_blank">worldometers</a>.</td>
                            </tr>
                            </tfoot>
                            </table>
                            </div><!--end of .table-responsive-->
                            </div>
                            </div>
                            </div>

                            <p class = "p">Demo by George Martsoukos. <a href = "http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target = "_blank">See article</a>.</p>

                            </html>                            