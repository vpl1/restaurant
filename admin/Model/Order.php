<?php
App::uses('Model', 'Model');

class Order extends AppModel {


	public function getDataIndex(){
		$query = $this->find('all',array(
			'fields' =>array(
				'Order.id'
				,'Order.order_no'
				,'Order.status'
				,'Order.total'
				,'Order.order_date'
				,'Order.paymethod'
				,'c.location_name'
				,'CONCAT(d.first_name ,d.last_name) as fullname'
			),
			'joins' =>array(
				'LEFT JOIN order_delivers as b  ON  `Order`.id = b.order_id'
				,'LEFT JOIN locations     as c  ON  b.location_id = c.id'
				,'LEFT JOIN purchasers    as d  ON  `Order`.purchaser_id = d.id'
			)
		));
		return $query;
	}
	public function getDataView($id =null){
		
		$query = $this->find('first',array(
			'fields' =>array(
					'id'
					,'order_no' 
					,'order_date'
					,'((case paymethod
						when 1 then "Thẻ tín dụng" 
						when 2 then "Chuyển khoản"
						when 3 then "Giao hàng trả tiền" end)) as paymethod'
					,'((case status 
						when 1 then "Chưa xác nhận" 
						when 2 then "Đã xác nhận" 
						when 3 then "Đang giao hàng" 
						when 4 then "Hoàn thành" 
						when 5 then "Đơn hàng đã hủy" end)) as status'
					,'total'
					,'sub_total'
					,'discount'
					,'used_point'
					,'recv_point'
					,'fee'
					,'p.first_name as purchasers_first_name'
					,'p.last_name  as purchasers_last_name'
					,'p.address as purchaser_add'
					,'p.phone as purchaser_phone'
					,'p.email as purchaser_email'
					,'p.created_date as purchaser_created_date'
					,'od.first_name as order_delivers_first_name'
					,'od.last_name as order_delivers_last_name'
					,'od.address as order_delivers_add'
					,'od.phone as order_delivers_phone'
					,'od.email as order_delivers_email'
					,'od.created_date as order_delivers_created_date'
					

				),
			'joins' =>array(
				'LEFT JOIN purchasers as p ON `Order`.purchaser_id = p.id'	
				,'LEFT JOIN order_delivers as od ON `Order`.id = od.order_id'
			),
			'conditions'=>array('Order.id'=>$id)
			));

		return $query;
	}

	public function getItemsOrder($id){
		$query ="
		SELECT item_no
				,item_name
				,item_prc
				,item_cnt
				,item_prc*item_cnt as total_price
		FROM `order_item`
		WHERE order_id = ".$id."
		";

		return $this->query($query);
	}

	public function GetData() {
		$aColumns = array('id','order_no','status','total', 'order_date','location_name','fullname','paymethod');
		 
		/* Indexed column (used for fast and accurate table cardinality) */
		$sIndexColumn = "id";
		 
		/* DB table to use */
		$sTable = "orders";
		 
		App::uses('ConnectionManager', 'Model');
		$dataSource = ConnectionManager::getDataSource('default');
		 
		/* Database connection information */
		$gaSql['user']       = $dataSource->config['login'];
		$gaSql['password']   = $dataSource->config['password'];
		$gaSql['db']         = $dataSource->config['database'];
		$gaSql['server']     = $dataSource->config['host'];
		 
		 
		/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
		 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
		* no need to edit below this line
		*/
		 
		/*
		 * Local functions
		*/
		function fatal_error ( $sErrorMessage = '' )
		{
			header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
			die( $sErrorMessage );
		}
		 
		 
		/*
		 * MySQL connection
		*/
		if ( ! $gaSql['link'] = mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) )
		{
			fatal_error( 'Could not open connection to server' );
		}
		 
		if ( ! mysql_select_db( $gaSql['db'], $gaSql['link'] ) )
		{
			fatal_error( 'Could not select database ' );
		}
		 
		/*
		 * Paging
		*/
		$sLimit = "";
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
					intval( $_GET['iDisplayLength'] );
		}
		 
		 
		/*
		 * Ordering
		*/
		$sOrder = "";
		if ( isset( $_GET['iSortCol_0'] ) )
		{
			$sOrder = "ORDER BY  ";
			for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
			{
				if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
				{
					$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
						($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
				}
			}
		 
			$sOrder = substr_replace( $sOrder, "", -2 );
			if ( $sOrder == "ORDER BY" )
			{
				$sOrder = "";
			}
		}
		 

		/*
		 * Filtering
		* NOTE this does not match the built-in DataTables filtering which does it
		* word by word on any field. It's possible to do here, but concerned about efficiency
		* on very large tables, and MySQL's regex functionality is very limited
		*/
		$sWhere = "";
		if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
		{
		  

			// $sWhere = "WHERE (";
			// for ( $i=0 ; $i<count($aColumns) ; $i++ )
			// {
			//     $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
			// }
			// $sWhere = substr_replace( $sWhere, "", -3 );
			// $sWhere .= ')';
			
		}
		 
		/* Individual column filtering */
		// for ( $i=0 ; $i<count($aColumns) ; $i++ )
		// {
		//     if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		//     {
				
		//         if ( $sWhere == "" )
		//         {
		//             $sWhere = "WHERE ";
		//         }
		//         else
		//         {
		//             $sWhere .= " AND ";
		//         }

		//         // echo count($_GET['sSearch_2']);
		//         // exit();
		//         $pos = strpos($_GET['sSearch_'.$i], '~');

		//         if ($pos === false) {
		//             $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		//         } else {                    
		//             $start = substr($_GET['sSearch_'.$i], 0, $pos);
		//             $end = substr($_GET['sSearch_'.$i], $pos + 1, strlen($_GET['sSearch_'.$i]) - $pos);

		//             $sWhere .= "`".$aColumns[$i]."` BETWEEN DATE_FORMAT(str_to_date('".mysql_real_escape_string($start)."','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(str_to_date('".mysql_real_escape_string($end)."','%d/%m/%Y'),'%Y-%m-%d') ";
		//         }
		//     }

		// }
		/* Individual column filtering */
		$aSearch = array('order_no','status','order_date','location_name','paymethod');
		$oder_no = $_GET['sSearch_1'];
		$status = $_GET['sSearch_2'];
		$order_date = $_GET['sSearch_4'];
		$location_name = $_GET['sSearch_5'];
		$paymethod = $_GET['sSearch_7'];
	   
		if ($oder_no !=''){
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				 $sWhere .= " AND ";
			}
			$sWhere .= "`order_no` LIKE '%".mysql_real_escape_string($oder_no)."%' ";
		}

		if ($status !=''){
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE (";
			}
			else
			{
				 $sWhere .= " AND (";
			} 
			foreach ($status as $key => $value) {

				$sWhere .= "`status` LIKE '%".mysql_real_escape_string( $value )."%' OR ";
			} 
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		} 

		if ($paymethod !=''){
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE (";
			}
			else
			{
				 $sWhere .= " AND (";
			} 
			foreach ($paymethod as $key => $value) {

					$sWhere .= "`paymethod` LIKE '%".mysql_real_escape_string( $value )."%' OR ";
   
			} 
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		} 

		if ($order_date !=''){
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				 $sWhere .= " AND ";
			}
			$pos = strpos($order_date, '~');
			$start = substr($order_date, 0, $pos);
			$end = substr($order_date, $pos + 1, strlen($order_date) - $pos);
			$sWhere .= "`order_date` BETWEEN DATE_FORMAT(str_to_date('".mysql_real_escape_string($start)."','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(str_to_date('".mysql_real_escape_string($end)."','%d/%m/%Y'),'%Y-%m-%d') ";
		}

		if ($location_name !=''){
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				 $sWhere .= " AND ";
			}
			$sWhere .= "`location_name` LIKE '%".mysql_real_escape_string($location_name)."%' ";
		}

		/*
		 * SQL queries
		* Get data to display
		*/
		// $sQuery = "
		//     SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
		//     FROM $sTable
		//     $sWhere
		//     $sOrder
		//     $sLimit
		// ";
		$sQuery ="
		SELECT   a.id
				,a.order_no
				,case a.status 
					when 1 then 'Chưa xác nhận' 
					when 2 then 'Đã xác nhận' 
					when 3 then 'Đang giao hàng' 
					when 4 then 'Hoàn thành' 
					when 5 then 'Đơn hàng đã hủy' end as status 
				,a.total
				,a.order_date
				,case a.paymethod
					when 1 then 'Thẻ tín dụng' 
					when 2 then 'Chuyển khoản' 
					when 3 then 'Giao hàng trả tiền' end as paymethod 
				,c.location_name,CONCAT(d.first_name ,d.last_name) as fullname 
		FROM `orders` as a 
			JOIN `order_delivers` as b on a.id = b.order_id 
			JOIN `locations` as c on b.location_id = c.id 
			JOIN `purchasers` as d on a.purchaser_id = d.id 
		$sWhere
		$sOrder
		$sLimit";
		
		$rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		// $aRow = mysql_fetch_array( $rResult );
		//print_r($aRow) ; exit();
		/* Data set length after filtering */
		$sQuery = "
			SELECT FOUND_ROWS()
		";
		$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
		$iFilteredTotal = $aResultFilterTotal[0];
		 
		/* Total data set length */
		$sQuery = "
		SELECT COUNT(`".$sIndexColumn."`)
			FROM   $sTable
		";
		$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
		$aResultTotal = mysql_fetch_array($rResultTotal);
		$iTotal = $aResultTotal[0];
		 
		 
		/*
		 * Output
		*/
		$output = array(
				"sEcho" => intval($_GET['sEcho']),
				"iTotalRecords" => $iTotal,
				"iTotalDisplayRecords" => $iFilteredTotal,
				"aaData" => array()
		);
		//$aRow = mysql_fetch_array( $rResult);
		//echo count( $aRow );
		//print_r($aRow); exit();
		
		while ( $aRow = mysql_fetch_array( $rResult ) )
		{
			
			$row = array();
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				if ( $aColumns[$i] == "order_no" )
				{
					/* Special output formatting for 'version' column */
					$row[] = '<a href="view/'.$aRow[$aColumns[0]].'">'.$aRow[ $aColumns[$i] ].'</a>';
				}
				else if ( $aColumns[$i] != ' ' )
				{
					/* General output */
					$row[] = $aRow[ $aColumns[$i] ];
				}
			}
			$output['aaData'][] = $row;
		}
		//print_r($output); 
		
		return $output;
	}
}