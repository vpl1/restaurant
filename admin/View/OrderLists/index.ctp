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
        echo $this->OrderSearchForm->create('orderList');
        echo $this->OrderSearchForm->input('body', array('rows' => '3'));
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
                echo "<td>".$item['OrderList']['id']."</td>";
                echo "<td>".$item['OrderList']['order_no']."</td>";
                echo "<td>".$item['OrderList']['status']."</td>";
                echo "<td>".$item['OrderList']['total']."</td>";
                echo "<td>".$item['OrderList']['ship_date']."</td>";
                echo "<td>".$item['OrderList']['ship_date']."</td>";
                echo "<td>".$item['OrderList']['ship_date']."</td>";
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
   