    <section id="footer">
        <div class="container h-100 d-flex align-items-center justify-content-center text-center">
            <p class="m-0 text-center text-white">Copyright &copy; <?php bloginfo('name'); echo ' '.date('Y'); ?> </p>
            <?php wp_footer(); ?>        
        </div>
    </section>

    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>

  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery-scripts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>