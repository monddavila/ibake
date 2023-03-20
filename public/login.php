<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>iBake - Tier's of Joy | My Account</title>

<?php
    // Include header
    include 'includes/header.php';
    include 'includes/header2.php';

    ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/background-6.jpg)">
        <div class="auto-container">
            <h1>My account</h1>
            <ul class="page-breadcrumb">
                <li><a href="index.html">home</a></li>
                <li>My account</li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->

    <!--Login Section-->
    <section class="login-section">
        <div class="auto-container">
            <!-- Login Form -->
            <div class="login-form">
                <h2>Login</h2>
                <!--Login Form-->
                <form method="post" action="contact.html">
                    <div class="form-group">
                        <label>Username or email address *</label>
                        <input type="text" name="username" placeholder="" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Password *</label>
                        <input type="email" name="email" placeholder="" required>
                    </div>
                    
                    <div class="form-group">
                        <input class="theme-btn" type="submit" name="submit-form" value="Log in">
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="shipping-option" id="account-option-1">&nbsp; <label for="account-option-1">Remember me</label>
                    </div>

                    <div class="form-group pass">
                        <a href="#" class="psw">Lost your password?</a>
                    </div>
                </form>
            </div>
            <!--End Login Form -->  
        </div>
    </section>
    <!--End Login Section-->

    <?php
    // Include header
    include 'includes/footer.php';
?>
</body>
</html>