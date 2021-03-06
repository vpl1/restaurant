<?php
$userId = AuthComponent::user('id');
if($data["User"]["id"] != $userId):
?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!-- page title -->
	<h1 class="permission_error">
		<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
		Permission denied
	</h1>
	<!-- /.page title -->
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<?php else :?>
<!-- Content Header (Page header) -->
<section class="content-header">
	<!-- page title -->
	<h1>
	Thay đổi mật khẩu
	</h1>
	<!-- /.page title -->
	<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	<li class="active">Dashboard</li>
	</ol>
</section>
<!-- Main content -->
<section class="content">
	<?php echo $this->Flash->render(); ?>
	<div class="form-horizontal form-label-left">
		<?php echo $this->Form->create('User', array(
			'class' => 'form-horizontal form-label-left', 
			'role' => 'form',
			'inputDefaults' => array(
			'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
			'div' => array('class' => 'form-group'),
			'class' => array('form-control col-md-10'),
			'label' => array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label'),
			'between' => '<div class="col-md-3 col-sm-3 col-xs-12">',
			'after' => '</div>',
			'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
			))); 
		?>
		<?php echo $this->Form->input('username',
			array('disabled' => 'disabled'));
			echo $this->Form->input('password');
			echo $this->Form->input('role', array(
				'options' => array('staff' => 'staff'),
				'type' => 'hidden'
			));
				
		?>
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
				<?php echo $this->Form->submit('Cập nhật tài khoản', array('class' => 'btn btn-success', 'title' => 'Cập nhật tài khoản')); ?>
			</div>  
		</div>
		<?php echo $this->Form->end(); ?>
	</div>
</section>
<?php endif;?>

