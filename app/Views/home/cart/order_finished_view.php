
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
            <h2>Zamówienie nr: <b><?php echo $data['checkoutManagement']->getOrderId(); ?></b>.</br>
                Prosimy o przesłanie sumy <b><?php echo $data['checkoutManagement']->getOrderPrice(); ?></b> zł na numer konta: 50 0000 1111 2222 3333 0000. </h2>
        </div>


    </div>  
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>