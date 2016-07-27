<?php echo $this->Flash->render('auth'); ?>

<?php echo $this->Form->create('User',array('class' => 'form-signin')); ?>
  <h2 class="form-signin-heading">Đăng nhập</h2>
  <?php 
    echo $this->Form->input('username',array('div' => false,'label' => false,'class'=>'username form-control'));
    echo $this->Form->input('password',array('div' => false,'label' => false,'class'=>'password form-control'));
    echo $this->Form->submit('Đăng nhập', array('class' => 'btn btn-lg btn-success btn-block', 'title' => 'Đăng nhập'));
  ?>
<?php echo $this->Form->end(); ?>