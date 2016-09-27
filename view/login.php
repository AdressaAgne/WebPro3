@layout('layout.head')




<main class="login">
    
    
    <div class="register-screen">
        <div class="container">
            <h1 class="page-header underline center">Register</h1>
            
            
            <form action="" method="post" class="hidden-opacity" autocomplete="off">
                
                <label for="username">Username
                    <input class="accent" type="text" name="ball" placeholder="Username">
                </label>
                <label for="password">Password
                    <input class="accent" type="password" name="ball2" placeholder="Passwrod">
                </label>
                
            </form>
            
        </div>
    </div>
    <div class="login-screen">
         <div class="container">
            <h1 class="page-header underline underline-accent center">Login</h1>
        </div>
    </div>
    
    
</main>

<script>
    var reg = document.querySelector(".register-screen");
    var log = document.querySelector(".login-screen");
    
    reg.addEventListener('click', function(){
        reg.className = "register-screen active";
        log.className = "login-screen disable";
    });
    
    log.addEventListener('click', function(){
        reg.className = "register-screen disable";
        log.className = "login-screen active";
    });
    
</script>

</body>
</html>