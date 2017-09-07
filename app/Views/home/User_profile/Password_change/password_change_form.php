<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Zmień hasło</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://sup.dev/pwchange" role="form"> 

                        <div class="form-group">
                            <input type="password" name="password" class="form-control input-sm" placeholder="Stare Hasło" required>
                            <input type="password" name="newpassword" class="form-control input-sm" placeholder="Nowe hasło" required>
                            <input type="password" name="confirmpassword" class="form-control input-sm" placeholder="Powtórz nowe hasło" required>
                        </div>

                        <input type="submit" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../../header_footer/footer.php'
?>