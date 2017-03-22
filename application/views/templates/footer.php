<?php
/**
 * Created by PhpStorm.
 * User: piferrari
 * Date: 08.03.17
 * Time: 15:08
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>
        <em>&copy; <?php $year = date('Y'); print ($year > 2017) ? "2017 - $year" : $year;?></em>
        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="<?php echo base_url(); ?>js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>js/main.js"></script>
        <script>
            $( document ).ready(function() {
                if(typeof draw === 'function')
                    draw();
            });
        </script>
    </body>
</html>
