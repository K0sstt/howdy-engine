<?php 

return array(
	url('/news', render_url('main'), 'alias_main'),
	url('/news/{id}/{title}', 'read', 'alias_read')
);
