<?php
$pageTitle = 'Forgot Password';
require_once ('header.php');
?>
<main class="container">
<h1>Forgot Password</h1>

<form method="post" action="resetPW.php">
    <fieldset class="form-group">
        <label  for="email" class="col-sm-1">Email:</label>
        <input name="email" id="email" />
    </fieldset>
    <button class="col-sm-offset-1">Submit</button>
</form>
</main>

<?php
require_once ('footer.php');
?>

