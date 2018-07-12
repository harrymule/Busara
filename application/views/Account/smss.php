<div class="">
    
<?= form_open('Account/save_message') ?>
    <div class="form-group">
        <input type="text" name="phone" class="form-control" placeholder="E.g. +25411111111" />

    </div>
    <div class="form-group">
       <textarea class="form-control" rows='2' max='255' name="message" placeholder="Message:...."></textarea>
    </div>
    <button class='btn btn-success btn-block'>Save Message</button>
    <?= form_close() ?>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>To</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['smss'] as $value) : ?>
            <tr>
                <td><?= $value['phone'] ?></td>
                <td><?= $value['message'] ?></td>
                <td><?= $value['status'] ?></td>
                <td>
                    <div class='btn-group'>
                        <?php if ($value['status'] == 'pending') : ?>
                        <a href="<?= base_url('index.php/Account/send_message/' . $value['id']); ?>" class='btn btn-sm btn-success'>Send</a>
                        <?php endif; ?>
                        <a href="<?= base_url('index.php/Account/delete_message/' . $value['id']); ?>" class='btn btn-sm btn-danger'>delete</a>
                    </div>

                </td>
            </tr>
            <?php endforeach; ?>

        </tbody>

    </table>
</div>