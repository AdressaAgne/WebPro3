@layout('layout.head')

	<main>
	    <section class="row primary-header" style="background-image: url('/assets/img/recipis/reindeer_large.jpg')">
            <h1 class="primary-header-text center">Rediger Din Profil</h1>
        </section>
		<section class="container">
            <div class="row row--line">
                <div class="col--right">
                    <ul class="list-simple--horisontal">
                        <li><a href="/profile">Profil</a></li>
                    </ul>
                </div>
            </div>
            
            
            <section class="row">
                
                <div class="col-6">
                    
                    @form('/profile/update', 'update')
                        <h2 class="page-header underline center">Endre Passord</h2>
                        
                        @if(isset($msg))
                            <span class="error-msg">{{ $msg }}</span>
                        @endif
                        
                        <div class="col-12">
                            <label for="">Gammelt Passord
                                <input type="password" name="old_pw" placeholder="Gammelt passord" class="dark">    
                            </label>
                        </div>
                        
                        <div class="col-12">
                            <label for="">Nytt Passord
                                <input type="password" name="new_pw" placeholder="Nytt passord" class="dark">    
                            </label>
                        </div>
                        
                        <div class="col-12">
                            <label for="">Gjenta Nytt Passord
                                <input type="password" name="new_pw2" placeholder="Gjenta Nytt passord" class="dark">    
                            </label>
                        </div>
                        
                        <div class="col-12">
                            <input type="submit" value="Endre">
                        </div>
                    @formend()
                    
                </div>
                <div class="col-6">
                    
                </div>
                
            </section>
            
		</section>
	<main>

@layout('layout.foot')
