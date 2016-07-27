<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo $post['Post']['body'] ?></p>


 <a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'edit', $post['Post']['id']));?>" class="btn btn-xs btn-success mr10">
                   <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;Edit
                </a>
<a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'delete', $post['Post']['id']));?>" class="btn btn-xs btn-danger" onclick="return confirm(&quot;Bạn chắc chắn xóa bài viết không?&quot;);">
                   <i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp;&nbsp; Delete 
                </a>

<a href="<?php echo $this->Html->Url(array('controller'=>'posts', 'action'=>'index'));?>" class="btn btn-xs btn-danger">&nbsp;&nbsp; Cancel