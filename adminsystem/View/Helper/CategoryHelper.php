<?php
App::uses('Helper', 'View');

class CategoryHelper extends Helper {

    public function create_category($pid = 0, $user_tree_array='',$level = 0){

        App::import('Model','Category');
        $this->Category = new Category();
        $sql = "Select * From categories where 1 and parent_id = ".$pid." order by id ASC";
        $data = $this->Category->query($sql);

        if(count($data) > 0) {
            if($level==0)
            {
                $user_tree_array[] = "<ul class='treeRoot'>";
            } else {
                $user_tree_array[] = "<ul class='treeNodeCt'>";
            }
            $level++;
            foreach($data as $info=>$category){
                foreach($category as $cat) {
                    if($this->search_child_cat($cat['id'])) {
                        $user_tree_array[] = "<li class='treeNode'>";
                        $user_tree_array[] = "<div class='treeNodeEl treeNodeExpande'>";
                        $user_tree_array[] = "<span class='treeNodeIndent'>";
                        for($i=1;$i<$level;$i++){
                            if($pid != $this->is_last_child()) {
                                $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeIcon treeElBowLine'/>";
                            } else {
                                $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeIcon'/>";
                            }
                        }
                        $user_tree_array[] = "</span>";
                        $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeIcon treePlus'>";
                        $user_tree_array[] = "<a href='".$this->webroot."categories/edit/".$cat['id']."'><span>".$cat['name']."</span></a>";
                        
                        $user_tree_array = $this->create_category($cat['id'], $user_tree_array,$level);
                        $user_tree_array[] = "</li>";
                    } else {
                        $user_tree_array[] = "<li class='treeNode'>";
                        $user_tree_array[] = "<div class='treeNodeEl treeNodeLeaf'>";
                        $user_tree_array[] = "<span class='treeNodeIndent'>";
                        for($i=1;$i<$level;$i++){
                            if($pid != $this->is_last_child()) {
                                $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeIcon treeElBowLine'/>";
                            } else {
                                $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeIcon'/>";
                            }
                        }
                        $user_tree_array[] = "</span>";
                        $user_tree_array[] = "<img src='".$this->webroot."img/category/spacer.gif' class='treeElBowEnd treeIcon'>";
                        $user_tree_array[] = "<a href='".$this->webroot."categories/edit/".$cat['id']."'><span>".$cat['name']."</span></a>";
                        $user_tree_array[] = "</li>";
                    }
                }
            }
            $user_tree_array[] = "</ul>";
        }
        return $user_tree_array;

    }
    
    function search_child_cat($pid){

        App::import('Model','Category');
        $this->Category = new Category();
        $sql = "Select * From categories where 1 and parent_id = ".$pid;
        $data = $this->Category->query($sql);
        
        if(count($data)>0){
            return true;
        } else {
            return false;
        }
        
    }
    
    function is_last_child(){

        App::import('Model','Category');
        $this->Category = new Category();
        $sql = "Select id From categories where 1 and parent_id = 0 ORDER BY id DESC LIMIT 1";
        $data = $this->Category->query($sql);
        foreach($data as $category){
            foreach($category as $id) {
                return $id['id'];
            }
        }

    }

    public function find_all_category(){

        App::import('Model','Category');
        $this->Category = new Category();

        $sql = "Select * from categories ORDER BY id ASC";
        $data = $this->Category->query($sql);
        return $data;
    }

    public function find_category_edit($id){

        App::import('Model','Category');
        $this->Category = new Category();

        $sql = "Select * from categories where parent_id not in ($id) and id not in ($id) ORDER BY id ASC";
        $data = $this->Category->query($sql);
        return $data;
    }

}