<?php
	
	$url = 'https://my-exams.oss-cn-shenzhen.aliyuncs.com/uploads/20180420173937/studList.xlsx?Expires=1524281614&OSSAccessKeyId=TMP.AQHH8YPhFbBiViizoRxYERrAvBh4jAyayEpytY8i1aW0rwSYMSZA517BJYGwADAtAhRol1AmSRpIc8-UxclvGB40DFW5IQIVANZlUnEgLsEQI3QGlNcWq96Rn2id&Signature=46Y3dce8Iha6fJk%2BHRQzU6SP3jI%3D';
	file_put_contents('uploads/' . substr(basename($url), 0, strpos(basename($url), '?')), file_get_contents($url));
	
?>