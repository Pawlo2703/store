<?php
include __DIR__ . '/../../header_footer/admin_header.php'
?>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Dodaj nowy produkt</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="zatwierdz_pro" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="product" class="form-control input-sm" placeholder="nazwa">
                                    <input type="text" name="type" class="form-control input-sm" placeholder="typ">
                                    <input type="text" name="color" class="form-control input-sm" placeholder="kolor">
                                    <input type="text" name="country" class="form-control input-sm" placeholder="kraj pochodzenia">
                                    <input type="text" name="quantity" class="form-control input-sm" placeholder="ilość">
                                    <input type="text" name="price" class="form-control input-sm" placeholder="cena">
                                                            </br>
                                </div>
                            </div>

                        </div>

                        <input type="submit" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
