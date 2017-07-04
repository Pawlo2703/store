<?php
include __DIR__ . '/../../header_footer/admin_header.php'
?>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Plik graficzny jest zbyt duży, spróbuj ponownie.</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://sup.dev/zatwierdz_pro" enctype="multipart/form-data" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input required type="text" name="product" class="form-control input-sm" placeholder="nazwa">
                                    <input required type="text" name="type" class="form-control input-sm" placeholder="typ">
                                    <input required type="text" name="color" class="form-control input-sm" placeholder="kolor">
                                    <input required type="text" name="country" class="form-control input-sm" placeholder="kraj pochodzenia">
                                    <input required type="text" name="quantity" class="form-control input-sm" placeholder="ilość">
                                    <input required type="text" name="price" class="form-control input-sm" placeholder="cena">
                                    <input type="file" name="image" id="fileToUpload">
                                    <input type="submit" class="btn btn-info btn-block">
                                    </form>
                                    </br>
                                </div>
                            </div>

                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
