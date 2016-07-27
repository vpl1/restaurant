<!-- File: /app/View/Posts/index.ctp -->
<h1>Blog posts</h1>

<?php echo $this->Flash->render(); ?>  
<a  href="<?php echo $this->Html->Url(
                                    array(
                                    'controller'=>'posts', 
                                    'action'=>'add'
                                    )); ?>"
    class= "btn btn-sm btn-success"
    style="margin-bottom: 1em; font-size: 14px">
    <i class="fa fa-plus-square-o" aria-hidden="true"></i>
    &nbsp;Add posts
</a>

<?php
        echo $this->Html->image(
            'ajax-loader1.gif',
            array('id' => 'busy-indicator')
        );
?>

<?php 
   $this->Paginator->options(array(
      'update' =>'#content',
      'before' => $this->Js->get('#busy-indicator')->effect(
        'fadeIn',
        array('buffer' => false)
        ),
      'complete' => $this->Js->get('#busy-indicator')->effect(
        'fadeOut',
        array('buffer' => false)
        ),
   )); 
?>

    <table id="datatable" class="table table-bordered">
    <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Created</th>
            <th>Option</th>
        </tr>
    </thead>

    <!-- Here is where we loop through our $posts array, printing out post info -->
    <tbody>    
        <?php foreach ($posts as $post): ?>
        <tr>
            <td>
                <?php echo $post['Post']['id']; ?>
            </td>
            <td>
                <?php echo $this->Html->link($post['Post']['title'],array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
            </td>
            <td>
                <?php echo $post['Post']['created']; ?>
            </td>
            <td>   
                <a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'edit', $post['Post']['id']));?>" class="btn btn-xs btn-success mr10">
                   <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;Edit
                </a>

                <a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'delete', $post['Post']['id']));?>" class="btn btn-xs btn-danger" onclick="return confirm(&quot;Bạn chắc chắn xóa bài viết không?&quot;);">
                   <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp; Delete 
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div class="row paging">
    <div class="col-sm-5 paging-counter">
        <?php 
            echo $this->Paginator->counter('Hiển thị từ {:start} đến {:end} của {:count} bài viết');
         ?>
    </div>
    <div class="col-sm-7">
        <div class="pagination-large" align="right">
            <ul class="pagination">
                <?php
                    echo $this->Paginator->prev(__('Trang trước'), array('tag' => 'li'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                    echo $this->Paginator->numbers(array('separator' => '','currentTag' => 'a', 'currentClass' => 'active','tag' => 'li','first' => 1));
                    echo $this->Paginator->next(__('Trang tiếp'), array('tag' => 'li','currentClass' => 'disabled'), null, array('tag' => 'li','class' => 'disabled','disabledTag' => 'a'));
                ?>
            </ul>
        </div>
    </div>

</div>
<?php echo $this->Js->writeBuffer(); ?>