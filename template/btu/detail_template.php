<?php
// biblio/record detail
// output the buffer
ob_start(); /* <- DONT REMOVE THIS COMMAND */
?>

<div class="row">
	<div class="col-lg-2 col-sm-2">
     	<div class="cover">
      		{image}
      	</div>
      	<br/>
    	<!--<a target="_blank" href="index.php?p=show_detail&inXML=true&id=<?php echo $_GET['id'];?>" class="btn btn-mini btn-danger">XML</a>-->
    </div>
    <div class="col-lg-10 col-sm-10">
    	<h4 class="title">{title}</h4>
    	<div>{social_shares}</div>
        <span class="abstract">
    	<hr/>
    	{notes}
    	<hr/>
    </span>
    </div>
</div>
<br/>
<div class="row">
	<div class="form-horizontal">
      <!--
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php //print __('Statement of Responsibility'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{sor}</div>
        <div class="clearfix"></div>
      </div>
      -->
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Author(s)'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{authors}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Edition'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{edition}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Publishing Place'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{publish_place}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Publisher'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{publisher_name}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Publishing Year'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{publish_year}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Collation'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{collation}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Call Number'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{call_number}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('ISBN/ISSN'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{isbn_issn}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Subject(s)'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{subjects}</div>
        <div class="clearfix"></div>
      </div>
      <!--
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php //print __('Classification'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{classification}</div>
        <div class="clearfix"></div>
      </div>
      -->
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Series Title'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{series_title}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('GMD'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{gmd_name}</div>
        <div class="clearfix"></div>
      </div>
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Language'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{language_name}</div>
        <div class="clearfix"></div>
      </div>
      
      
      
      <!--
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Specific Detail Info'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{spec_detail_info}</div>
        <div class="clearfix"></div>
      </div>
      -->
      <div class="control-group">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('File Attachment'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info">{file_att}</div>
        <div class="clearfix"></div>
      </div>
      <br/>
      <div class="control-group col-lg-12 col-sm-12">
        <label class="col-lg-4 col-sm-4 detail-title"><?php print __('Availability'); ?></label>
        <div class="col-lg-8 col-sm-8 detail-info"></div>
        <div class="clearfix">{availability}</div>
      </div>
    </div>
</div>

<?php
// put the buffer to template var
$detail_template = ob_get_clean();
