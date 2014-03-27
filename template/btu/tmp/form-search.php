
<div id="simply-search">
    <div class="simply">
        <form name="advSearchForm" id="simplySearchForm" action="index.php" method="get" class="form-search">
            <div class="input-append">
                <input type="hidden" name="search" value="search" />
                <input type="text" name="keywords" id="keyword" placeholder="<?php echo __('Keyword'); ?>" lang="<?php echo $sysconf['default_lang']; ?>" x-webkit-speech="x-webkit-speech" class="input-xxlarge search-query" />
                <button type="submit" class="btn"><?php echo __('Search'); ?></button>
            </div>
        </form>
    </div>
</div>

<div id="advance-search"  style="display:none;" >
    <form name="advSearchForm" id="advSearchForm" action="index.php" method="get" class="form-horizontal form-search">
        <div class="simply">
            <div class="input-append">
                <input type="text" name="title" id="title" placeholder="<?php echo __('Title'); ?>" class="input-xxlarge search-query" />
                <button type="submit" name="search" class="btn" value="search"><?php echo __('Search'); ?></button>
            </div>
        </div>
        <div class="advance">
            <div class="row-fluid">
                <div class="col-lg-6 col-sm-6">
                    <div class="control-group">
                        <label class="control-label"><?php echo __('Author(s)'); ?></label>
                        <div class="controls">
                            <?php echo $advsearch_author; ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo __('Subject(s)'); ?></label>
                        <div class="controls">
                            <?php echo $advsearch_topic; ?>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo __('ISBN/ISSN'); ?></label>
                        <div class="controls">
                            <input type="text" name="isbn" />
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">

                    <div class="control-group">
                        <label class="control-label"><?php echo __('GMD'); ?></label>
                        <div class="controls">
                            <select name="gmd"><?php echo $gmd_list; ?></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo __('Collection Type'); ?></label>
                        <div class="controls">
                            <select name="colltype"><?php echo $colltype_list; ?></select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo __('Location'); ?></label>
                        <div class="controls">
                            <select name="location"> <?php echo $location_list; ?></select>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </form>
</div>

<div id="show_advance">
    <a href="#"><?php echo __('Advanced Search'); ?></a>
</div>

<?php if (isset($_GET['search'])) { ?>
<div class="info-query">
	<?php echo $search_result_info; ?>
</div>
<?php        
	}
?>