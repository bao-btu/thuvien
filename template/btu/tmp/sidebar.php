<?php if (utility::isMemberLogin()) { ?>
  <div class="panel panel-btu">
	  <div class="panel-heading tagline">
		  <?php echo __('Information'); ?>
	  </div>
	  <div class="panel-body">
		<?php echo $header_info; ?>
	  </div>
  </div>
<?php } else { ?>          		
  <div class="panel panel-btu">
	  <div class="panel-heading tagline">
		  <?php echo __('Information'); ?>
	  </div>
	  <div class="panel-body">
		<?php echo $info; ?>
	  </div>
  </div>         		
<?php } ?>

<br/>

<?php if(!isset($_GET['p'])) { ?>
	<?php if ($sysconf['enable_search_clustering']) { ?>
    <div class="sidebar">
    	<div class="tagline">
        	<?php echo __('Search Cluster'); ?>
		</div>
        <div class="panel-body">
        	<div id="search-cluster"><div class="cluster-loading"><?php echo __('Generating search cluster...');  ?></div></div>
				<script type="text/javascript">
					$('document').ready( function() {
					$.ajax({
					  url: 'index.php?p=clustering&q=<?php echo urlencode($criteria); ?>',
					  type: 'GET',
					  success: function(data, status, jqXHR) {
						$('#search-cluster').html(data);
					  }
					});
				  });
				</script>
			</div>
		</div>
	<?php } ?>  
<?php } ?>