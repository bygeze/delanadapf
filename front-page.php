<?php get_header(); ?>

<section 
    class="container-fluid" 
    id="landing"  
    style="background-image: 
    linear-gradient(180deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), 
    linear-gradient(180deg, hsla(0, 0%, 100%, 0.2), hsla(0, 0%, 100%, 0.2)), 
    linear-gradient(180deg, rgba(47, 0, 90, 0.3), rgba(47, 0, 90, 0.3)),
    url(<?php echo get_template_directory_uri(); ?>/img/bg-landing.jpg);">
        <div class="container" id="landing-content">
            <div class="row h-100">
                <div class="col-lg-6 col-xs-0"></div>
                <div class="col-lg-6 col-xs-12 d-flex align-items-center">
                    <div class="">
                        <p id="artist-name">Ezequiel Delanada</p>
                        <p id="artist-mini-desc">Productor & DJ</p>
                    </div>
                </div>     
            </div>
        </div>
</section>

<?php get_footer(); ?>