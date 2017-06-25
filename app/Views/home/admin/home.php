<?php
include __DIR__ . '/../header_footer/admin_header.php'
?>


<h2>Administrator Panel</h2>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table  class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data['cat']->getName() as $row) {
                            echo '<tr>';
                            foreach ($row as $item) {
                                echo "<td><a href='{$item}'>{$item}</a></td>";
                            }
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">Data retrieved from <a href="http://www.infoplease.com/ipa/A0855611.html" target="_blank">infoplease</a> and <a href="http://www.worldometers.info/world-population/population-by-country/" target="_blank">worldometers</a>.</td>
                        </tr>
                    </tfoot>
                </table>
            </div><!--end of .table-responsive-->
        </div>
    </div>
</div>

<p class="p">Demo by George Martsoukos. <a href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target="_blank">See article</a>.</p>

</html>