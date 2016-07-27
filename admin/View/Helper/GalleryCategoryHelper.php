<?php
App::uses('Helper', 'View');

class GalleryCategoryHelper extends Helper {
	public function getAllGalleryCategories($UserId){
		App::import('Model','GalleryCategory');
		$this->GalleryCategory = new GalleryCategory();
		$sql = "Select `id`,`title`,`description`,`created_date` from `gallery_categories` where `user_id` = ".$UserId." ORDER BY id ASC";
        $data = $this->GalleryCategory->query($sql);
        return json_encode($data);
	}

	/*
	* $userTreeArray : return tree array to view (html array) , null if count(data) = 0
	*/
	public function CreateMenu($userTreeArray = '', $level = 0, $userId){
		App::import('Model', 'GalleryCategory');

		$this->GalleryCategory = new GalleryCategory();
		$sql = "Select * from `gallery_categories` where `user_id` = ".$userId." ORDER BY id ASC";
		$data = $this->GalleryCategory->query($sql);

		if(count($data)>0){
			if($level = 0){
				$userTreeArray[] = "<ul class='treeRoot'>";
			}else{
				$user_tree_array[] = "<ul class='treeNodeCt'>";
			}

			$level++;
			foreach ($data as $galleryCategory=>$value) {
                $userTreeArray[] = "<li class='treeNode'>";
                $userTreeArray[] = "<div class='treeNodeEl treeNodeLeaf'>";
                $userTreeArray[] = "<span class='treeNodeIndent'>";
                $userTreeArray[] = "</span>";
                $userTreeArray[] = "<img src='".$this->webroot."img/menus/spacer.gif' class='treeElBowEnd treeIcon'>";
                $userTreeArray[] = "<a href='".$this->webroot."gallerycategories/edit/".$value["gallery_categories"]["id"]."'><span>".$value["gallery_categories"]["title"]."</span></a>";
                $userTreeArray[] = "</li>";
			}
		}

		return $userTreeArray;
	}

	public function FindAllCategory($UserId = ''){
		App::import('Model','GalleryCategory');
		$this->GalleryCategory = new GalleryCategory();
		$sql = "Select * from gallery_categories where 1 and user_id = ".$UserId." ORDER BY id ASC";
		$data = $this->GalleryCategory->query($sql);
		return $data;
	}
}