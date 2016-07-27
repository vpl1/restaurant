<!-- page title -->
<div class="page-title">
  <h2>Xem khách hàng</h2>        
</div>
<!-- /.page title -->
<?php echo $this->Flash->render(); ?>  

<div class="form-horizontal form-label-left">
    <?php echo $this->Form->create('Client', array(
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
      ))); ?>
      <?php echo $this->Form->input('last_name');
            echo $this->Form->input('email');            
      ?>
    <?php echo $this->Form->end(); ?>
</div>