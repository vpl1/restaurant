<!DOCTYPE html>
<?php
    $controllerAction = $this->params['action'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin | <?php echo $this->fetch('title');?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <?php echo $this->Html->css('bootstrap.min'); ?>
        <!-- font Awesome -->
        <?php echo $this->Html->css('font-awesome.min'); ?>
        <!-- Ionicons -->
        <?php echo $this->Html->css('ionicons.min'); ?>
        <?php echo $this->Html->css('common'); ?>    
        <?php echo $this->Html->css('select2.min'); ?>
        <!-- bootstrap wysihtml5 - text editor -->
       
        <!-- Theme style -->
         <?php echo $this->Html->css('admin'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
          <?php 
            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
          ?>

          <!-- Bootstrap core JavaScript
          ================================================== -->
          <!-- Placed at the end of the document so the pages load faster -->    
          <?php echo $this->Html->script('jquery.min');?>
          <script>window.jQuery || document.write('<script src="./js/jquery.min.js"><\/script>')</script>
          <?php echo $this->Html->script('bootstrap.min');?>
          <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
          <?php echo $this->Html->script('ie10-viewport-bug-workaround');?>
           <!-- daterangepicker -->
          <?php echo $this->Html->script('moment.min');?>
          <?php echo $this->Html->script('daterangepicker');?>
          <?php echo $this->Html->script('jquery.autocomplete');?>
          <?php echo $this->Html->script('select2.full');?>
          <?php echo $this->Html->script('datatables/jquery.dataTables.min');?>
          <?php echo $this->Html->script('datatables/dataTables.bootstrap');?>
          <?php echo $this->Html->script('datatables/fnMultiFilter');?>
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Admin Brycen Ltd
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog" aria-hidden="true"></i>
                                <span>English <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><?php echo $this->Html->link('English', array('controller' => 'users', 'action' => 'logout'));?>
                                </li>
                                <li><?php echo $this->Html->link('Japanese', array('controller' => 'users', 'action' => 'logout'));?>
                                </li>
                                <li><?php echo $this->Html->link('Myanmar', array('controller' => 'users', 'action' => 'logout'));?>
                                </li>
                                <li><?php echo $this->Html->link('Vietnammese', array('controller' => 'users', 'action' => 'logout'));?>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <i class="glyphicon glyphicon-user"></i>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Brycen 1</p>

                            <a href="#"><i class="fa fa-circle text-success"></i>Role: Admin</a>
                        </div>
                    </div>         
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="<?php if($controllerAction == 'index'){ echo "active"; }?>">
                            <?php echo $this->Html->link('Quản lý tài khoản', array('controller' => 'users', 'action' => 'index'));?>
                        </li>
                        <li class="<?php if($controllerAction == 'add'){ echo "active"; }?>">
                            <?php echo $this->Html->link('Thêm mới tài khoản', array('controller' => 'users', 'action' => 'add'));?>
                        </li>
                        <li class="<?php if($controllerAction == 'edit'){ echo "active"; }?>">
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-edit')).$this->Html->tag('span', 'Chỉnh sữa tài khoản'),
                                array('controller' => 'users', 'action' => 'edit', AuthComponent::user('id')),
                                array('escape'=>false));
                            ?>
                        </li>
                        <li>
                            <?php echo $this->Html->link(
                                $this->Html->tag('i', '', array('class' => 'fa fa-edit')).$this->Html->tag('span', 'Đăng xuất'),
                                array('controller' => 'users', 'action' => 'logout'),
                                array('escape'=>false));
                            ?>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
              <?php echo $this->fetch('content'); ?>
            </aside><!-- /.right-side -->

        </div><!-- ./wrapper -->
        <?php echo $this->Html->script('admin/app');?>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <?php echo $this->Html->script('admin/dashboard');?>
    </body>
</html>