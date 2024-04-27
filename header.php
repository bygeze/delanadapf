<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo( 'charset' );?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php wp_head(); ?>

    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Fonts from Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">

</head>
<body>
<section class="container-fluid" id="topbar">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/logo-256.png" id="logo" alt="Nombre del Sitio"></a>    
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <div class="social-media ">
                        <a href="https://soundcloud.com/ezequiel-delanada"><img src="img/soundcloud.png" alt=""></a>
                        <a href="https://open.spotify.com/artist/7AH746wyI5u5gjRK6Thauj?si=Vk_kzWHpSe6X9rtHtw5DlQ"><img src="img/spotify.png" alt=""></a>
                        <a href="https://www.instagram.com/delanada.wav"><img src="img/instagram.png" alt=""></a>        
                    </div>
                </div>
            </div>
        </div>
    </section>