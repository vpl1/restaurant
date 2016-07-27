<!-- page title -->
<div class="page-title">
  <h2>Danh sách đơn hàng</h2>
</div>
<!-- /.page title -->
<!-- msg box -->
<div class="alert alert-success" role="alert">
  <strong>Well done!</strong> Thông báo hiển thị khi tương tác thành công
</div>
<div class="alert alert-danger" role="alert">
  <strong>Oh snap!</strong> Thông báo hiển thị khi tương tác bị lỗi
</div>
<!-- filter -->
<div class="pnl panel panel-default">
  <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
    <h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
  </div>
  <div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
    <div class="filter-container">
      <?php 
        echo $this->OrderSearchForm->create('Search', array(
            'url' => array('controller' => 'orders', 'action' => 'test')
        )); 
        echo $this->OrderSearchForm->input('Mã đơn hàng', array('between' => '<div class="col-md-3 col-sm-3 col-xs-12">','after'=>'</div>','type' => 'text','id'=>'order_no','class'=>'form-control col-md-10','name' =>'order_no','div' => array('class'=>'form-group'),'label' =>array('class' =>'control-label col-md-2 col-sm-2 col-xs-12')));
        echo '<div class="form-group">';
          echo $this->OrderSearchForm->input('Ngày đặt hàng', array('between' => '<div class="col-md-3 col-sm-3 col-xs-12">','after'=>'</div>','type' => 'text','id'=>'fromdate','class'=>'form-control col-md-10','name' =>'fromdate','div'=>false,'label' =>array('class' =>'control-label col-md-2 col-sm-2 col-xs-12')));
            echo $this->OrderSearchForm->input('~', array('between' => '<div class="col-md-3 col-sm-3 col-xs-12">','after'=>'</div>','type' => 'text','id'=>'todate','class'=>'form-control col-md-10','name' =>'todate','div'=>false,'label' =>array('class' =>'control-label','style' =>'float:left')));
        echo '</div>';

       $paymentMethodOptions = array(
          '0' => 'Thẻ tín dụng',
          '1' => 'Chuyển khoảng',
          '2' => 'Giao hàng trả tiền',
      );
      echo $this->OrderSearchForm->select('Model.field', $paymentMethodOptions, array(
          'multiple' => 'checkbox'));
        echo $this->OrderSearchForm->end('Save Post');
      ?>
    </div>
  </div>
</div>      
<!-- /.msg box -->
      <?php 
          echo $this->Html->script('jquery');
         $this->Paginator->options(array(
            'update' => '#content',
            'before' => $this->Js->get("#loader")->effect('fadeIn', array('buffer' => false)),
            'complete' => $this->Js->get("#loader")->effect('fadeOut', array('buffer' => false)),
         )); 
      ?>
      <?php echo $this->Html->image('loader.gif', array('class' => 'hide', 'id' => 'loader')); ?>
      <!-- datatable -->
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>Stt</th>
            <th>Mã đơn hàng</th>
            <th>Trạng thái</th>
            <th>Tổng tiền</th>
            <th>Ngày mua</th>
            <th>Khu vực</th>
            <th>Người mua hàng</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($data==NULL){
              echo "<h2>Dada Empty</h2>";
          }else{
             $rows = array();
            foreach($data as $item){


              echo "<tr class='test'>";
                echo "<td>".$item['Order']['id']."</td>";
                echo "<td>".$item['Order']['order_no']."</td>";
                echo "<td>".$item['Order']['status']."</td>";
                echo "<td>".$item['Order']['total']."</td>";
                echo "<td>".$item['Order']['ship_date']."</td>";
                echo "<td>".$item['Order']['ship_date']."</td>";
                echo "<td>".$item['Order']['ship_date']."</td>";
              echo "</tr>";
            }
          }
          ?> 
         
        </tbody>
      </table>
      <!-- /.datatable -->  
      <?php
          echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
          echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
          echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
          //echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
      ?> 
      <?php echo $this->Js->writeBuffer(); ?>
   