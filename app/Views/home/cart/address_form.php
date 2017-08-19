<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Podaj adres dostawy</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="http://sup.dev/SetAddress" role="form"> 

                        <div class="form-group">
                            <input type="text" name="name" class="form-control input-sm" placeholder="Imię" required>
                            <input type="text" name="surname"  class="form-control input-sm" placeholder="Nazwisko" required>
                            <input type="text" name="zipcode" class="form-control input-sm" placeholder="Kod pocztowy" required>
                            <input type="text" name="street"  class="form-control input-sm" placeholder="Ulica" required>
                            <input type="text" name="housenumber"  class="form-control input-sm" placeholder="Nr domu" required>
                            <input type="text" name="doorsnumber"  class="form-control input-sm" placeholder="Nr drzwi" required>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" name="remember">Ewentualny box</label>
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