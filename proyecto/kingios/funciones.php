<?php

//Definición de parámetros de acceso a la base de datos

define ("SERVIDOR","localhost");
define ("USUARIO","kingios");
define ("PASSWORD","kingios1");
define ("BASEDATOS","kingios_bd");

function conectarBD() {
    $conexion = mysqli_connect(SERVIDOR,USUARIO,PASSWORD,BASEDATOS);

    if (!$conexion){
        echo "Se ha producido un error en la conexión";
        return false;
    }

    return $conexion;
}

function desconectarBD ($conexion){
    mysqli_close($conexion);
}

function generarFormularioLogin(){
    echo " 
    <section class='section colored' id='contact-us'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Login</h2>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->
                <div>
                    <div class='contact-form'>
                        <form id='contact' action='./usuario.php' method='post'>
                        <div class='row'>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='nickname' type='text' class='form-control' id='nickname' placeholder='User Name' required=''>
                            </fieldset>
                            </div>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='passwd' type='password' class='form-control' id='passwd' placeholder='Password' required=''>
                            </fieldset>
                            </div>
                            <div class='col-lg-12'>
                            <fieldset>
                                <button type='submit' id='form-submit' class='main-button'>Login</button>
                            </fieldset>
                            </div>
                        </div>
                        </form>
                    <div>
                            <p>Create an account if you don't have one. <a href='./register.php'>Create an account.</a></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
            ";
}

function generarFormularioRegistro(){

    echo " 
    <section class='section colored' id='contact-us'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Register</h2>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div>
                    <div class='contact-form'>
                        <form id='contact' action='./insertardatos.php' method='post'>
                        <div class='row'>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='nickname' type='text' class='form-control' id='nickname' placeholder='User Name' required=''>
                            </fieldset>
                            </div>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='nombre_completo' type='text' class='form-control' id='nombre_completo' placeholder='Full Name' required=''>
                            </fieldset>
                            </div>
                <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='mail' type='text' class='form-control' id='mail' placeholder='Mail' required=''>
                            </fieldset>
                            </div>
                <div class='col-lg-6 col-md-12 col-sm-12'>
                            <fieldset>
                                <input name='passwd' type='password' class='form-control' id='passwd' placeholder='Password' required=''>
                            </fieldset>
                            </div>
                            <div class='col-lg-12'>
                            <fieldset>
                                <button type='submit' id='form-submit' class='main-button'>Register</button>
                            </fieldset>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
            ";
}

function registrarUsuario(){
    $con = conectarBD();
    $nickname = $_POST['nickname'];
    $nombre_completo = $_POST['nombre_completo'];
    $mail = $_POST['mail'];
    $passwd = $_POST['passwd'];

    //Creamos la consulta
    $inserccion = "INSERT INTO usuario (nickname,nombre_completo,mail,passwd) VALUES (?,?,?,?)";

    //Ciframos la contraseña
    $passwd_cifrada = password_hash($passwd,PASSWORD_DEFAULT);

    //Conectamos a la BD y ejecutamos la consulta
    $con;
    $sentencia = mysqli_prepare($con,$inserccion);

    //Asignamos los datos a los parametros de la sentencia
    mysqli_stmt_bind_param($sentencia,"ssss",$nickname,$nombre_completo,$mail,$passwd_cifrada);

    //Ejecutamos la inserccion
    if (mysqli_stmt_execute($sentencia)){
        $_SESSION['nickname'] = $nickname;
        $_SESSION['logeado'] = true;
        $ruta = getcwd();
        mkdir($ruta."/users/".$nickname."/", 0777, true);
    }else{
        echo "Ocurrio un problema";
    }
}

function generarEncabezadoHTML($titulo){
    echo "
    <html lang='es'>
     <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <meta name='description' content='KingiosServices'>
        <meta name='author' content='Daniel Salomon Gimeno'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900' rel='stylesheet'>

        <title>$titulo</title>

        <!-- Additional CSS Files -->
        <link rel='stylesheet' type='text/css' href='assets/css/bootstrap.min.css'>

        <link rel='stylesheet' type='text/css' href='assets/css/font-awesome.css'>

        <link rel='stylesheet' href='assets/css/templatemo-softy-pinko.css'>
     </head>
          ";
}

