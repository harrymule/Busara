<div class="row">
    <div class='col-sm-12'>
    <?= form_open_multipart('Account/upload_images') ?>
    <input type='file' name='pictures[]' accept='image/*' multiple />
    <button type="submit" class="btn btn-success">Submit</button>
    <?= form_close() ?>
    <hr>
    </div>
    <?php foreach ($data['pictures'] as $value) : ?>
    <div class="col-sm-4">
        <div class="thumbnail">
            <img src="<?= $value['thumbnail'] ?>" class="img-responsive" />
            <div class="pull-right btn-group">
                <?php if($me['profile_pic'] != $value['file_link']):?>
                    <a href="<?= base_url('index.php/Account/set_as_profile_pic/' . $value['id']) ?>" 
                    class="btn btn-xs btn-success " >Set </a>
                <?php endif;?>
                <a href="<?= base_url('index.php/Account/delete_picture/' . $value['id']) ?>" 
                class="btn btn-xs btn-danger " >Delete </a>
            </div>
            <p><?= $value['title'] ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>