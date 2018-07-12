<div class="row">
    <div class="col-sm-4">
        <div class="list-group">
            <?php foreach ($data['users'] as $value) :  ?>
            <a class='list-group-item <?= ($data['user']['id'] == $value['id']) ? 'active' : null ?> ' 
                href= " <?= base_url('index.php/Account/users/' . $value['id']); ?>">
                <?= ($value['names'] ? $value['names'] : $value['username']); ?>
             </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="col-sm-8">
        <div class='row'>
            <div class='col-sm-4'>
                <img src="<?= $data['user']['profile_pic'] ?  $data['user']['profile_pic'] : base_url('assets/images/user.png')?>" class='img-responsive img-thumbnail img-circle' />
            </div>
            <div class='col-sm-8'>
                <table class='table'>
                    <tbody>
                        <tr>
                            <td>Names</td>
                            <td> <?= $data['user']['names']?></td>    
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $data['user']['username']?></td>    
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?= $data['user']['phone']?></td>    
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td><?= $data['user']['age']?></td>    
                        </tr>
                        <tr>
                            <td>Created</td>
                            <td><?= $data['user']['created']?></td>    
                        </tr>
                        <tr>
                            <td>Modified</td>
                            <td><?= $data['user']['modified']?></td>    
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class='row'>
            <?php foreach ($data['user']['pictures'] as $value) : ?>
               <div class='col-sm-3'>
                 <div class='thumbnail'>
                   <img src='<?= $value['file_link'] ?>' class='img-responsive'/>
                   <small><?= $value['title'] ?></small>
                 </div>
               </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>