function generarHeaderHTML($logeado){
   if (!$logeado){
    echo "
    <body>    
    <!-- ***** Header Area Start ***** -->

    <header class='header-area header-sticky'>
        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <nav class='main-nav'>
                        <!-- ***** Logo Start ***** -->
                        <a href='index.php' class='logo'>
                            <img src='assets/images/logo.png' alt='Kingio's Services' height='55px' width='140px'/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class='nav'>
                            <li><a href='./index.php' class='active'>Home</a></li>
                            <li><a href='#features'>About</a></li>
                            <li><a href='#work-process'>Work Process</a></li>
                            <li><a href='https://tienda.kingios.es'>Shop</a></li>
                            <li><a href='https://blog.kingios.es'>Blog</a></li>
                            <li><a href='#contact-us'>Contact Us</a></li>
                            <li><a href='./login.php'>Login</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    ";
   }else{
    echo "
    <body>    
    <!-- ***** Header Area Start ***** -->

    <header class='header-area header-sticky'>
        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <nav class='main-nav'>
                        <!-- ***** Logo Start ***** -->
                        <a href='index.php' class='logo'>
                            <img src='assets/images/logo.png' alt='Kingio's Services' height='55px' width='140px'/>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class='nav'>
                            <li><a href='./index.php' class='active'>Home</a></li>
                            <li><a href='#features'>About</a></li>
                            <li><a href='#work-process'>Work Process</a></li>
                            <li><a href='https://tienda.kingios.es'>Shop</a></li>
                            <li><a href='https://blog.kingios.es'>Blog</a></li>
                            <li><a href='https://mail.kingios.es'>WebMail</a></li>
                            <li><a href='./areapersonal.php'>Personal Area</a></li>
                            <li><a href='./cerrarsesion.php'>Logout</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    ";
   }
}

