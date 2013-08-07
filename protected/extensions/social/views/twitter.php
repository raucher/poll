<?php
	if($params['data-via'] !== "")
		$data_via = " data-via=".urlencode($params['data-via']);
	else
		$data_via = "";
?>

<!-- Thanks to http://techoctave.com/c7/posts/40-xhtml-strict-tweet-button-and-facebook-like-button -->
<div class="twitter social-<?php echo $this->style;?>" style="width:<?php echo $params['width'];?>px">
	<script type="text/javascript">
	//<![CDATA[
	(function() {
	document.write('<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal"<?php echo $data_via;?>>&nbsp;</a>');
	var s = document.createElement('SCRIPT'), s1 = document.getElementsByTagName('SCRIPT')[0];
	s.type = 'text/javascript';s
	s.async = true;
	s.src = 'http://platform.twitter.com/widgets.js';
	s1.parentNode.insertBefore(s, s1);
	})();
	//]]>
	</script>
</div>