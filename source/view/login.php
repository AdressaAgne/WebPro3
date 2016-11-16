@layout('layout.head')
<main class="login">


    <div class="register-screen">
        <div class="container">
            <h1 class="page-header underline center">Register</h1>
            @if(isset($register_msg))
                <span class="error-msg">{{$register_msg}}</span>
            @endif
            @form('/register', 'put', ['class' => 'hidden-opacity'])
                <label for="username">Username
                    <input class="accent" type="text" name="username" placeholder="Username">
                </label>
                <label for="password">Password
                    <input class="accent" type="password" name="password" placeholder="Passwrod">
                </label>
                <label for="password">Confirm Password
                    <input class="accent" type="password" name="password_confirm" placeholder="Passwrod">
                </label>
                <label for="mail">Mail
                    <input class="accent" type="text" name="mail" placeholder="Mail">
                </label>

                <input type="hidden" name="_method" value="put" />
                <input type="submit" class="accent" value="Register">
            @formend()

        </div>
    </div>
    <div class="login-screen">
         <div class="container">
            <h1 class="page-header underline underline-accent center">Login</h1>
            @if(isset($login_msg))
                <span class="error-msg">{{$login_msg}}</span>
            @endif
            
            @form('', 'post', ['class' => 'hidden-opacity'])

                <label for="username">Username
                    <input type="text" name="username" placeholder="Username" value="">
                </label>
                <label for="password">Password
                    <input  type="password" name="password" placeholder="Passwrod">
                </label>
                <input type="checkbox" name="" id="remember" value="remember">
                <label class="checkbox accent" for="remember">Remember me</label>

                <input type="submit" value="Login">
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