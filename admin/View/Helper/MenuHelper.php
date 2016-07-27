<?php
App::uses('Helper', 'View');

class MenuHelper extends Helper {

    public function create_menu($pid = 0, $user_tree_array='',$level = 0,$user_id){

        App::import('Model','Menu');
        $this->Menu = new Menu();
        $sql = "Select * From menus where 1 and parent_id = ".$pid." and user_id = ".$user_id." order by id ASC";
        $data = $this->Menu->query($sql);

        if(count($data) > 0) {
            if($level==0)
            {
                $user_tree_array[] = "<ul class='treeRoot'>";
            } else {
                $user_tree_array[] = "<ul class='treeNodeCt'>";
            }
            $level++;
            foreach($data as $info=>$menu){
                foreach($menu as $cat) {
                    if($this->search_child_cat($cat['id'])) {
                        $user_tree_array[] = "<li class='treeNode'>";
                        $user_tree_array[] = "<div class='treeNodeEl treeNodeExpande'>";
                        $user_tree_array[] = "<span class='treeNodeIndent'>";
                        for($i=1;$i<$level;$i++){
                            if($pid != $this->is_last_child()) {
                                $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeIcon treeElBowLine'/>";
                            } else {
                                $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeIcon'/>";
                            }
                        }
                        $user_tree_array[] = "</span>";
                        $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeIcon treePlus'>";
                        $user_tree_array[] = "<a href='".$this->webroot."menus/edit/".$cat['id']."'><span>".$cat['name']."</span></a>";
                        
                        $user_tree_array = $this->create_menu($cat['id'], $user_tree_array,$level,$user_id);
                        $user_tree_array[] = "</li>";
                    } else {
                        $user_tree_array[] = "<li class='treeNode'>";
                        $user_tree_array[] = "<div class='treeNodeEl treeNodeLeaf'>";
                        $user_tree_array[] = "<span class='treeNodeIndent'>";
                        for($i=1;$i<$level;$i++){
                            if($pid != $this->is_last_child()) {
                                $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeIcon treeElBowLine'/>";
                            } else {
                                $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeIcon'/>";
                            }
                        }
                        $user_tree_array[] = "</span>";
                        $user_tree_array[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeElBowEnd treeIcon'>";
                        $user_tree_array[] = "<a href='".$this->webroot."menus/edit/".$cat['id']."'><span>".$cat['name']."</span></a>";
                        $user_tree_array[] = "</li>";
                    }
                }
            }
            $user_tree_array[] = "</ul>";
        }
        return $user_tree_array;

    }
    
    function search_child_cat($pid){

        App::import('Model','Menu');
        $this->Menu = new Menu();
        $sql = "Select * From menus where 1 and parent_id = ".$pid;
        $data = $this->Menu->query($sql);
        
        if(count($data)>0){
            return true;
        } else {
            return false;
        }
        
    }
    
    function is_last_child(){

        App::import('Model','Menu');
        $this->Menu = new Menu();
        $sql = "Select id From menus where 1 and parent_id = 0 ORDER BY id DESC LIMIT 1";
        $data = $this->Menu->query($sql);
        foreach($data as $menu){
            foreach($menu as $id) {
                return $id['id'];
            }
        }

    }

    public function find_all_menu($user_id){

        App::import('Model','Menu');
        $this->Menu = new Menu();

        $sql = "Select * from menus where 1 and user_id = ".$user_id." ORDER BY id ASC";
        $data = $this->Menu->query($sql);
        return $data;
    }

    public function find_menu_edit($id,$user_id){

        App::import('Model','Menu');
        $this->Menu = new Menu();

        $sql = "Select * from menus where 1 and user_id = ".$user_id." and parent_id not in ($id) and id not in ($id) ORDER BY id ASC";
        $data = $this->Menu->query($sql);
        return $data;
    }

}