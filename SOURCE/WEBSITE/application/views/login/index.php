    <div class="container mt-5">
        <h1 class="text-center">Đăng nhập tài khoản</h1>

        <!-- php sử dụng để hiện thẻ html thông báo -->
        <?php
        if ($this->session->flashdata('success')) {
        ?>
            <div class="alert alert-success"> <?php echo $this->session->flashdata('success') ?></div>
        <?php
        } elseif ($this->session->flashdata('error')) {
        ?>
            <div class="alert alert-danger"> <?php echo $this->session->flashdata('error') ?></div>
        <?php
        }
        ?>




        <form method="POST" action="<?php echo base_url('login-admin') ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <?php echo form_error('email'); ?>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                <?php echo form_error('password'); ?>
            </div>

            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="<?php echo base_url('register_admin') ?>" class="btn btn-warning">Đăng ký</a>
        </form>
    </div>