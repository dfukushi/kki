<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	
?>
<h2 id="title">アクセス・所在地<span>Access</span></h2>
<br />
<!--<iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.jp/maps?f=d&amp;source=s_d&amp;saddr=%E6%8C%87%E5%AE%9A%E3%81%AE%E5%9C%B0%E7%82%B9&amp;daddr=&amp;hl=ja&amp;geocode=FQkAbwIdO8ljCA&amp;sll=40.830063,140.760269&amp;sspn=0.009936,0.014548&amp;gl=jp&amp;brcurrent=3,0x5f9b9eee5b7794d5:0x5c0c7db281ee883b,0&amp;ttype=now&amp;noexp=0&amp;noal=0&amp;sort=def&amp;mra=prev&amp;ie=UTF8&amp;ll=40.830063,140.760269&amp;spn=0.009936,0.014548&amp;t=m&amp;start=0&amp;output=embed"></iframe><br /><small><a href="https://maps.google.co.jp/maps?f=d&amp;source=embed&amp;saddr=%E6%8C%87%E5%AE%9A%E3%81%AE%E5%9C%B0%E7%82%B9&amp;daddr=&amp;hl=ja&amp;geocode=FQkAbwIdO8ljCA&amp;sll=40.830063,140.760269&amp;sspn=0.009936,0.014548&amp;gl=jp&amp;brcurrent=3,0x5f9b9eee5b7794d5:0x5c0c7db281ee883b,0&amp;ttype=now&amp;noexp=0&amp;noal=0&amp;sort=def&amp;mra=prev&amp;ie=UTF8&amp;ll=40.830063,140.760269&amp;spn=0.009936,0.014548&amp;t=m&amp;start=0" style="color:#0000FF;text-align:left">大きな地図で見る</a></small><pre>-->
<a href="img/map.jpg"><img src="img/map.jpg" width="520px" border=0></a>
<pre>
<?php print ht($design["access"]); ?>
	



TEL：<a href="tel:<?php print ht($design["tel"]); ?>?>"><?php print ht($design["tel"]); ?></a>
</pre>