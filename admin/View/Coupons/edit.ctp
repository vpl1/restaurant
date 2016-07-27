<!-- page title -->
<div class="page-title">
  <h2>Chỉnh sửa Coupon</h2>
</div>
<!-- /.page title -->
<?php echo $this->Flash->render(); ?>

     <div class="form-horizontal form-label-left">
   <?php echo $this->Form->create('Coupon', array(
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
      <?php 
            echo $this->Form->input('name');
            echo $this->Form->input('code');
            echo $this->Form->input('type', array(
              'options' => array('2' => 'Theo số tiền', '1' => 'Theo tỷ lệ')
            ));
            echo $this->Form->input('discount_fixed_price');
            echo $this->Form->input('discount_rate');
            echo $this->Form->input('start_date', array('type' => 'datepicker'));
            echo $this->Form->input('end_date', array('type' => 'datepicker'));
            echo $this->Form->input('category_id', array(
              'options' => array('1' => 'Trà xanh Matcha', '2' => 'Cà phê', '3' => 'Trà cụ', '4' => 'Dụng cụ pha cà phê')
            ));
            echo $this->Form->input('description');
      ?>
        <div class="form-group">
        <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
          <?php echo $this->Form->submit('Cập nhật Coupon', array('class' => 'btn btn-success', 'title' => 'Cập nhật Coupon')); ?>
        </div>
      </div>
    <?php echo $this->Form->end(); ?>
</div>
<script type="text/javascript">
    $('#CouponType').on('change', function () {
      if ($('#CouponType').val() == 1 ) {
        $('#CouponDiscountRate').show();
        $('label[for="CouponDiscountRate"]').show();
        $('#CouponDiscountFixedPrice').hide();
        $('label[for="CouponDiscountFixedPrice"]').hide();

      } 
      else if ($('#CouponType').val() == 2 ) {
        $('#CouponDiscountFixedPrice').show();
        $('label[for="CouponDiscountFixedPrice"]').show();
        $('#CouponDiscountRate').hide();
        $('label[for="CouponDiscountRate"]').hide();
      }
    });
    $(document).ready(function() {
         $('#CouponType').change();
    });
</script>