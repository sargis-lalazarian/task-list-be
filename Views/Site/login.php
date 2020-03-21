<form method='post' action='#'>
    <h1>Login</h1>
    <?php if (isset($error) && $error):?>
        <div class="alert alert-danger" role="alert">
            <?=$error?>
        </div>
    <?php endif;?>

    <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" class="form-control col-md-4 offset-md-4" id="username" placeholder="Username" name="username" value="<?= $username ?? ''?>" />
    </div>

    <div class="form-group">
        <label for="password">Email</label>
        <input required type="password" class="form-control col-md-4 offset-md-4" id="password" placeholder="Enter an password" name="password" />
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>