<!DOCTYPE html>
<html lang="en">

<?php
$this->render('client/includes/head', $subcontent);
?>

<body>
    <div class="loader">
    </div>
    <div class="page-wrapper">
        <?php
        $this->checkUserValid();
        $this->render('client/blocks/header', $subcontent);
        $this->render($content, $subcontent);
        $this->render('client/blocks/footer');
        if ($_SERVER['REQUEST_URI'] != '/auth') {
            $this->render('client/blocks/login-modal');
        }
        $this->render('client/blocks/mobile-menu');
        $this->render('client/blocks/newsletters-popup');
        $this->render('client/includes/js');
        ?>
    </div>
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            document.querySelector(".loader").style.display = "none";
        });
    </script>
</body>

</html>