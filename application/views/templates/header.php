<?php
if (!defined('front_assets')) {
    define("front_assets", base_url() . "assets/");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Test</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link href="<?php echo front_assets; ?>css/theme.scsse530.css" rel="stylesheet" />
        <link href="<?php echo front_assets; ?>css/custom.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">


        <link href="http://fonts.googleapis.com/css?family=Work+Sans:400,700" rel="stylesheet" />
        <link href="http://fonts.googleapis.com/css?family=Work+Sans:600" rel="stylesheet" />

        <script src="<?php echo front_assets; ?>js/vendore530.js"></script>
        <script src="<?php echo front_assets; ?>js/themee530.js"></script>
        <style>
            .alert-success {
                background-color: #dff0d8;
                border-color: #d6e9c6;
                color: #468847;
                padding: 10px;
                border-radius: 7px;
            }
            .alert-danger, .alert-error {
                background-color: #f2dede;
                border-color: #eed3d7;
                color: #b94a48;
                padding: 10px;
                border-radius: 7px; 
            }
            .active{
                font-weight: bold;
            }
        </style>

    </head>
    <body>

        <!--Header-part-->
        <div id="shopify-section-header" class="shopify-section">
            <div data-section-id="header" data-section-type="header-section">
				
				<nav class="mobile-nav-wrapper medium-up--hide" role="navigation">
					<ul id="MobileNav" class="mobile-nav">
                  <li class="mobile-nav__item border-bottom">
                      <a href="http://canb.spokesdigital.in/application/views/home.html" class="mobile-nav__link">
                          Home
                      </a>
                  </li>
                  <li class="mobile-nav__item border-bottom">
                      <a href="http://canb.spokesdigital.in" class="mobile-nav__link">
                          Products
                      </a>
                  </li>
                  <li class="mobile-nav__item border-bottom">
                      <a href="http://canb.spokesdigital.in/application/views/faq.html" class="mobile-nav__link">
                          FAQ
                      </a>
                  </li>
                  <li class="mobile-nav__item border-bottom">
                      <a href="http://canb.spokesdigital.in/application/views/" class="mobile-nav__link">
                          Contact Us
                      </a>
                  </li>
              </ul>
				</nav>
			
                <header class="site-header border-bottom logo--left" role="banner">
                    <div class="grid grid--no-gutters grid--table">
                        <div class="grid__item small--one-half medium-up--one-quarter logo-align--left">
                            <div class="h2 site-header__logo">
                                <a href="<?php echo base_url(); ?>" itemprop="url" class="site-header__logo-image">
								<h2><span class="logo-style">WB</span></h2>
                                    <!--<img src="<?php echo front_assets; ?>images/logo.png" alt="Logo">-->
                                </a>
                            </div>
                        </div>
						
						<nav class="grid__item medium-up--one-half small--hide" id="AccessibleNav" role="navigation">
							<ul class="site-nav list--inline" id="SiteNav">
                          <li>
                              <a href="http://canb.spokesdigital.in/application/views/home.html" class="site-nav__link site-nav__link--main">Home</a>
                          </li>
                          <li>
                              <a href="http://canb.spokesdigital.in" class="site-nav__link site-nav__link--main">Products</a>
                          </li>
                          <li class="site-nav--active">
                              <a href="http://canb.spokesdigital.in/application/views/faq.html" class="site-nav__link site-nav__link--main">FAQ</a>
                          </li>
                          <li>
                              <a href="http://canb.spokesdigital.in/application/views/contact-us.html" class="site-nav__link site-nav__link--main">Contact Us</a>
                          </li>
                      </ul>
						</nav>
						
                        <div class="grid__item small--one-half medium-up--one-quarter text-right site-header__icons site-header__icons--plus float-right">
                            <div class="site-header__icons-wrapper">

                                <?php if (empty($this->session->userdata('name'))) { ?>
                                    <a href="<?php echo base_url(); ?>auth/login" class="site-header__account">
                                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-login" viewBox="0 0 28.33 37.68"><path d="M14.17 14.9a7.45 7.45 0 1 0-7.5-7.45 7.46 7.46 0 0 0 7.5 7.45zm0-10.91a3.45 3.45 0 1 1-3.5 3.46A3.46 3.46 0 0 1 14.17 4zM14.17 16.47A14.18 14.18 0 0 0 0 30.68c0 1.41.66 4 5.11 5.66a27.17 27.17 0 0 0 9.06 1.34c6.54 0 14.17-1.84 14.17-7a14.18 14.18 0 0 0-14.17-14.21zm0 17.21c-6.3 0-10.17-1.77-10.17-3a10.17 10.17 0 1 1 20.33 0c.01 1.23-3.86 3-10.16 3z" /></svg>
                                        <span class="icon__fallback-text">Log in</span>
                                    </a>
                                    <a href="<?php echo base_url(); ?>cart" class="site-header__cart">
                                        <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-cart" viewBox="0 0 37 40"><path d="M36.5 34.8L33.3 8h-5.9C26.7 3.9 23 .8 18.5.8S10.3 3.9 9.6 8H3.7L.5 34.8c-.2 1.5.4 2.4.9 3 .5.5 1.4 1.2 3.1 1.2h28c1.3 0 2.4-.4 3.1-1.3.7-.7 1-1.8.9-2.9zm-18-30c2.2 0 4.1 1.4 4.7 3.2h-9.5c.7-1.9 2.6-3.2 4.8-3.2zM4.5 35l2.8-23h2.2v3c0 1.1.9 2 2 2s2-.9 2-2v-3h10v3c0 1.1.9 2 2 2s2-.9 2-2v-3h2.2l2.8 23h-28z" /></svg>
                                        <span class="visually-hidden">Cart</span>
                                        <span class="icon__fallback-text">Cart</span>
                                    </a>
                                <?php } else { ?>
                                    Welcome : 
                                    <a class="<?= ($this->uri->segment(1)=='dashboard' && $this->uri->segment(2)=='')?'active':''; ?>" href="<?php echo base_url(); ?>dashboard"><?php echo $this->session->userdata('name'); ?></a>
                                    | <a class="<?= ($this->uri->segment(1)=='cart')?'active':''; ?>" href="<?php echo base_url(); ?>cart">Cart</a> 
                                    | <a class="<?= ($this->uri->segment(2)=='order_history')?'active':''; ?>" href="<?php echo base_url(); ?>dashboard/order_history">Order History</a> 
                                    | <a  href="<?php echo base_url(); ?>login/logout">Logout</a>
                                <?php } ?>
								
								<button type="button" class="btn--link site-header__menu js-mobile-nav-toggle mobile-nav--open">
									<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-hamburger" viewBox="0 0 37 40"><path d="M33.5 25h-30c-1.1 0-2-.9-2-2s.9-2 2-2h30c1.1 0 2 .9 2 2s-.9 2-2 2zm0-11.5h-30c-1.1 0-2-.9-2-2s.9-2 2-2h30c1.1 0 2 .9 2 2s-.9 2-2 2zm0 23h-30c-1.1 0-2-.9-2-2s.9-2 2-2h30c1.1 0 2 .9 2 2s-.9 2-2 2z" /></svg>
									<svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-close" viewBox="0 0 37 40"><path d="M21.3 23l11-11c.8-.8.8-2 0-2.8-.8-.8-2-.8-2.8 0l-11 11-11-11c-.8-.8-2-.8-2.8 0-.8.8-.8 2 0 2.8l11 11-11 11c-.8.8-.8 2 0 2.8.4.4.9.6 1.4.6s1-.2 1.4-.6l11-11 11 11c.4.4.9.6 1.4.6s1-.2 1.4-.6c.8-.8.8-2 0-2.8l-11-11z" /></svg>
									<span class="icon__fallback-text">expand/collapse</span>
								</button>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="page-container" id="PageContainer">
            <?php
            if (!empty($this->session->userdata('msg'))) {
                if (!($this->session->userdata('status'))) {
                    ?>
                    <main class="main-content" id="MainContent" role="main">
                        <div class="page-width">
                            <div class="alert-danger">
                                <?= $this->session->userdata('msg'); ?> 
                            </div>
                        </div>
                    </main>

                    <?php
                } else {
                    ?>
                    <main class="main-content" id="MainContent" role="main">
                        <div class="page-width">
                            <div class="alert-success">
                                <strong>Success!</strong> <?= $this->session->userdata('msg'); ?> 
                            </div>
                        </div>
                    </main>
                    <?php
                }
                $data = array('status' => false, 'msg' => "");
                $this->session->set_userdata($data);
            }
            ?>
			
			   