<div class="page-title">
        <h2>Thêm cửa hàng</h2>
      </div>
      <!-- /.page title -->
      <?php echo $this->Flash->render(); ?>  
      <!--Filter and search-->
      <div class="pnl panel panel-default">
        <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
          <h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
        </div>
        <div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
          <div class="filter-container">
            <form class="form-horizontal form-label-left">
              	<div class="form-group">
	                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên cửa hàng</label>
	                <div class="col-md-3 col-sm-3 col-xs-12 storeform">
                     <?php echo $this->Form->create('Store', array(
                    'class' => 'form-horizontal form-label-left', 
                    'role' => 'form',
                    'inputDefaults' => array(
                        'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                        'div' => array('class' => 'form-group '),
                        'class' => array('form-control col-md-10'),
                        'label' => array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label '),
                        'between' => '<div class="col-md-3 col-sm-3 col-xs-12 sTBox">',
                        'after' => '</div>',
                        'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
                    ))); ?>
		                <?php echo  $this->Form->input('store_name',array('div' => false,'label' => false,'class'=>'form-control col-md-10 mail'));?>
		                  <div id="autocomplete-container"></div>
	                </div>
             	</div>      
        			<div class="form-group dateForm">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12">Tỉnh/Thành</label>
        	           <div class="col-md-3 col-sm-3 col-xs-12">
	                  <select class="select2_single form-control stForm" tabindex="-1" id="address">
                    <option></option>
                    <option value="AK">Hồ Chí Minh</option>
                    <option value="HI">Hà Nội</option>
                    <option value="CA">Đà Nẵng</option>
                    <option value="NV">Huế</option>
                    <option value="OR">Nha Trang</option>
                    <option value="WA">Đà lạt</option>
                    <option value="AZ">Bình Định</option>                          
                  </select>
	                </div>
             <label class="control-label col-md-2 col-sm-2 col-xs-12"><span class="lSymbol">※</span></label>
          	 </div> 
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Địa chỉ</label>
                <div class="col-md-3 col-sm-3 col-xs-12 storeform">
                
                   <?php echo  $this->Form->input('district',array('div' => true,'label' => false,'class'=>'form-control col-md-10 mail'));?>
                   <div id="autocomplete-container"></div>
                </div>
                <label class="control-label col-md-2 col-sm-2 col-xs-12"><span class="rSymbol">※</span></label>
              </div>  
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Điện thoại</label>
                <div class="col-md-3 col-sm-3 col-xs-12 ">
                  
                  <?php echo  $this->Form->input('telephone',array('div' => true,'label' => false,'class'=>'form-control col-md-10'));?>
                   <div id="autocomplete-container"></div>
                </div>
              </div>   
               <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                <div class="col-md-3 col-sm-3 col-xs-12 storeform">
                 
                 <?php echo  $this->Form->input('email',array('div' => true,'label' => false,'class'=>'form-control col-md-10 mail'));?>
                 <div id="autocomplete-container"></div>
                </div>
              </div>               
              <div class="ln_solid"></div>

              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2 ">
                 <?php
                  echo $this->Form->submit('Thêm danh mục', array('class' => 'btn btn-success btnform', 'title' => 'Thêm danh mục','div'=>false));?>
                  <?php
                  echo $this->Form->button('Hủy', array('class' => 'btn btn-default btnCancel', 'title' => 'Hủy','type'=>'reset')); 
                  ?>
                <?php echo $this->Form->end(); ?>
               
                </div>
              </div>
              
            </form>           
          </div> 
        </div>

      </div>
      
      <!-- modal -->
      <div id="popup" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success">Save changes</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
