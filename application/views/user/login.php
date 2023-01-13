<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Cuti Pegawai | Login</title>
    
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">


    
</head>

<body class=""style="background: #4682B4;">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row" style="background: #fff;">
                    <div class="col-lg-5 d-none d-lg-block text-center mt-5"><img src="<?php echo base_url() ?>/assets/jawatengah.png?>" alt="logo"  class="rounded mx-auto d-block mt-5" style="width:200px; height:200px; " /></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h3 text-white-900 mb-4"><strong>Sistem Cuti Pegawai</strong></h1>
                                
                            </div>
                          
                            <div class="text-left">
                                        <h1 class="h6 text-white-900 mb-4">Silahkan masukan Email dan Password dibawah ini :</h1>

                            </div>
                            <?php if ($this->session->flashdata('message')) {
                                            echo '<p class="warning mt-2 mb-2">' . $this->session->flashdata('message') . '</p>';
                                        } ?>
            
                            <form class="user" method="post" action="<?php echo base_url('user/loginuser'); ?>">
                                <div class="form-group">
                                   <input type="email" class="form-control" id="exampleFirstName" aria-describedby="emailHelp" placeholder="Email" name="email">
                                </div>
                                 <div class="form-group">
                                    <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password" name="password">
                                </div>  
                                <button type="submit" style="background: #4682B4;" class="btn btn-primary btn-user btn-block">Login</button>
                                <hr>
                                <?php echo form_close(); ?>
                                <?php echo $this->session->flashdata('msg'); ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>



