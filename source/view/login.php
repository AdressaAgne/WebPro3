@layout('layout.head')
<main class="login">


    <div class="register-screen">
        <div class="container">
            <h1 class="page-header underline center">Registrer deg</h1>
            @if(isset($register_msg))
                <span class="error-msg">{{$register_msg}}</span>
            @endif
            @form('/register', 'put', ['class' => 'hidden-opacity'])
                <label for="username">Brukernavn
                    <input class="accent" type="text" name="username" placeholder="Brukernavn">
                </label>
                <label for="password">Passord
                    <input class="accent" type="password" name="password" placeholder="Passord">
                </label>
                <label for="password">Bekreft passord
                    <input class="accent" type="password" name="password_confirm" placeholder="Passord">
                </label>
                <label for="mail">Mail
                    <input class="accent" type="text" name="mail" placeholder="Mail">
                </label>

                <input type="hidden" name="_method" value="put" />
                <input type="submit" class="accent" value="Registrer">
            @formend()

        </div>
    </div>
    <div class="login-screen">
         <div class="container">
            <h1 class="page-header underline underline-accent center">Logg inn</h1>
            @if(isset($login_msg))
                <span class="error-msg">{{$login_msg}}</span>
            @endif
            
            @form('', 'post', ['class' => 'hidden-opacity'])

                <label for="username" class="form-margin">Brukernavn
                    <input type="text" name="username" placeholder="Brukernavn" value="">
                </label>
                <label for="password" class="form-margin">Passord
                    <input  type="password" name="password" placeholder="Passord">
                </label>
                <input type="checkbox" class="form-margin" name="remember" id="remember" value="remember">
                <label class="checkbox accent" for="remember">Husk meg</label>

                <input type="submit" value="Logg inn" class="form-margin">
            @formend()

        </div>
    </div>


</main>

<script>
    var reg = document.querySelector(".register-screen");
    var log = document.querySelector(".login-screen");

    @if(isset($username))
        reg.className = "register-screen disable";
        log.className = "login-screen active";
    @endif
    
    reg.addEventListener('click', function(){
        reg.className = "register-screen active";
        log.className = "login-screen disable";
    });

    log.addEventListener('click', function(){
        reg.className = "register-screen disable";
        log.className = "login-screen active";
    });

</script>

@layout('layout.scripts')