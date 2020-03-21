<form method='post' action='#'>
    <div class="form-group">
        <label for="username">Username</label>
        <input <?= $disabled ?? ''?> required type="text" class="form-control" id="username" placeholder="Enter a username" name="username" value="<?= $task["username"] ?? ''?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input <?= $disabled ?? ''?> required type="email" class="form-control" id="email" placeholder="Enter an email" name="email" value="<?= $task["email"] ?? ''?>">
    </div>

    <div class="form-group">
        <label for="text">Description</label>
        <textarea required class="form-control" id="text" placeholder="Enter a text" name="text"><?= $task["text"] ?? ''?></textarea>
    </div>

    <?php if (isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]): ?>
        <div class="form-group">
            <label for="is_completed">Is Completed</label>
            <input <?= ($task['is_completed'] ?? 0) == 1 ? 'checked="checked"' : ''?> type="checkbox" class="form-control" id="is_completed" name="is_completed" value="1">
        </div>
    <?php endif; ?>

    <?php if (!isset($error) || !$error):?>
        <button type="submit" class="btn btn-primary">Submit</button>
    <?php endif;?>
</form>
