<!-- page title -->
<div class="page-title">
  <h2>Thêm mới tài khoản</h2>        
</div>
<!-- /.page title -->
<?php echo $this->Flash->render(); ?>  

<div class="form-horizontal form-label-left">
 <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
    <?php echo $this->Form->create('Store', array(
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
      <?php echo $this->Form->input('Store.store_name',array('label'=>false));?>
     
</div>
 <div class="form-horizontal form-label-left">
      <label class="control-label col-md-2 col-sm-2 col-xs-12">Telephone</label>
        <?php echo  $this->Form->input('Store.telephone',array('label'=>false));?>
        </div>
      <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
          <?php echo $this->Form->submit('Tạo tài khoản', array('class' => 'btn btn-success', 'title' => 'Tạo tài khoản')); ?>
        </div>  
      </div>
    <?php echo $this->Form->end(); ?>