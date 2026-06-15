<?php 
	print '
	<h1>NEWS</h1>
	<div class="news">';
	if (!isset($action)) {
		print '
		<a href="index.php?menu=' . $menu . '&action=1"><img src="news/_98509359_uscarproduction_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
		<h2><a href="index.php?menu=' . $menu . '&action=1">US growth faster than expected</a></h2>
		<p>The growth extended the robust activity reported in the previous quarter, when US GDP grew at an annual pace of 3.1%. <a href="index.php?menu=' . $menu . '&action=1">More ...</a></p>
		<time datetime="2017-10-25">25 October 2017</time>
		<hr>
		<a href="index.php?menu=' . $menu . '&action=2"><img src="news/_98453687_w0dskswv.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
		<h2><a href="index.php?menu=' . $menu . '&action=2">Wall Street: Tech firm surge pushes US markets higher</a></h2>
		<p>Investors piled into technology giants such as Amazon, Alphabet and Microsoft on Friday, driving the tech-heavy Nasdaq to one of its biggest one-day jumps this year. <a href="index.php?menu=' . $menu . '&action=2">More ...</a></p>
		<time datetime="2017-10-26">26 October 2017</time>
		<hr>
		<a href="index.php?menu=' . $menu . '&action=3"><img src="news/_98501093_booking-template_4panel_976x549.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
		<h2><a href="index.php?menu=' . $menu . '&action=3">Hotel booking sites probed by consumer watchdog</a></h2>
		<p>Hotel booking sites are to be probed by the UK\'s competition watchdog to see if consumers are being misled by them. <a href="index.php?menu=' . $menu . '&action=3">More ...</a></p>
		<time datetime="2017-10-27">27 October 2017</time>
		<hr>';
	}
	else {
		if ($action == 1) {
			# inicijalizacija sjednice
			
			print '
			<h2>US growth faster than expected</h2>
			<figure class="img_news">
				<a href="news/_98509359_uscarproduction_getty.jpg" target="_blank"><img src="news/_98509359_uscarproduction_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106608486_usconstructionworkers_getty.jpg" target="_blank"><img src="news/_106608486_usconstructionworkers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106609825_usshoppers_getty.jpg" target="_blank"><img src="news/_106609825_usshoppers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<div style="clear:both;"></div>
			<p>The US economy grew much faster than expected in the first quarter of the year, helped by a jump in exports and by firms building up stocks of goods.</p>
			<p><a href="https://www.bea.gov/news/2019/gross-domestic-product-1st-quarter-2019-advance-estimate" target="_blank">The economy expanded at an annualised pace of 3.2%</a> in the January-to-March period, well above analysts\' forecasts.</p>
			<p>However, some analysts warned growth had been boosted by one-off factors, and could slow in the months ahead.</p>
			<p>The growth figures - which are subject to revision in the months ahead - appeared to dispel any fears of an economic slowdown.
			<p>Secretary of Commerce Wilbur Ross welcomed the data, saying: "The Trump economy has repeatedly defied the sceptics who predicted an economic downturn and has restored America\'s position in the world as a consistent source of economic growth."</p>
			<p>Trade helped to boost growth in the first quarter, as exports rose while imports fell. Companies also built up inventories of goods at the fastest rate since the second quarter of 2015.</p>
			<p>However, consumer spending, which drives about two-thirds of economic activity in the US, grew by only 1.2% in the first quarter, down from a rate of 2.5% previously.</p>
			<p>The growth figure was quite a surprise and it certainly defuses some of the warnings about a possible recession in the US.</p>
			<p>There were, however, some features of the figures that suggest the headline growth rate is a little flattering. The acceleration owed something to companies building up their stocks of goods. That is a process that won\'t go on indefinitely, not at the same rate.</p>
			<time datetime="2017-10-25">25 October 2017</time>
			<hr>
			<a href="index.php?menu='.$menu.'">Back</a>';
		}
		else if ($action == 2) {
			# inicijalizacija sjednice
			
			print '
			<h2>Wall Street: Tech firm surge pushes US markets higher</h2>
			<figure class="img_news">
				<a href="news/_98453687_w0dskswv.jpg" target="_blank"><img src="news/_98453687_w0dskswv.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106608486_usconstructionworkers_getty.jpg" target="_blank"><img src="news/_106608486_usconstructionworkers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106609825_usshoppers_getty.jpg" target="_blank"><img src="news/_106609825_usshoppers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<div style="clear:both;"></div>
			<p>Investors piled into technology giants such as Amazon, Alphabet and Microsoft on Friday, driving the tech-heavy Nasdaq to one of its biggest one-day jumps this year.</p>
			<p>The gains came after the firms\' quarterly results blew past forecasts.</p>
			<p>The Nasdaq surged 2.2%, adding 144.49 points to close at 6,701.26.</p>
			<p>The S&P rose 20.67 points, or 0.8%, to 2,581, while the Dow Jones industrial average rose 33.3 points, or 0.14%, to 23,434.19.</p>
			<p>US markets have rallied this year, driven in part by a rise in major tech stocks.</p>
			<p>That had slowed in recent weeks, but accelerated after the earnings reports on Thursday.</p>
			<p>On Friday, the Commerce Department reported stronger-than-expected 3% growth in the third quarter, adding to market optimism.</p>
			<p>Shares in Amazon jumped by than 13%, after it said third quarter sales increased 34% to $43.7bn.</p>
			<time datetime="2017-10-26">26 October 2017</time>
			<hr>
			<a href="index.php?menu='.$menu.'">Back</a>';

		}
		else if ($action == 3) {
			# inicijalizacija sjednice
			
			print '
			<h2>Hotel booking sites probed by consumer watchdog</h2>
			<figure class="img_news">
				<a href="news/_98501093_booking-template_4panel_976x549.jpg" target="_blank"><img src="news/_98501093_booking-template_4panel_976x549.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106608486_usconstructionworkers_getty.jpg" target="_blank"><img src="news/_106608486_usconstructionworkers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<figure class="img_news">
				<a href="news/_106609825_usshoppers_getty.jpg" target="_blank"><img src="news/_106609825_usshoppers_getty.jpg" alt="US growth faster than expected" title="US growth faster than expected"></a>
			</figure>
			<div style="clear:both;"></div>
			<p><span style="font-weight:bold;">Hotel booking sites are to be probed by the UK\'s competition watchdog to see if consumers are being misled by them.</span></p>
			<p>The Competition and Markets Authority is concerned that rather than helping consumers, the sites might actually be making it more difficult for them.</p>
			<p>The CMA said it was "concerned about the clarity, accuracy and presentation of information on sites".</p>
			<p>The investigation will examine areas such as hidden charges, search results, and discount claims.</p>
			<p>Leading booking sites include Expedia and Booking.com.</p>
			<p>In a statement, booking site Trivago, which is majority owned by Expedia, said: "Trivago will work with the CMA to explain the benefits it delivers to consumers looking for their ideal hotel."</p>
			<p>Booking.com said it would not be commenting at this time.</p>
			<p>According to the CMA, about 70% of people who shop around for accommodation use hotel booking sites.</p>
			<time datetime="2017-10-27">27 October 2017</time>
			<hr>
			<a href="index.php?menu='.$menu.'">Back</a>';
		}
	}
	print '
	</div>';
	
?>