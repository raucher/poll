<!--For details: http://developers.google.com/+/plugins/+1button/ -->
<div class="plusone social-<?php echo $this->style;?>">
	<div id="plusone-div"></div>
	<script type="text/javascript">
	//<![CDATA[
	gapi.plusone.render
	(
	'plusone-div',
	{
		"size": "<?php echo urlencode($params['size']);?>",
		"annotation":"<?php echo urlencode($params['annotation']);?>",
	}
	);
	//]]>
	</script>
</div>