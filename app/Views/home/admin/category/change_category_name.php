<?php
include __DIR__ . '/../../header_footer/admin_header.php'
?>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Nowa nazwa kategorii:</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://sup.dev/zatwierdz_zmiane" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input required type="text" name="name" id="first_name" class="form-control input-sm" placeholder="nazwa">
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
