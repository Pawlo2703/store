<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Zaloguj</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://sup.dev/zalogowano" role="form">
                
                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                            <input type="password" name="password" id="email" class="form-control input-sm" placeholder="Password" required>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" name="remember">Nie wylogowuj mnie</label>
                        </div>

                        <input type="submit" class="btn btn-info btn-block">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../header_footer/footer.php'
?>