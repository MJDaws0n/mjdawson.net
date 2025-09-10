<?php /* HowSt Cafe – Example Front Page */ ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<meta name="description" content="HowSt Cafe – Fresh brunch, specialty coffee, cocktails & relaxed vibes in Sheffield." />
	<title>HowSt Cafe | Brunch · Coffee · Cocktails</title>
	<link rel="icon" type="image/jpeg" href="../../assets/examples/howst-cafe/icon.jpg" />
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600&display=swap" rel="stylesheet" />
	<link rel="stylesheet" href="../../assets/examples/howst-cafe/styles.css" />
</head>
<body>
	<a class="skip-link" href="#main">Skip to content</a>
	<header class="site-header" data-component="header">
		<div class="container flex between center v-gap-sm">
			<div class="brand">
				<img src="../../assets/examples/howst-cafe/icon.jpg" alt="HowSt Cafe logo" class="logo" />
				<span class="wordmark">HowSt Cafe</span>
			</div>
			<nav class="primary-nav" aria-label="Main navigation">
				<button class="nav-toggle" aria-expanded="false" aria-controls="nav-menu" id="navToggle" title="Open menu">
					<span class="bar"></span><span class="bar"></span><span class="bar"></span>
				</button>
				<ul id="nav-menu" class="nav-list">
					<li><a href="#about">About</a></li>
					<li class="has-dropdown">
						<button aria-haspopup="true" aria-expanded="false">Menus</button>
						<ul class="dropdown" aria-label="Submenu">
							<li><a href="#food">Food</a></li>
							<li><a href="#drinks">Drinks</a></li>
							<li><a href="#alcohol">Alcohol</a></li>
							<li><a href="#bottomless">Bottomless</a></li>
						</ul>
					</li>
					<li><a href="#hours">Hours</a></li>
					<li><a href="#gallery">Gallery</a></li>
					<li><a href="#contact">Contact</a></li>
					<li><a class="btn btn-accent btn-sm" href="#booking" data-scroll>Book</a></li>
				</ul>
			</nav>
		</div>
	</header>

	<section class="hero" id="top" aria-labelledby="hero-title">
		<div class="hero-media" role="img" aria-label="Fresh brunch plates and coffee"></div>
		<div class="hero-overlay"></div>
		<div class="hero-content container">
			<h1 id="hero-title"><span class="fancy">Brunch • Coffee • Cocktails</span><br/>Welcome to HowSt Cafe</h1>
			<p class="lead">Freshly made, locally loved. Seasonal plates, specialty beans & crafted drinks – served all day with a smile.</p>
			<div class="actions">
				<a href="#booking" class="btn btn-accent" data-scroll>Reserve a Table</a>
				<a href="#food" class="btn btn-outline" data-scroll>Explore Menus</a>
			</div>
			<ul class="badges" aria-label="Highlights">
				<li>All-Day Brunch</li><li>Specialty Coffee</li><li>Vegan Friendly</li><li>Local Spirits</li>
			</ul>
		</div>
		<div class="scroll-indicator" aria-hidden="true"><span></span></div>
	</section>

	<main id="main" tabindex="-1">
		<section id="about" class="section about">
			<div class="container grid two">
				<div class="text">
					<h2 class="section-title">Carefully Crafted, Casually Served</h2>
					<p>We pair relaxed ambience with <strong>quality ingredients</strong>. Small kitchen. Big flavour. Ethical sourcing & inventive plates inspired by global comfort classics.</p>
					<p>Walk-ins welcome. For groups & our <em>Bottomless Brunch</em>, reserve ahead – we prep fresh, so timing matters!</p>
					<div class="quick-stats" role="list" aria-label="Cafe facts">
						<div class="stat" role="listitem"><span class="num">30+</span><span class="label">Daily Dishes</span></div>
						<div class="stat" role="listitem"><span class="num">12hr</span><span class="label">Cold Brew</span></div>
						<div class="stat" role="listitem"><span class="num">6</span><span class="label">Local Roasters</span></div>
						<div class="stat" role="listitem"><span class="num">∞</span><span class="label">Chill Vibes</span></div>
					</div>
				</div>
				<div class="media-stack">
					<figure class="card-img tilt shadow"><img src="https://images.unsplash.com/photo-1551218808-94e220e084d2?w=600&auto=format&fit=crop&q=60" alt="Stack of fluffy pancakes with berries"/></figure>
					<figure class="card-img float shadow delay-1"><img src="https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?w=600&auto=format&fit=crop&q=60" alt="Latte art in ceramic cup"/></figure>
					<figure class="card-img float shadow delay-2"><img src="https://images.unsplash.com/photo-1551782450-a2132b4ba21d?w=600&auto=format&fit=crop&q=60" alt="Burger with fries on wooden board"/></figure>
				</div>
			</div>
		</section>

		<section id="food" class="section highlight alt">
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">All Day Brunch – HowSt Specials</h2>
					<p class="muted small">Freshly cooked to order. Please inform us of any allergens so we can adapt.</p>
				</div>
				<div class="menu-grid">
					<article class="menu-card"><h3>Full Meaty <span class="price">14.5</span></h3><p>Smoked bacon, sausages, black pudding, potatoes, mushrooms, tomatoes, homemade beans, fried egg & toast.</p></article>
					<article class="menu-card"><h3>Full Vegetarian (V) <span class="price">14</span></h3><p>Smashed avocado, rocket, houmous, potatoes, mushrooms, tomatoes, homemade beans, fried egg & toast.</p></article>
					<article class="menu-card"><h3>Olé <span class="price">12</span></h3><p>Spanish meaty chorizo, red peppers, homemade beans, cream, melted cheese, chilli flakes, fried egg & chunk of bread.</p></article>
					<article class="menu-card"><h3>Andy Hash (V) <span class="price">11</span></h3><p>Red peppers, mushrooms, potatoes, tomatoes, homemade beans, lightly spiced tomato sauce, melted cheese, fried egg & chunk of bread.</p></article>
					<article class="menu-card"><h3>Mari <span class="price">12.5</span></h3><p>Smoked salmon, marinated fennel, toast, whipped ricotta with honey & poached egg.</p></article>
					<article class="menu-card"><h3>Smashed (V) <span class="price">12</span></h3><p>Smashed avocado, whipped ricotta with honey, seeded crisp bread, fresh tomatoes, red onion chutney & poached egg.</p></article>
					<article class="menu-card"><h3>Izo <span class="price">12</span></h3><p>Spanish chorizo, mushrooms, tomatoes, smoked paprika, cream, toast, poached egg & pesto.</p></article>
					<article class="menu-card"><h3>HowSt Eggs Benedict <span class="price">13.5</span></h3><p>Smoked bacon or smoked salmon, 2 slices granary toast, hollandaise sauce, 2 poached eggs.</p></article>
					<article class="menu-card"><h3>Shroom (V) <span class="price">12</span></h3><p>Roasted flat mushrooms, tomatoes, spicy tomato sauce, rocket, toast & poached egg.</p></article>
				</div>
				<div class="section-head" style="margin-top:2.5rem"><h2 class="section-title" style="font-size:1.4rem">Served in a Brioche Bun</h2></div>
				<div class="menu-grid">
					<article class="menu-card"><h3>Dirty <span class="price">8</span></h3><p>Smoked bacon, sausages, homemade beans, grated cheese, fried egg.</p></article>
					<article class="menu-card"><h3>Smokey <span class="price">8</span></h3><p>Smoked salmon, egg mayonnaise, rocket, red onion chutney.</p></article>
					<article class="menu-card"><h3>Brie‑R‑T <span class="price">8</span></h3><p>Smoked bacon, brie cheese, rocket, tomato, mayonnaise.</p></article>
					<article class="menu-card"><h3>Nom (V) <span class="price">8</span></h3><p>Avocado, tomatoes, rocket, homemade beans, grated cheese, fried egg.</p></article>
					<article class="menu-card"><h3>Bacon or Cumberland Sausage <span class="price">5</span></h3><p>Add egg +0.75.</p></article>
				</div>
				<div class="section-head" style="margin-top:2.5rem"><h2 class="section-title" style="font-size:1.4rem">Served in a Ciabatta</h2></div>
				<div class="menu-grid">
					<article class="menu-card"><h3>Sweet Chilli Chicken (hot) <span class="price">9.5</span></h3><p>Chicken breast, sweet chilli sauce, red peppers, melted cheese.</p></article>
					<article class="menu-card"><h3>Sali (cold) <span class="price">9.5</span></h3><p>Pesto, mozzarella cheese, salami, rocket, plum tomato.</p></article>
					<article class="menu-card"><h3>Pollo (hot) <span class="price">9.5</span></h3><p>Chicken breast, mature cheese, pesto, rocket, plum tomato.</p></article>
					<article class="menu-card"><h3>Pep (V) (hot) <span class="price">9.5</span></h3><p>Houmous, red pepper, pesto, melted cheese, tomato, chilli flakes.</p></article>
				</div>
				<div class="section-head" style="margin-top:2.5rem"><h2 class="section-title" style="font-size:1.4rem">Further Options</h2></div>
				<div class="menu-grid">
					<article class="menu-card"><h3>Healthy Bowl (V) <span class="price">8</span></h3><p>Yoghurt, fruit compote, granola, bananas, coconut, goji berries & honey.</p></article>
					<article class="menu-card"><h3>Bakery <span class="price">from 3.75</span></h3><p>Croissants, daily cake portions, G/F brownie & more.</p></article>
				</div>
				<p class="small muted" style="margin-top:2rem">We make dishes fresh to order & can adapt to requirements. No specific children's menu – we’re happy to build a dish to suit.</p>
				<div class="section-cta" style="margin-top:2rem"><a href="#booking" class="btn btn-outline" data-scroll>Reserve for Brunch</a></div>
			</div>
		</section>

		<section id="drinks" class="section highlight">
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">Hot & Cold Drinks</h2>
					<p class="muted small">Sheffield Forge Coffee & seasonal specials. Alternative milks available.</p>
				</div>
				<div class="menu-flex">
					<div class="bev-group">
						<h3>Coffee</h3>
						<ul class="line-list">
							<li><strong>Espresso</strong></li>
							<li><strong>Latte</strong></li>
							<li><strong>Iced Latte</strong></li>
							<li><strong>Flat White</strong></li>
							<li><strong>Cappuccino</strong></li>
							<li><strong>Macchiato</strong></li>
							<li><strong>Long Black</strong></li>
						</ul>
					</div>
					<div class="bev-group">
						<h3>HowSt Specials</h3>
						<ul class="line-list">
							<li><strong>Chai Latte</strong></li>
							<li><strong>Matcha S/Berry</strong></li>
							<li><strong>Matcha</strong></li>
							<li><strong>Beetroot & Ginger Latte</strong></li>
						</ul>
					</div>
					<div class="bev-group">
						<h3>Alt Milks</h3>
						<p class="small muted">Oat | Almond | Soy | Coconut</p>
						<h3 style="margin-top:1.2rem">Hot Chocolate</h3>
						<ul class="line-list">
							<li><strong>HowSt Hot Chocolate</strong></li>
							<li><strong>Delux Hot Chocolate</strong><span>Toasted mallows & aerated cream</span></li>
							<li><strong>Mocha</strong></li>
						</ul>
					</div>
					<div class="bev-group">
						<h3>Shakes & Smoothies</h3>
						<ul class="line-list">
							<li><strong>Milkshakes</strong><span>Chocolate · Strawberry · Vanilla, topped with cream</span></li>
							<li><strong>Berry Mix Smoothie</strong><span>Coconut & apple juice</span></li>
							<li><strong>Banana Oat Smoothie</strong><span>Banana, oats, honey & coconut</span></li>
						</ul>
						<h3 style="margin-top:1.2rem">Delux Iced Coffee</h3>
						<ul class="line-list">
							<li><strong>Coffee</strong><span>Espresso, vanilla ice cream, milk</span></li>
							<li><strong>Mocha</strong><span>Espresso, chocolate ice cream, milk</span></li>
						</ul>
					</div>
				</div>
				<p class="small muted" style="margin-top:2rem">Allergens? Let us know – we can usually adapt.</p>
			</div>
		</section>

		<section id="alcohol" class="section alt">
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">Alcohol & Cocktails</h2>
					<p class="muted small">Rotating selection – ask staff for current list & ABV details.</p>
				</div>
				<div class="menu-flex">
					<div class="bev-group">
						<h3>Beer & Wine</h3>
						<ul class="line-list">
							<li><strong>Thornbridge Lukas Lager 4.2%</strong><span>Pint / Half</span></li>
							<li><strong>House Red / White</strong><span>125ml · 250ml · Bottle 750ml</span></li>
							<li><strong>Prosecco</strong><span>125ml · Bottle 750ml</span></li>
						</ul>
					</div>
					<div class="bev-group">
						<h3>Cocktail Selection <span class="small muted" style="display:block; margin-top:.4rem">All £7 each</span></h3>
						<ul class="line-list">
							<li><strong>Espresso Martini</strong><span>Espresso, vodka, syrup, coffee liqueur</span></li>
							<li><strong>HowSt Bloody Mary</strong><span>Vodka, tomato juice, spicy seasoning</span></li>
							<li><strong>Aperol Spritz</strong><span>Aperol, prosecco, soda</span></li>
							<li><strong>Passion Fruit Martini</strong><span>Fruit purée, vodka, prosecco</span></li>
							<li><strong>White Russian</strong><span>Vodka, coffee liqueur, cream</span></li>
							<li><strong>Mimosa</strong><span>Prosecco, orange juice</span></li>
							<li><strong>Fruit Daiquiri</strong><span>Berry mix, Bacardi, lime juice</span></li>
							<li><strong>Mojito</strong><span>Bacardi, limes, mint, sugar, soda</span></li>
						</ul>
						<p class="small muted" style="margin-top:1rem">Buy 2 for £12 (same cocktails).</p>
					</div>
				</div>
			</div>
		</section>

		<section id="bottomless" class="section feature">
			<div class="container grid two v-center">
				<div class="copy">
					<h2 class="section-title">Bottomless Brunch</h2>
					<p>Available any open day. Choose a meal from our brunch menu & enjoy:</p>
					<ul class="check-list">
						<li>Wine or beer option <strong>£27.5</strong></li>
						<li>Cocktail option <strong>£32.5</strong></li>
						<li>90 minutes from when your first drinks arrive</li>
						<li>Last table sitting 2pm</li>
						<li>All drinks consumed on premises</li>
						<li>Max standard table size 8 (larger by arrangement)</li>
						<li>Must be pre‑booked</li>
					</ul>
					<p class="small muted">We’re a small space – please book ahead so we can prepare. Responsible service applies.</p>
					<a href="#booking" class="btn btn-accent" data-scroll>Book Bottomless</a>
				</div>
				<div class="media-card shadow">
					<img src="https://images.unsplash.com/photo-1510626176961-4b57d4fbad03?w=800&auto=format&fit=crop&q=60" alt="Shared brunch table with cocktails" />
				</div>
			</div>
		</section>

		<section id="gallery" class="section gallery alt">
			<div class="container">
				<div class="section-head">
					<h2 class="section-title">A Taste of the Vibe</h2>
				</div>
				<div class="gallery-grid">
					<figure><img src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=500&auto=format&fit=crop&q=60" alt="Avocado toast with poached egg"/></figure>
					<figure><img src="https://images.unsplash.com/photo-1504754524776-8f4f37790ca0?w=500&auto=format&fit=crop&q=60" alt="Fruit bowl with granola"/></figure>
					<figure><img src="https://images.unsplash.com/photo-1498654896293-37aacf113fd9?w=500&auto=format&fit=crop&q=60" alt="Espresso shot being pulled"/></figure>
					<figure><img src="https://images.unsplash.com/photo-1528698827591-e19ccd7bc23d?w=500&auto=format&fit=crop&q=60" alt="Cocktail with garnish"/></figure>
					<figure><img src="https://images.unsplash.com/photo-1615719413546-198b25453f85?w=500&auto=format&fit=crop&q=60" alt="Interior seating area"/></figure>
					<figure><img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=500&auto=format&fit=crop&q=60" alt="Bar with hanging lights"/></figure>
				</div>
			</div>
		</section>

		<section id="testimonials" class="section testimonials">
			<div class="container">
				<h2 class="section-title">What Guests Say</h2>
				<div class="testimonial-track" data-auto-scroll>
					<blockquote class="t-card">“Massive portions & perfectly cooked – easily my new go-to brunch spot.”<cite>— Guest</cite></blockquote>
					<blockquote class="t-card">“Spotless, welcoming, quality coffee. Already planning my next visit.”<cite>— Local Customer</cite></blockquote>
					<blockquote class="t-card">“Fresh food, chilled playlist, and the staff really care.”<cite>— Reviewer</cite></blockquote>
					<blockquote class="t-card">“If you’re nearby & don’t visit you’re missing out.”<cite>— Regular</cite></blockquote>
				</div>
			</div>
		</section>

		<section id="hours" class="section hours alt">
			<div class="container grid two">
				<div>
					<h2 class="section-title">Hours & Location</h2>
					<p class="muted">Last food orders 30 mins before close.</p>
					<dl class="hours-list">
						<div><dt>Mon</dt><dd>Closed</dd></div>
						<div><dt>Tues – Fri</dt><dd>08:30 – 16:00</dd></div>
						<div><dt>Sat</dt><dd>09:30 – 16:00</dd></div>
						<div><dt>Sun</dt><dd>Closed</dd></div>
					</dl>
					<address class="address">1 Road Street, Sheffield, S1 123<br/>Tel: <a href="tel:+4412345678900">01234 567 8900</a><br/>WhatsApp: <a href="tel:+44712345678900">07123 456 78900</a><br/>Email: <a href="mailto:info@example.co.uk">info@example.co.uk</a></address>
				</div>
				<div class="map-shell">
					<div class="map-placeholder" role="img" aria-label="Map placeholder">Map Placeholder</div>
					<p class="small muted">(Interactive map embed can go here.)</p>
				</div>
			</div>
		</section>

		<section id="contact" class="section booking feature" style="padding-top:0"></section>
		<section id="booking" class="section booking feature">
			<div class="container narrow">
				<h2 class="section-title">Reserve Your Spot</h2>
				<p>Use the form below for groups, dietary notes or Bottomless Brunch enquiries. Instant booking integration could go here.</p>
				<form class="booking-form" action="#" method="post" novalidate>
					<div class="field"><label for="name">Name</label><input id="name" name="name" type="text" placeholder="Your full name" required /></div>
					<div class="field"><label for="email">Email</label><input id="email" name="email" type="email" placeholder="you@example.com" required /></div>
					<div class="field"><label for="date">Date</label><input id="date" name="date" type="date" required /></div>
					<div class="field"><label for="size">Party Size</label><input id="size" name="size" type="number" min="1" max="20" value="2" required /></div>
					<div class="field span-2"><label for="notes">Notes</label><textarea id="notes" name="notes" rows="4" placeholder="Occasion, dietary needs, etc."></textarea></div>
					<div class="actions span-2"><button class="btn btn-accent" type="submit">Send Enquiry</button></div>
				</form>
			</div>
		</section>
	</main>

	<footer class="site-footer">
		<div class="container footer-grid">
			<div class="f-brand">
				<img src="../../assets/examples/howst-cafe/icon.jpg" alt="HowSt Cafe logo" class="logo small" />
				<p>Fresh food, crafted drinks & relaxed hospitality.</p>
			</div>
			<nav aria-label="Footer">
				<ul class="foot-links">
					<li><a href="#food">Food</a></li>
					<li><a href="#drinks">Drinks</a></li>
					<li><a href="#alcohol">Cocktails</a></li>
					<li><a href="#bottomless">Bottomless</a></li>
					<li><a href="#hours">Hours</a></li>
					<li><a href="#booking">Book</a></li>
				</ul>
			</nav>
			<div class="f-meta">
				<p>&copy; <?php echo date('Y'); ?> HowSt Cafe. All rights reserved.</p>
				<p class="small muted">Demo front-end only.</p>
			</div>
		</div>
		<button class="to-top" data-scroll-to="#top" aria-label="Back to top">↑</button>
	</footer>

	<script src="../../assets/examples/howst-cafe/script.js" defer></script>
</body>
</html>