function generarBodyHTML(){
    echo "
    <!-- ***** Welcome Area Start ***** -->
    <div class='welcome-area' id='welcome'>

        <!-- ***** Header Text Start ***** -->
        <div class='header-text'>
            <div class='container'>
                <div class='row'>
                    <div class='offset-xl-3 col-xl-6 offset-lg-2 col-lg-8 col-md-12 col-sm-12'>
                        <h1>Bienvenidos a<br><strong>Kingio's Services</strong></h1>
                        <p>Bienvenidos a <strong>Kingio's Services</strong>, tu empresa lider en servicios informáticos.</p>
                        <a href='#features' class='main-button-slider'>Saber Más</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ***** Header Text End ***** -->
    </div>
    <!-- ***** Welcome Area End ***** -->

    <!-- ***** Features Small Start ***** -->
    <section class='section home-feature'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='row'>
                        <!-- ***** Features Small Item Start ***** -->
                        <div class='col-lg-4 col-md-6 col-sm-6 col-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.2s'>
                            <div class='features-small-item'>
                                <div class='icon'>
                                    <i><img src='assets/images/softdev.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Desarrollo de Software</h5>
                                <p>Desarrollamos todo tipo de aplicaciones a medida de tus peticiones, entra y echa un vistazo a nuestro desarrollo.</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class='col-lg-4 col-md-6 col-sm-6 col-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.4s'>
                            <div class='features-small-item'>
                                <div class='icon'>
                                    <i><img src='assets/images/redes.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Redes</h5>
                                <p>Elige la distribución de red, el numero de equipos y la velocidad que necesites. O consultanos sobre tu red.</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class='col-lg-4 col-md-6 col-sm-6 col-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.6s'>
                            <div class='features-small-item'>
                                <div class='icon'>
                                    <i><img src='assets/images/servicios-it.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Soluciones Empresa</h5>
                                <p>Dinos lo que necesitas, y te harémos presupuesto para tener una empresa perfectamente informatizada.</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Small End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class='section padding-top-70 padding-bottom-0' id='features'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-5 col-md-12 col-sm-12 align-self-center' data-scroll-reveal='enter left move 30px over 0.6s after 0.4s'>
                    <img src='assets/images/left-image.png' class='rounded img-fluid d-block mx-auto' alt='App'>
                </div>
                <div class='col-lg-1'></div>
                <div class='col-lg-6 col-md-12 col-sm-12 align-self-center mobile-top-fix'>
                    <div class='left-heading'>
                        <h2 class='section-title'>Atención personalizada</h2>
                    </div>
                    <div class='left-text'>
                        <p>No una simple charla por telefono, contactanos y prepararemos una cita presencial
                        para resolver todas tus dudas y escuchar tus necesidades. El trato personal es esencial
                        en nuestra empresa.</p>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='hr'></div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Features Big Item Start ***** -->
    <section class='section padding-bottom-100'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-6 col-md-12 col-sm-12 align-self-center mobile-bottom-fix'>
                    <div class='left-heading'>
                        <h2 class='section-title'>Te ayudamos a informatizar tu negocio</h2>
                    </div>
                    <div class='left-text'>
                        <p>Te ayudamos a pasar tu negocios a las nuevas tecnologías. Ofrecemos
                        todo tipo de servicio de informatización, desde páginas web hasta la configuración
                        de servidores para la informatización de tu negocio. La informática te hace la vida mas fácil.</p>
                    </div>
                </div>
                <div class='col-lg-1'></div>
                <div class='col-lg-5 col-md-12 col-sm-12 align-self-center mobile-bottom-fix-big' data-scroll-reveal='enter right move 30px over 0.6s after 0.4s'>
                    <img src='assets/images/right-image.png' class='rounded img-fluid d-block mx-auto' alt='App'>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Features Big Item End ***** -->

    <!-- ***** Home Parallax Start ***** -->
    <section class='mini' id='work-process'>
        <div class='mini-content'>
            <div class='container'>
                <div class='row'>
                    <div class='offset-lg-3 col-lg-6'>
                        <div class='info'>
                            <h1>Como Trabajamos</h1>
                            <p>A continuación te hacemos un pequeño esquema de nuestro proceso de trabajo.</p>
                        </div>
                    </div>
                </div>

                <!-- ***** Mini Box Start ***** -->
                <div class='row'>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Ideas</strong>
                            <span>Escuchamos tus ideas y tus necesidades.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Discusión</strong>
                            <span>Te decimos ofrecemos nuestras opinión sobre tus ideas.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Revisión</strong>
                            <span>Revisamos las propuestas en conclusión</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Aprobación</strong>
                            <span>Una vez claras las ideas y revisadas, se aprueba el plan.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Launch</strong>
                            <span>Es hora de poner tu proyecto en marcha.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                    <a href='#' class='mini-box'>
                        <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                        <strong>Mejora</strong>
                        <span>Tu negocio esta listo e informatizado.</span>
                    </a>
                </div>
                </div>
                <!-- ***** Mini Box End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Home Parallax End ***** -->

    <!-- ***** Testimonials Start ***** -->
    <section class='section' id='testimonials'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>¿Que dicen nuestros clientes?</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Vamos a echar un vistazo a lo que dicen algunos de nuestros clientes sobre nuestro servicio.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class='row'>
                <!-- ***** Testimonials Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='team-item'>
                        <div class='team-content'>
                            <i><img src='assets/images/testimonial-icon.png' alt=''></i>
                            <p>Gracias a Kingio's service pude conectar todas las sedes de mis empresas. 
                            Trato espectacular y trabajo profesional.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>Catherine Richards</h3>
                                <span>Catherine Soft</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
                
                <!-- ***** Testimonials Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='team-item'>
                        <div class='team-content'>
                            <i><img src='assets/images/testimonial-icon.png' alt=''></i>
                            <p>Antes me costaba captar clientes, pero desde que Kingio's Services me hizo la página web, 
                            mis ventas han subido un 47%.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>Kelvin Wood</h3>
                                <span>Curtidos Abelardo</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
                
                <!-- ***** Testimonials Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='team-item'>
                        <div class='team-content'>
                            <i><img src='assets/images/testimonial-icon.png' alt=''></i>
                            <p>Ahora con el despliegue de nuevos servidores y bases de datos,
                            podemos levar una contabilidad y control de las castañas recogidas en la temporada.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>David Martin</h3>
                                <span>Castañas ORG</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Testimonials End ***** -->

    <!-- ***** Counter Parallax Start ***** -->
    <section class='counter'>
        <div class='content'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-bottom'>
                            <strong>99</strong>
                            <span>Projectos</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-top'>
                            <strong>63</strong>
                            <span>Clientes Satisfechos</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-bottom'>
                            <strong>4</strong>
                            <span>Premios Ganados</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item'>
                            <strong>2</strong>
                            <span>Países</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Counter Parallax End ***** -->   

    <!-- ***** Contact Us Start ***** -->
    <section class='section colored' id='contact-us'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Habla con nosotros</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Rellena este formulario con tus nombre y tu email y escribenos un mensaje. 
                        Te leeremos y nos pondremos en contanto contigo lo antes posible.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class='row'>
                <!-- ***** Contact Text Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <h5 class='margin-bottom-30'>Mantengamos el contacto</h5>
                    <div class='contact-text'>
                        <p>El horario de contacto es:<br>
                        <strong>De Lunes a Viernes</strong><br>
                        <strong>De 9:00 a 19:00</strong>
                        </p>
                    </div>
                </div>
                <!-- ***** Contact Text End ***** -->

                <!-- ***** Contact Form Start ***** -->
                <div class='col-lg-8 col-md-6 col-sm-12'>
                    <div class='contact-form'>
                        <form id='contact' action='' method='get'>
                          <div class='row'>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                              <fieldset>
                                <input name='name' type='text' class='form-control' id='name' placeholder='Full Name' required=''>
                              </fieldset>
                            </div>
                            <div class='col-lg-6 col-md-12 col-sm-12'>
                              <fieldset>
                                <input name='email' type='email' class='form-control' id='email' placeholder='E-Mail Address' required=''>
                              </fieldset>
                            </div>
                            <div class='col-lg-12'>
                              <fieldset>
                                <textarea name='message' rows='6' class='form-control' id='message' placeholder='Your Message' required=''></textarea>
                              </fieldset>
                            </div>
                            <div class='col-lg-12'>
                              <fieldset>
                                <button type='submit' id='form-submit' class='main-button'>Enviar Mensaje</button>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <!-- ***** Contact Form End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Contact Us End ***** -->
    
    <!-- jQuery -->
    <script src='assets/js/jquery-2.1.0.min.js'></script>

    <!-- Bootstrap -->
    <script src='assets/js/popper.js'></script>
    <script src='assets/js/bootstrap.min.js'></script>

    <!-- Plugins -->
    <script src='assets/js/scrollreveal.min.js'></script>
    <script src='assets/js/waypoints.min.js'></script>
    <script src='assets/js/jquery.counterup.min.js'></script>
    <script src='assets/js/imgfix.min.js'></script> 
    
    <!-- Global Init -->
    <script src='assets/js/custom.js'></script>
    ";
}

