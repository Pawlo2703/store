<script>
//    function checkEmail() {
//        $(document).ready(function () {
//            alert("test");
//        });
//    }

    function checkEmail() {
        $(document).ready(function () {
            $.ajax({
                method: "POST",
                url: "email_confirmation",
          //      url: "http://sup.dev/email_confirmation",
                data: {params: email},
                
               
            });
        });
    }
</script>
<div class="container">
    <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <center>  <h3 class="panel-title">Zarejestruj się</h3> </center>
                </div>
                <div class="panel-body">
                    <form method="post" action="submit" role="form">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="first_name" class="form-control input-sm" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="surname" id="last_name" class="form-control input-sm" placeholder="Last Name" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="email" name="email" id="email" class="form-control input-sm" placeholder="Email Address" required>
                            <button type="button" value="checkEmail" onclick="checkEmail()" />Check availability</button>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-sm" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-sm" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>

                        <div class="checkbox">
                            <label><input type="checkbox" required>Akceptuję warunki regulaminu</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="newsletter">Chcę otrzymywać Newsletter tygodniowy z super ofertami</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" required >Zapoznałem się z polityką prywatności. *</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox"required >Wyrażam zgodę na gromadzenie, przetwarzanie i wykorzystywanie 
                                przez sup.dev, moich danych osobowych, teraz i w przyszłości, zgodnie z polskim prawem,
                                w szczególności Ustawą z dnia 29.08.1997 r. o ochronie danych osobowych (tekst jedn. Dz.U. 
                                z 2002 r., Nr 101, poz. 926 z późn. zm.). sup.dev informuje, że użytkownik ma prawo wglądu
                                do swoich danych oraz ich poprawienia lub usunięcia. *</label>
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