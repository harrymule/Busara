
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><?= $me['names'] ? $me['names'] : $me['username'] ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto pull-right">
                
            
                <li class='nav-item  <?= $this->uri->segment(2) === 'pictures' ? 'active' : null?>'>
                    <a class="nav-link" href="<?= base_url('index.php/Account/pictures') ?>">Pictures</a>
                </li>
                
                <li class="nav-item <?= $this->uri->segment(2) === 'smss' ? 'active' : null?>">
                    <a class="nav-link" href="<?= base_url('index.php/Account/smss') ?>">SMS'S</a>
                </li>
                
                <li class="nav-item <?= $this->uri->segment(2) === 'users' ? 'active' : null?>">
                    <a class="nav-link" href="<?=  base_url('index.php/Account/users/'.$me["id"])  ?>">Users</a>
                </li>
                <li class="nav-item  <?= $this->uri->segment(2) === 'logout'?> ">
                    <a class="nav-link" href="<?= base_url('index.php/Login/logout') ?>">Logout</a>
                </li>
                
            </ul>
        </div>
    </nav>
</div>