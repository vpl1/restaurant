<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class Client extends AppModel {
    public $validate = array(
        'first_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A first name is required'
            )
        ),
        'last_name' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A last name is required'
            )
        ),
        'member_id' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a valid member',
                'allowEmpty' => false
            )
        ),
        'company' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a valid company',
                'allowEmpty' => false
            )
        ),
        'birthday' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a valid birthday',
                'allowEmpty' => false
            )
        ),
        'gender' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a valid gender',
                'allowEmpty' => false
            )
        ),
        'address' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
        'location_id' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a location',
                'allowEmpty' => false
            )
        ),
        'phone1' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a phone 1',
                'allowEmpty' => false
            )
        ),
        'phone2' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a phone 2',
                'allowEmpty' => false
            )
        ),
        'fax' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a fax',
                'allowEmpty' => false
            )
        ),
        'created_date' => array(
            'valid' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter a created date',
                'allowEmpty' => false
            )
        ),
        'modified_date' => array(
            'valid' => array(
                'rule' =>'date' ,
                'message' => 'Please enter a modified date',
                'allowEmpty' => false
            )
        )
    );

    public function GetData() {
        $aColumns = array('id','first_name','created_date');
         
        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "id";
         
        /* DB table to use */
        $sTable = "clients";

        /* Join condition */
        //$sJoin = "clients.member_id = members.id";
         
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
            $sWhere = "WHERE (";
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
            }
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
        }
         
        /* Individual column filtering */
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
            {
                if ( $sWhere == "" )
                {
                    $sWhere = "WHERE ";
                }
                else
                {
                    $sWhere .= " AND ";
                }
                $pos = strpos($_GET['sSearch_'.$i], '~');

                if ($pos === false) {
                    $sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                } else {                    
                    $start = substr($_GET['sSearch_'.$i], 0, $pos);
                    $end = substr($_GET['sSearch_'.$i], $pos + 1, strlen($_GET['sSearch_'.$i]) - $pos);

                    $sWhere .= "`".$aColumns[$i]."` BETWEEN DATE_FORMAT(str_to_date('".mysql_real_escape_string($start)."','%d/%m/%Y'),'%Y-%m-%d') AND DATE_FORMAT(str_to_date('".mysql_real_escape_string($end)."','%d/%m/%Y'),'%Y-%m-%d') ";
                }
                
            }
        }
        
        /*// Add the join
        if ( $sWhere == "" ) {
            $sWhere = "WHERE $sJoin";
        }
        else {
            $sWhere = " AND $sJoin";
        }
        */
        /*
         * Select list
         */
       /* $sSelect = "";
        for ( $i=0 ; $i<count($aColumns) ; $i++ )
        {
            $sSelect .= $aColumns[$i] .' as `'.$aColumns[$i].'`, ';
        }
        $sSelect = substr_replace( $sSelect, "", -2 ); 
         */    
        /*
         * SQL queries
        * Get data to display
        */
        $sQuery = "
            SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
            FROM $sTable
            $sWhere
            $sOrder
            $sLimit
        ";
        
        $rResult = mysql_query( $sQuery, $gaSql['link'] ) or fatal_error( 'MySQL Error: ' . mysql_errno() );
         
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
         
        while ( $aRow = mysql_fetch_array( $rResult ) )
        {
            $row = array();
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( $aColumns[$i] == "version" )
                {
                    /* Special output formatting for 'version' column */
                    $row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
                }
                else if ( $aColumns[$i] != ' ' )
                {
                    /* General output */
                    $row[] = $aRow[ $aColumns[$i] ];
                }
            }
            $output['aaData'][] = $row;
        }
         
        return $output;
    }
}
?>