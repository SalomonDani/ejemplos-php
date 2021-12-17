<?php

//Definición de parámetros de acceso a la base de datos

define ("SERVIDOR","localhost");
define ("USUARIO","kingios");
define ("PASSWORD","kingios1");
define ("BASEDATOS","kingios_bd");

function conectarBD(): mysqli | false {
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

                <div class='col-lg-8 col-md-6 col-sm-12'>
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
                <div class='col-lg-8 col-md-6 col-sm-12'>
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
                            <li><a href='#testimonials'>Testimonials</a></li>
                            <li><a href='#pricing-plans'>Pricing Tables</a></li>
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
                            <li><a href='#testimonials'>Testimonials</a></li>
                            <li><a href='#pricing-plans'>Pricing Tables</a></li>
                            <li><a href='#contact-us'>Contact Us</a></li>
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
                        <h1>We provide the best <strong>strategy</strong><br>to grow up your <strong>business</strong></h1>
                        <p>Softy Pinko is a professional Bootstrap 4.0 theme designed by Template Mo 
                        for your company at absolutely free of charge</p>
                        <a href='#features' class='main-button-slider'>Discover More</a>
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
                                    <i><img src='assets/images/featured-item-01.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Modern Strategy</h5>
                                <p>Customize anything in this template to fit your website needs</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class='col-lg-4 col-md-6 col-sm-6 col-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.4s'>
                            <div class='features-small-item'>
                                <div class='icon'>
                                    <i><img src='assets/images/featured-item-01.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Best Relationship</h5>
                                <p>Contact us immediately if you have a question in mind</p>
                            </div>
                        </div>
                        <!-- ***** Features Small Item End ***** -->

                        <!-- ***** Features Small Item Start ***** -->
                        <div class='col-lg-4 col-md-6 col-sm-6 col-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.6s'>
                            <div class='features-small-item'>
                                <div class='icon'>
                                    <i><img src='assets/images/featured-item-01.png' alt=''></i>
                                </div>
                                <h5 class='features-title'>Ultimate Marketing</h5>
                                <p>You just need to tell your friends about our free templates</p>
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
                        <h2 class='section-title'>Let’s discuss about you project</h2>
                    </div>
                    <div class='left-text'>
                        <p>Nullam sit amet purus libero. Etiam ullamcorper nisl ut augue blandit, at finibus leo efficitur. Nam gravida purus non sapien auctor, ut aliquam magna ullamcorper.</p>
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
                        <h2 class='section-title'>We can help you to grow your business</h2>
                    </div>
                    <div class='left-text'>
                        <p>Aenean pretium, ipsum et porttitor auctor, metus ipsum iaculis nisi, a bibendum lectus libero vitae urna. Sed id leo eu dolor luctus congue sed eget ipsum. Nunc nec luctus libero. Etiam quis dolor elit.</p>
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
                            <h1>Work Process</h1>
                            <p>Aenean nec tempor metus. Maecenas ligula dolor, commodo in imperdiet interdum, vehicula ut ex. Donec ante diam.</p>
                        </div>
                    </div>
                </div>

                <!-- ***** Mini Box Start ***** -->
                <div class='row'>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Get Ideas</strong>
                            <span>Godard pabst prism fam cliche.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Sketch Up</strong>
                            <span>Godard pabst prism fam cliche.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Discuss</strong>
                            <span>Godard pabst prism fam cliche.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Revise</strong>
                            <span>Godard pabst prism fam cliche.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Approve</strong>
                            <span>Godard pabst prism fam cliche.</span>
                        </a>
                    </div>
                    <div class='col-lg-2 col-md-3 col-sm-6 col-6'>
                        <a href='#' class='mini-box'>
                            <i><img src='assets/images/work-process-item-01.png' alt=''></i>
                            <strong>Launch</strong>
                            <span>Godard pabst prism fam cliche.</span>
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
                        <h2 class='section-title'>What do they say?</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Donec tempus, sem non rutrum imperdiet, lectus orci fringilla nulla, at accumsan elit eros a turpis. Ut sagittis lectus libero.</p>
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
                            <p>Proin a neque nisi. Nam ipsum nisi, venenatis ut nulla quis, egestas scelerisque orci. Maecenas a finibus odio.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>Catherine Soft</h3>
                                <span>Managing Director</span>
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
                            <p>Integer molestie aliquam gravida. Nullam nec arcu finibus, imperdiet nulla vitae, placerat nibh. Cras maximus venenatis molestie.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>Kelvin Wood</h3>
                                <span>Digital Marketer</span>
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
                            <p>Quisque diam odio, maximus ac consectetur eu, auctor non lorem. Cras quis est non ante ultrices molestie. Ut vehicula et diam at aliquam.</p>
                            <div class='user-image'>
                                <img src='http://placehold.it/60x60' alt=''>
                            </div>
                            <div class='team-info'>
                                <h3 class='user-name'>David Martin</h3>
                                <span>Website Manager</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ***** Testimonials Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Testimonials End ***** -->

    <!-- ***** Pricing Plans Start ***** -->
    <section class='section colored' id='pricing-plans'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Pricing Plans</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Donec vulputate urna sed rutrum venenatis. Cras consequat magna quis arcu elementum, quis congue risus volutpat.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class='row'>
                <!-- ***** Pricing Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.2s'>
                    <div class='pricing-item'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Starter</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='currency'>$</span>
                                <span class='price'>14.50</span>
                                <span class='period'>monthly</span>
                            </div>
                            <ul class='list'>
                                <li class='active'>60 GB space</li>
                                <li class='active'>600 GB transfer</li>
                                <li class='active'>Pro Design Panel</li>
                                <li>15-minute support</li>
                                <li>Unlimited Emails</li>
                                <li>24/7 Security</li>
                            </ul>
                        </div>
                        <div class='pricing-footer'>
                            <a href='#' class='main-button'>Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.4s'>
                    <div class='pricing-item active'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Premium</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='currency'>$</span>
                                <span class='price'>21.50</span>
                                <span class='period'>monthly</span>
                            </div>
                            <ul class='list'>
                                <li class='active'>120 GB space</li>
                                <li class='active'>1200 GB transfer</li>
                                <li class='active'>Pro Design Panel</li>
                                <li class='active'>15-minute support</li>
                                <li>Unlimited Emails</li>
                                <li>24/7 Security</li>
                            </ul>
                        </div>
                        <div class='pricing-footer'>
                            <a href='#' class='main-button'>Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->

                <!-- ***** Pricing Item Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12' data-scroll-reveal='enter bottom move 50px over 0.6s after 0.6s'>
                    <div class='pricing-item'>
                        <div class='pricing-header'>
                            <h3 class='pricing-title'>Advanced</h3>
                        </div>
                        <div class='pricing-body'>
                            <div class='price-wrapper'>
                                <span class='currency'>$</span>
                                <span class='price'>42.00</span>
                                <span class='period'>monthly</span>
                            </div>
                            <ul class='list'>
                                <li class='active'>250 GB space</li>
                                <li class='active'>5000 GB transfer</li>
                                <li class='active'>Pro Design Panel</li>
                                <li class='active'>15-minute support</li>
                                <li class='active'>Unlimited Emails</li>
                                <li class='active'>24/7 Security</li>
                            </ul>
                        </div>
                        <div class='pricing-footer'>
                            <a href='#' class='main-button'>Purchase Now</a>
                        </div>
                    </div>
                </div>
                <!-- ***** Pricing Item End ***** -->
            </div>
        </div>
    </section>
    <!-- ***** Pricing Plans End ***** -->
    <!-- ***** Counter Parallax Start ***** -->
    <section class='counter'>
        <div class='content'>
            <div class='container'>
                <div class='row'>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-bottom'>
                            <strong>126</strong>
                            <span>Projects</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-top'>
                            <strong>63</strong>
                            <span>Happy Clients</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item decoration-bottom'>
                            <strong>18</strong>
                            <span>Awards Wins</span>
                        </div>
                    </div>
                    <div class='col-lg-3 col-md-6 col-sm-12'>
                        <div class='count-item'>
                            <strong>27</strong>
                            <span>Countries</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Counter Parallax End ***** -->   

    <!-- ***** Blog Start ***** -->
    <section class='section' id='blog'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Blog Entries</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Integer molestie aliquam gravida. Nullam nec arcu finibus, imperdiet nulla vitae, placerat nibh. Cras maximus venenatis molestie.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class='row'>
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='blog-post-thumb'>
                        <div class='img'>
                            <img src='assets/images/blog-item-01.png' alt=''>
                        </div>
                        <div class='blog-content'>
                            <h3>
                                <a href='#'>Vivamus ac vehicula dui</a>
                            </h3>
                            <div class='text'>
                               Cras aliquet ligula dui, vitae fermentum velit tincidunt id. Praesent eu finibus nunc. Nulla in sagittis eros. Aliquam egestas augue.
                            </div>
                            <a href='#' class='main-button'>Read More</a>
                        </div>
                    </div>
                </div>
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='blog-post-thumb'>
                        <div class='img'>
                            <img src='assets/images/blog-item-02.png' alt=''>
                        </div>
                        <div class='blog-content'>
                            <h3>
                                <a href='#'>Phasellus convallis augue</a>
                            </h3>
                            <div class='text'>
                                Aliquam commodo ornare nisl, et scelerisque nisl dignissim ac. Vestibulum finibus urna ut velit venenatis, vel ultrices sapien mattis.
                            </div>
                            <a href='#' class='main-button'>Read More</a>
                        </div>
                    </div>
                </div>
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <div class='blog-post-thumb'>
                        <div class='img'>
                            <img src='assets/images/blog-item-03.png' alt=''>
                        </div>
                        <div class='blog-content'>
                            <h3>
                                <a href='#'>Nam gravida purus non</a>
                            </h3>
                            <div class='text'>
                                Maecenas eu erat vitae dui convallis consequat vel gravida nulla. Vestibulum finibus euismod odio, ut tempus enim varius eu.
                            </div>
                            <a href='#' class='main-button'>Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Blog End ***** -->

    <!-- ***** Contact Us Start ***** -->
    <section class='section colored' id='contact-us'>
        <div class='container'>
            <!-- ***** Section Title Start ***** -->
            <div class='row'>
                <div class='col-lg-12'>
                    <div class='center-heading'>
                        <h2 class='section-title'>Talk To Us</h2>
                    </div>
                </div>
                <div class='offset-lg-3 col-lg-6'>
                    <div class='center-text'>
                        <p>Maecenas pellentesque ante faucibus lectus vulputate sollicitudin. Cras feugiat hendrerit semper.</p>
                    </div>
                </div>
            </div>
            <!-- ***** Section Title End ***** -->

            <div class='row'>
                <!-- ***** Contact Text Start ***** -->
                <div class='col-lg-4 col-md-6 col-sm-12'>
                    <h5 class='margin-bottom-30'>Keep in touch</h5>
                    <div class='contact-text'>
                        <p>110-220 Quisque diam odio, maximus ac consectetur eu, 10260
                        <br>auctor non lorem</p>
                        <p>You are NOT allowed to re-distribute Softy Pinko template on any template collection websites. Thank you.</p>
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
                                <button type='submit' id='form-submit' class='main-button'>Send Message</button>
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
                            <li><a href='#'><i class='fa fa-facebook'></i></a></li>
                            <li><a href='#'><i class='fa fa-twitter'></i></a></li>
                            <li><a href='#'><i class='fa fa-linkedin'></i></a></li>
                            <li><a href='#'><i class='fa fa-rss'></i></a></li>
                            <li><a href='#'><i class='fa fa-dribbble'></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-lg-12'>
                        <p class='copyright'>Copyright &copy; 2020 Softy Pinko Company - Design: TemplateMo</p>
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
                                <span class='price'>PFP</span>
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
                            <h3 class='pricing-title'>Tickets</h3>
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