function generarFooterHTML(){
    echo "
        <!-- ***** Footer Start ***** -->
        <footer>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-12 col-md-12 col-sm-12'>
                        <ul class='social'>
                            <li><a href='https://www.facebook.com'><i class='fa fa-facebook'></i></a></li>
                            <li><a href='https://twitter.com'><i class='fa fa-twitter'></i></a></li>
                            <li><a href='https://www.linkedin.com'><i class='fa fa-linkedin'></i></a></li>
                            <li><a href='https://feedly.com'><i class='fa fa-rss'></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <p class='copyright'>Copyright &copy; 2020 Kingio's S.A.</p>
                    </div>
                </div>
            </div>
        </footer>
    ";
}

function generarCierreHTML(){
    echo "
        </body>
        </html>";
}

function comprobarUsuario(){
    $usuario = $_POST['nickname'];
    $pass = $_POST['passwd'];
    $con = conectarBD();
    $sql = "SELECT passwd FROM usuario WHERE nickname = ?";

    //Se prepara la sentencia 
    $sentencia = mysqli_prepare($con,$sql);

    //Se asocian los parámetros a la sentencia y se ejecuta la misma
    mysqli_stmt_bind_param($sentencia,"s",$usuario);
    mysqli_stmt_bind_result($sentencia,$pass_cifrado);
    mysqli_stmt_execute($sentencia);

    //Se mueve a la siguiente fila del conjunto de resultados, en este caso solamente uno.
    mysqli_stmt_fetch($sentencia);

    //Se comprueba que la contraseña sea correcta
    if (password_verify($pass,$pass_cifrado)){
        $_SESSION['nickname']=$usuario;
        $_SESSION['logeado']=true;
    }else{
        return false;
    }
}

