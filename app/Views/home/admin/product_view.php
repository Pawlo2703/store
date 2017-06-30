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
      <tr><?php echo $data['jUrl']; ?>
        <th>id</th>
        <th>nazwa</th>
        <th>kategoria</th>
        <th>kolor</th>
        <th>kraj pochodzenia</th>
        <th>ilość</th>
        <th>cenaa</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $data['product'][0]['id']; ?></td>
        <td><?php echo $data['product'][0]['name']; ?></td>
        <td><?php echo $data['category'][0]['name']; ?></td>
        <td><?php echo $data['product'][0]['color']; ?></td>
        <td><?php echo $data['product'][0]['country']; ?></td>
        <td><?php echo $data['product'][0]['quantity']; ?></td>
        <td><?php echo $data['product'][0]['price']; ?></td>
      </tr>
         </tbody>
  </table>
            </div><!--end of .table-responsive-->
        </div>
    </div>
</div>

<p class="p">Demo by George Martsoukos. <a href="http://www.sitepoint.com/responsive-data-tables-comprehensive-list-solutions" target="_blank">See article</a>.</p>

</html>