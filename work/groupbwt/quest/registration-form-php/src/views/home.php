<?php
require_once __DIR__ . "/layouts/top.php";
//use controllers\HomeController;
//use models\Members;
?>
<div style="overflow:hidden;width: 100%;position: relative;"><iframe width="100%" height="450" src="https://maps.google.com/maps?width=800&amp;height=440&amp;hl=en&amp;q=7060%20Hollywood%20Blvd%2C%20Los%20Angeles%2C%20CA+(Google%20map)&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div style="position: absolute;width: 80%;bottom: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;"><small style="line-height: 1.8;font-size: 2px;background: #fff;">Powered by <a href="https://embedgooglemaps.com/de/">https://embedgooglemaps.com/de/</a> & <a href="https://iamsterdamcard.it">i amsterdamcard it</a></small></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div><br />
<div class="container">
    <h1><?= controllers\HomeController::title(); ?></h1>
    <div id="forms">
        <?php controllers\HomeController::checkStatusForm() ?>
    </div>
</div>
</body>
</html>