<?php

define('INDEX_AUTH', '1');

// main system configuration
require '../../../sysconfig.inc.php';
// IP based access limitation
require LIB.'ip_based_access.inc.php';

do_checkIP('smc');
do_checkIP('smc-reporting');
// start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_element.inc.php';
require SIMBIO.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require MDLBS.'reporting/report_dbgrid.inc.php';

// privileges checking
$can_read = utility::havePrivilege('reporting', 'r');
$can_write = utility::havePrivilege('reporting', 'w');
if (!$can_read) {
    die('<div class="errorBox">'.__('You don\'t have enough privileges to access this area!').'</div>');
}

$sql_location = 'SELECT location_id, location_name FROM mst_location';
$location_query =  $dbs->query($sql_location);



$reportView = false;
$num_recs_show = 20;
if (isset($_GET['reportView'])) {
    $reportView = true;
}

if (!$reportView) {

?>
<!-- filter -->
    <fieldset>
    <div class="per_title">
    	<h2><?php echo __('Loan History'); ?></h2>
	  </div>
    <div class="infoBox">
    <?php echo __('Report Filter'); ?>
    </div>
    <div class="sub_section">
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" target="reportView">
    <div id="filterForm1">
        <!--
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Member ID').'/'.__('Member Name'); ?></div>
            <div class="divRowContent">
            <?php
            echo simbio_form_element::textField('text', 'id_name', '', 'style="width: 50%"');
            ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Title'); ?></div>
            <div class="divRowContent">
            <?php
            echo simbio_form_element::textField('text', 'title', '', 'style="width: 50%"');
            ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Item Code'); ?></div>
            <div class="divRowContent">
            <?php
            echo simbio_form_element::textField('text', 'itemCode', '', 'style="width: 50%"');
            ?>
            </div>
        </div>
        -->
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Loan Date From'); ?></div>
            <div class="divRowContent">
            <?php
            echo simbio_form_element::dateField('startDate', '2000-01-01');
            ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Loan Date Until'); ?></div>
            <div class="divRowContent">
            <?php
            echo simbio_form_element::dateField('untilDate', date('Y-m-d'));
            ?>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Loan Status'); ?></div>
            <div class="divRowContent">
            <select name="loanStatus"><option value="ALL"><?php echo __('ALL'); ?></option><option value="0"><?php echo __('On Loan'); ?></option><option value="1"><?php echo __('Returned'); ?></option></select>
            </div>
        </div>
        <div class="divRow">
            <div class="divRowLabel"><?php echo __('Vi tri kho'); ?></div>
            <div class="divRowContent">
            <select name="loanLocation">
                <option value="ALL"><?php echo __('ALL'); ?></option>
                <?php
                while($data = $location_query->fetch_assoc()){
                    echo '<option value="' .$data["location_id"] . '">' . $data["location_name"] . '</option>';                          
                }
                ?>                
            </select>
            </div>
        </div>        
    </div>
    <div style="padding-top: 10px; clear: both;">
    <!--
    <input type="button" class="button" name="moreFilter" value="<?php echo __('Show More Filter Options'); ?>" />
    -->
    <input type="submit" name="applyFilter" value="<?php echo __('Apply Filter'); ?>" />
    <input type="hidden" name="reportView" value="true" />
    </div>
    </form>
	</div>    
    </fieldset>
    
    <div class="dataListHeader" style="padding: 3px;"><span id="pagingBox"></span></div>
    <iframe name="reportView" id="reportView" src="<?php echo $_SERVER['PHP_SELF'].'?reportView=true'; ?>" frameborder="0" style="width: 100%; height: 500px;"></iframe>
<?php    
    } else {
        
    // start the session
    ob_start();
    // total number of loan transaction    
    
    $sql_report_total = 'SELECT COUNT(loan_id) FROM loan as l, item as i, member as m WHERE l.item_code = i.item_code AND l.member_id = m.member_id';
    $sql_report_member_loan = 'SELECT DISTINCT l.member_id FROM loan as l, item as i, member as m WHERE l.item_code = i.item_code AND l.member_id = m.member_id';
    $sql_report_by_class = 'SELECT count(DISTINCT  l.member_id) as count, m.inst_name as name FROM loan as l, member as m, item as i WHERE l.item_code = i.item_code AND l.member_id = m.member_id';

    // loan location
    if (isset($_GET['loanLocation']) AND $_GET['loanLocation'] != 'ALL') {
        
        $loanLocation = $_GET['loanLocation'];    
        $sql_report_total .= ' AND i.location_id ="' . $loanLocation . '"';
        $sql_report_member_loan .= ' AND i.location_id ="' . $loanLocation . '"';
        $sql_report_by_class .= ' AND i.location_id ="' . $loanLocation . '"';        
    }
        
    if (isset($_GET['startDate']) AND isset($_GET['untilDate'])) {
        $sql_report_total .= ' AND (TO_DAYS(loan_date) BETWEEN TO_DAYS(\''.$_GET['startDate'].'\') AND TO_DAYS(\''.$_GET['untilDate'].'\'))';
        $sql_report_member_loan .= ' AND (TO_DAYS(loan_date) BETWEEN TO_DAYS(\''.$_GET['startDate'].'\') AND TO_DAYS(\''.$_GET['untilDate'].'\'))';
        $sql_report_by_class .= ' AND (TO_DAYS(loan_date) BETWEEN TO_DAYS(\''.$_GET['startDate'].'\') AND TO_DAYS(\''.$_GET['untilDate'].'\'))';
    }
    
    // loan status
    if (isset($_GET['loanStatus']) AND $_GET['loanStatus'] != 'ALL') {
        
        $loanStatus = (integer)$_GET['loanStatus'];
        
        $sql_report_total .= ' AND is_return ='.$loanStatus;
        $sql_report_member_loan .= ' AND is_return ='.$loanStatus;
        $sql_report_by_class .= ' AND is_return ='.$loanStatus;
        
    }
        
    $sql_report_by_class .=' GROUP BY m.inst_name';     
 
	

    //echo "<br/>" . $sql_report_total . "<br/>"; 
    //echo "<br/>" . $sql_report_member_loan . "<br/>";
    //echo "<br/>" . $sql_report_by_class . "<br/>";
    
    $report_query =  $dbs->query($sql_report_total);
    $report_d = $report_query->fetch_row();
    $loan_report[__('Total Loan')] = $report_d[0];

    $report_query =  $dbs->query($sql_report_member_loan);
    $report_d = $report_query->num_rows;
    $loan_report[__('Members Already Had Loans')] = $report_d;
        
    $report_query =  $dbs->query($sql_report_by_class);
    $report_count_flag = $report_query->num_rows;        
        
    /* loan report */
    
    $table = new simbio_table();
    $table->table_attr = 'align="center" class="border" cellpadding="5" cellspacing="0"';


    // table header
    $table->setHeader(array(__('Loan Data Summary')));
    $table->table_header_attr = 'class="dataListHeader"';
    $table->setCellAttr(0, 0, 'colspan="3"');
    
    // initial row count
    $row = 1;
    foreach ($loan_report as $headings=>$report_d) {
        $table->appendTableRow(array($headings, ':', $report_d));
        // set cell attribute
        $table->setCellAttr($row, 0, 'class="alterCell" valign="top" style="width: 170px;"');
        $table->setCellAttr($row, 1, 'class="alterCell" valign="top" style="width: 1%;"');
        $table->setCellAttr($row, 2, 'class="alterCell2" valign="top" style="width: auto;"');
        // add row count
        $row++;
    }                
    echo $table->printTable();
        
    
    if($report_count_flag > 0)
    {
    while($data = $report_query->fetch_assoc()){
        $loan_report_count[__($data['name'])] = $data['count'];
        
    }
    $table_count = new simbio_table();
    $table_count->table_attr = 'align="center" class="border" cellpadding="5" cellspacing="0"';

    
    // table header
    $table_count->setHeader(array(__('Thong ke so luong SV muon theo lop')));
    $table_count->table_header_attr = 'class="dataListHeader"';
    $table_count->setCellAttr(0, 0, 'colspan="3"');
    
    // initial row count
    $row = 1;
    foreach ($loan_report_count as $headings=>$report_d) {
        $table_count->appendTableRow(array($headings, ':', $report_d));
        // set cell attribute
        $table_count->setCellAttr($row, 0, 'class="alterCell" valign="top" style="width: 170px;"');
        $table_count->setCellAttr($row, 1, 'class="alterCell" valign="top" style="width: 1%;"');
        $table_count->setCellAttr($row, 2, 'class="alterCell2" valign="top" style="width: auto;"');
        // add row count
        $row++;
    }                
    echo $table_count->printTable();
    }
    $content = ob_get_clean();
    require SB.'/admin/'.$sysconf['admin_template']['dir'].'/printed_page_tpl.php';
}
?>