function areaPersonal(){
    echo "
    <section class='section colored' id='pricing-plans'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Personal Area</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Welcome to your Personal Area</p>
                    </div>
                </div>
            </div>
            
            <div class='row'>
                <!-- ***** Pricing Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.2s'>
                    <div class='pricing-item'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Profile</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='price'><img src='assets/images/perfildefecto.png'></span>
                                <span class='period'>".$_SESSION['nickname']."</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->
                <!-- ***** Pricing Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.6s'>
                    <div class='pricing-item'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Tickets</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='price'>Your<strong class='theme_blue'>Tickets</strong></span>
                            </div>
                        </div>
                        <div class='pricing-footer'>
                            <a href='#' class='main-button'>View</a>
                        </div>
                    </div>
                </div>
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.6s'>
                    <div class='pricing-item'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Files</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='price'>Download<strong class='theme_blue'>Files</strong></span>
                            </div>
                            <div class='filetable'>";
                            $ruta = getcwd();
                             mostrarFichero($ruta."/users/".$_SESSION['nickname']);
                     echo " </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    ";
}

function formularioCargaArchivos(){
    echo "
    <section class='section colored' id='upload'>
        <div class='container'>
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'><span class='price'>Upload<strong class='theme_blue'>Files</strong></span></h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                       <p>Upload your files to a personal folder.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->
            <div class='row'>
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='contact-text'>
                    </div>
                </div>
                <!-- ***** Upload Form Start ***** -->
                <div class='col-lg-8 col-md-6 col-sm-12'>
                    <div class='contact-form'>
                        <form id='upload' action='./upfiles.php' method='post' enctype='multipart/form-data'>
                            <div class='row'>
                                <div class='col-lg-6 col-md-12 col-sm-12'>
                                <fieldset>
                                    <input name='upload' type='file' class='form-control' id='upload'>
                                </fieldset>
                                </div>
                                <div class='col-lg-12'>
                                <fieldset>
                                    <button type='submit' id='form-submit' class='main-button'>Upload</button>
                                </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ***** Upload Form End ***** -->
            </div>
        </div>
    </section>
    ";
}


function mostrarFichero($ruta){

    echo "
        <table border=1px solid>
            <tr>
                <th>Nombre Fichero</th>
                <th>Enlace Descarga </th>
            </tr>";

        $arrayFicheros = scandir($ruta,SCANDIR_SORT_ASCENDING);
        
        foreach ($arrayFicheros as $fichero){
            if(!($fichero == '.' || $fichero=='..')){
            echo "<tr>
                    <td>$fichero</td>
                    <td>
                        <a href='download.php?file=".$ruta."/".$fichero."'>Descargar</a>
                    </td>
                   </tr>";
                }
            }    
    echo "</table>";

}

function paginaInicio(){
    echo "
        <script type='text/javascript'>
            window.location.href='./index.php'
        </script>
    ";
}

function volverAreaPersonal(){
    echo "
        <script type='text/javascript'>
            window.location.href='./areapersonal.php'
        </script>
    ";
}