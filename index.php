<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6 lt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7 lt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8 lt8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>.::SISTEMA FACTURACION::.</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Login and Registration Form with HTML5 and CSS3" />
        <meta name="keywords" content="html5, css3, form, switch, animation, :target, pseudo-class" />
        <meta name="author" content="Codrops" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/login/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/login/style.css" />
	<link rel="stylesheet" type="text/css" href="css/login/animate-custom.css" />
    </head>
    <header align="center">
    <a href="#"><img src="imagenes/banner.jpg"></a>
    </header>
    <body background="imagenes/fondo.jpg"><br><br>
        <div class="container">
            <!-- Codrops top bar -->
            <div class="codrops-top">
                            
                <div class="clr"></div>
            </div><!--/ Codrops top bar -->
                <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form method="post" action="proceso.php" autocomplete="on"> 
                              
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > USUARIO </label>
                                    <input id="username" name="usuario" required type="text" placeholder="Escribir su nombre de usuario"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p">PASSWORD </label>
                                    <input id="password" name="clave" required type="password" placeholder="Escribir sus password" /> 
                                </p>
                                <input type="hidden" name="grabar" value="si" />
								
                                <p class="login button"> 
                                    <input type="submit" value="Login" onclick="document.form.submit();" /> 
								</p>
                               
                            </form>
                        </div>
 
						
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>

