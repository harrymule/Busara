

    <div class="container">
        <div class="panel ">
            <div class="panel-heading">
                Login
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4 ">
                    <?= form_open('Login/create_account_post',['class'=>'form-horizontal']);?>
                        <div class="form-group">
                            <label class="control-label">
                                Username
                            </label>
                            <input type="text" name="username" class="form-control" value="" placeholder="username" />
                        </div>
                        <div class="form-group">
                            <label class="control-label">
                                Password
                            </label>
                            <input type="password" name="password" class="form-control" value="" placeholder="*************" />
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        <p> <a href='<?= base_url('');?>'>Login</a></p>
                        <?= form_close()?>
                    </div>
                </div>
            </div>

        </div>

    </div>


