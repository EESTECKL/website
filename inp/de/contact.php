<?php
        include 'top.html';
    ?>
       <div class="row-bot">
        	<div class="row-bot-bg">
            	<div class="main">
                	<h2>Contact <span>Us</span></h2>
                </div>
            </div>
        </div>
    </header>
    
	<!--==============================content================================-->
    <section id="content"><div class="ic"></div>
        <div class="main">
            <div class="wrapper">
            	<article class="col-1">
                	<div class="indent-left">
                    	<h3 class="p1">Our Contacts</h3>
                        <figure class="indent-bot">
                            <iframe width="240" height="180" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=Technical%2Buniversity%2Bof%2BKaiserslautern%2C%2Bgermany(contact+us)&ie=UTF8&z=12&t=m&iwloc=near&output=embed"></iframe>
                        </figure>
                        <dl>
                            <dt class="p1">EESTEC</dt>
                            <dd><span>Email:</span><a class="color-2" href="#">eestec@rhrk.uni-kl.de</a></dd>
                            </br>
                            <dt class="p1">VWI</dt>
                            <dd><span>Email:</span><a class="color-2" href="#">email_id</a></dd>
                        </dl>
                    </div>
                </article>
                <article class="col-2">
                	<h3 class="p1">Contact Form</h3>
                    <form id="contact-form" method="post" enctype="multipart/form-data">                    
                        <fieldset>
                              <label><span class="text-form">Your Name:</span><input name="name" type="text" /></label>
                              <label><span class="text-form">Your Email:</span><input name="email" type="text" /></label>                              
                              <div class="wrapper">
                                <div class="text-form">Your Message:</div>
                                <div class="extra-wrap">
                                    <textarea></textarea>
                                    <div class="clear"></div>
                                    <div class="buttons">
                                        <a class="button-2" href="#" onClick="document.getElementById('contact-form').reset()">Clear</a>
                                        <a class="button-2" href="#" onClick="document.getElementById('contact-form').submit()">Send</a>
                                    </div> 
                                </div>
                              </div>                            
                        </fieldset>						
                    </form>
                </article>
            </div>
        </div>
    </section>
    

<?php
        include 'bottom.html';
    ?>
