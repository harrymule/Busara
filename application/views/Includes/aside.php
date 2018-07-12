
<div class="container">
<div class="row">
    <div class="col-sm-3">


        <div class="panel ">
           
           <div class="panel-body">
               <div class="col-sm-10 col-sm-offset-1">

                    <?= form_open('Account/settings_post', ['class' => 'form-horizontal']); ?>
                    <input type='hidden' name='id' value='<?= $me['id'] ?>'/>
                    <img src="<?= $data['me']['profile_pic'] ?>" class="img-responsive img-circle" />
                    <div class="form-group">
                        <label class="control-label">
                            Names
                        </label>
                        <input type="text" name="names" class="form-control" value="<?= $me['names'] ?>" placeholder="names" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Phone
                        </label>
                        <input type="text" name="phone" class="form-control" value="<?= $me['phone'] ?>" placeholder="phone" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Age
                        </label>
                        <input type="text" name="age" class="form-control" value="<?= $me['age'] ?>" placeholder="age" />
                    </div>

                    <div class="form-group">
                        <label class="control-label">
                            Username
                        </label>
                        <input type="text" readonly class="form-control" value="<?= $me['username'] ?>" placeholder="username" />
                    </div>
                    
                    <button type="submit" class="btn btn-success">Submit</button>
                    <?= form_close() ?>

            </div>
           </div>
       </div>
    </div>

    <div class='col-sm-9'>
        
    