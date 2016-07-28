<?php 
	echo $this->Form->create('Requests',array('type'=>'get','action'=>'getDeliveryProcess'));
	echo $this->Form->input('restaurantId');
	echo $this->Form->input('userId');
	echo $this->Html->link("aaa",array('action'=>'getListFavorites'));
	echo $this->form->end('submit');
 ?>