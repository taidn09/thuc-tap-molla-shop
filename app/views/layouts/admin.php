<!DOCTYPE html>
<html lang="en">
<?php
$this->render('admin/includes/head', $subcontent);
?>

<body>
    <?php
    $this->checkAdminLogin();
    $arrPathAllowAccessWithOutCheckRoles = array('/admin/dashboard', '/admin/dashboard/login', '/admin/dashboard/changePassword','/admin/404','/admin/401');
    $arrPathOnlyMainContent = array('/admin/dashboard/login','/admin/404',  '/admin/401');
    if (!in_array($_SERVER['PATH_INFO'], $arrPathAllowAccessWithOutCheckRoles)) {
        if (!$this->checkRole()) {
            $this->loadErrAuth();
        }
    }
    if (!in_array($_SERVER['PATH_INFO'], $arrPathOnlyMainContent)) {
        $this->render('admin/blocks/header', $subcontent);
        $this->render('admin/blocks/sidebar', $subcontent);
    }
    $this->render($content, $subcontent);
    if (!in_array($_SERVER['PATH_INFO'], $arrPathOnlyMainContent)) {
        $this->render('admin/blocks/footer');
    }
    $this->render('admin/includes/js');
    ?>
    <script>
        function formatInputNumber(input) {
            var value = $(input).val();
            var formattedValue = Number(value).toLocaleString();
            $(input).val(formattedValue);
        }

        function unFormatInputNumber(input) {
            var formattedValue = $(input).val().replace(/,/g, '');
            $(input).val(formattedValue);
        }
        $('input.form-number').focus(function() {
            unFormatInputNumber(this)
        });
        $('input.form-number').blur(function() {
            formatInputNumber(this)
        });
        $(document).ready(function() {
            $('input.form-number').each(function() {
                formatInputNumber(this)
            });
        })
    </script>
</body>

</html>