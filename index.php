<?php



defined( '_JEXEC' ) or die( 'Restricted access' );



require_once __DIR__ . '/html/helper.php';
require_once __DIR__ . '/html/article-fields-configuration.php';

error_reporting(0);

$templateBaseUrl = JUri::root() . 'templates/' . $this->template;

/** * Set the template to html 5. */
$this->setHtml5(true);

/** * Set the correct meta data. */
$this->setGenerator('TenZer de online recreatie specialist');
$this->setMetaData('viewport', 'width=device-width, initial-scale=1, shrink-to-fit=no');

$lang = JFactory::getLanguage();
$langtag = $lang->getTag();

require_once JPATH_SITE . '/plugins/content/imgresizecache/resize.php';
$resizer = new ImgResizeCache();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <!-- Slim code for jquery -->
		 <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

        <jdoc:include type="head" />

        <!-- Search and book token location -->
        <?php if(countModules('zb-token')) : ?>
            <jdoc:include type="modules" name="zb-token" style="clean" />
        <?php endif ?>
		<?php echo $this->params->get('google-analytics-code');?>


        <!-- CSS preload -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/app.css">

        <!-- Pagespeed header module -->
        <jdoc:include type="modules" name="pagespeedhead" style="clean"/>
    </head>
    <!-- body class php code -->
    <?php
        $active = JFactory::getApplication()->getMenu()->getActive();
        $bc_doc = JFactory::getDocument();
        $bc_renderer = $bc_doc->loadRenderer('modules');
        $bc_position = 'bodyclass';
        $bc_options  = array('style' => 'clean');
    ?>
    <body class="<?php echo ($active->alias == 'home') ? 'home' : 'vervolg'; ?> <?php echo $active->alias; ?> <?php echo $bc_renderer->render($bc_position, $bc_options, null); ?>">
        <div class="loader"></div>

        <!-- Header with logo and menu -->
        <header class="header sticky">
			<!-- Top bar for website -->
			 <div class="tz-top-xtrabar">
				<div class="container">
					<?php if (hasModule('tools-languages')): ?>
						<div class="language-wrap">
							<div class="language">
								<jdoc:include type="modules" name="tools-languages" style="clean" />
							</div>
						</div>
					<?php endif; ?>
					<div class="right-content-wrap">
						<?php if (hasModule('google-review')): ?>
							<jdoc:include type="modules" name="google-review" style="clean" />
						<?php endif; ?>
						<?php if(!empty($this->params->get('telefoon'))) { ?>
						<div class="tools">
							<jdoc:include type="modules" name="tools-telephone" style="clean" />
							<div class="phone">
								<p><a href="tel:<?php echo $this->params->get('telefoon');?>"><i class="fa fa-phone"></i> <span><?php echo $this->params->get('telefoon');?></span></a></p>
							</div>
						</div>
						<?php } ?>
						<div class="button">
							<jdoc:include type="modules" name="bookbuttons" style="clean" />
						</div>
					</div>
				</div>
			</div>
            <div class="container">
                <div class="logo">
                    <a href="<?php echo JUri::root(); ?>">
                         <jdoc:include type="modules" name="logo" style="clean" />
                    </a>
                </div>
                <div class="container_menu">
                    <div class="nostickcon">
                        <div class="navigation">
                            <jdoc:include type="modules" name="menu" />
							<div class="mobile-language">
								<div class="language">
									<jdoc:include type="modules" name="tools-languages" style="clean" />                 
								</div>
							</div>
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- slider -->
        <section class="slider">
			<?php require_once __DIR__ . '/html/article-header-banner.php'; ?>
			<?php if (hasModule('header_search')): ?>
				<div class="header_search overlay_outer">
					<div class="container">
						<div class="header-search-book">
							<jdoc:include type="modules" name="header_search" />
						</div>
					</div>
				</div>
			<?php endif; ?>
        </section>
        <!-- main content -->

        <section class="content">
            <div class="container">
                <?php if (hasModule('contactpage')): ?>
                    <div class="row">
                        <div class="col12 contactform">
                            <jdoc:include type="modules" name="contactpage" style="clean" />
                        </div>
                    </div>
                    <!-- Vervolg content -->
                <?php elseif(countModules('content-left') || !empty($data['article-titan']->rawvalue)) : ?>
                    <div class="row">
                        <div class="col8 maincontent">
                            <jdoc:include type="component" />
                        </div>
                        <div class="col4 sidebar">
                            <?php if ($data['article-titan']->rawvalue != ""): ?>
								<div class="zb-widget-code">
									<?php echo $data['article-titan']->rawvalue; ?>
								</div>
							<?php endif; ?>

                            <jdoc:include type="modules" name="content-left" style="clean" />
                        </div>

                    </div>
                <?php elseif (hasModule('content-right')): ?>
                        <div class="row">
							<div class="col8 maincontent">
                                <jdoc:include type="component" />
                            </div>
                            <div class="col4 sidebar">
                                <jdoc:include type="modules" name="content-right" style="clean" />
                            </div>
                        </div>
                <?php else: ?>
					<jdoc:include type="component" />
                <?php endif; ?>
            </div>
        </section>

		 <!-- Home keuze blokken -->
        <?php if(countModules('productblocks')) : ?>
            <section class="productblocks">
                <div class="container-fluid">
                    <jdoc:include type="modules" name="productblocks" />
                </div>
            </section>
        <?php endif; ?>

		<!-- Block Slider -->
        <?php if(countModules('blockslider')) : ?>
            <section class="blockslider">
                <div class="container">
                        <jdoc:include type="modules" name="blockslider" />
                </div>
            </section>
        <?php endif; ?>

		<?php require_once __DIR__ . '/html/article-gallery.php'; ?>

		<!-- SB prijsmatrix block -->
				<?php if ($data['article-prijsmatrix']->rawvalue != ""): ?>
					<section id="prijsmatrix" class="sb-prijsmatrix-block">
							<div class="container">
								<h2 class="module-header-title"><?php echo $data['article-prijsmatrix-title']->rawvalue; ?></h2>
							<?php
							if($id != "" && $view_article == 'article') {
								echo '<div class="toggle_footer_menu">';
								echo $data['article-prijsmatrix']->rawvalue;
								echo '</div>';
							} ?>
							</div>
					</section>
				<?php endif; ?>

		<!-- SB overview-packages block -->
				<?php if ($data['article-arrangementen']->rawvalue != ""): ?>
					<section id="arrangementen" class="sb-overview-packages-block">
							<div class="container">
								<h2 class="module-header-title"><?php echo $data['article-arrangementen-title']->rawvalue; ?></h2>
							<?php
							if($id != "" && $view_article == 'article') {
								echo '<div class="toggle_footer_menu">';
								echo $data['article-arrangementen']->rawvalue;
								echo '</div>';
							} ?>
							</div>
					</section>
				<?php endif; ?>

		<?php if(countModules('tabsblock')) : ?>
            <section class="tabs-block">
				<div class="container">
					<jdoc:include type="modules" name="tabsblock" style="clean" />
                </div>
            </section>
        <?php endif; ?>

        <!-- Sfeer fotos -->
        <?php if(countModules('sliderfooter')) : ?>
            <section class="blockslider blockslider-bottom">
				<div class="container">
						<jdoc:include type="modules" name="sliderfooter" style="clean" />
                </div>
            </section>
        <?php endif; ?>

		<?php require_once __DIR__ . '/html/article-impression.php'; ?>
		<?php if (hasModule('client_logoslider')): ?>
				<div class="client-logoslider">
					<div class="container">
						<jdoc:include type="modules" name="client_logoslider" style="clean" />
					</div>
				</div>
		<?php endif; ?>

        <!-- breadcrumbs module -->
        <?php if(countModules('breadcrumb')) : ?>
            <section class="breadcrumb-section">
                <div class="container">
                    <jdoc:include type="modules" name="breadcrumb" style="clean" />
                </div>
            </section>
        <?php endif; ?>

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <?php if(countModules('footer-1')) : ?>
                        <div class="footer-1 footerblok">
                            <jdoc:include type="modules" name="footer-1" style="clean" />
                        </div>
                    <?php endif; ?>

                        <div class="footer-2 footerblok">
                            <jdoc:include type="modules" name="footer-2" style="clean" />
								<div class="tenzer_sd_contact">
									<div itemscope="itemscope" itemtype="http://schema.org/LocalBusiness">
										<span class="module-header" itemprop="name"><?php echo $this->params->get('bedrijfsnaam');?></span>
											<div class="toggle_footer_menu">
												<div class="contact-list" itemscope="itemscope" itemtype="http://schema.org/PostalAddress" itemprop="address">
													<div class="info">
													<span itemprop="streetAddress"><?php echo $this->params->get('adres');?></span>
													<span class="postcode" itemprop="postalCode"><?php echo $this->params->get('postcode');?></span>
													<span itemprop="addressLocality"><?php echo $this->params->get('plaats');?></span>
													</div>
												</div>
												<div class="contact-list" itemprop="telephone">
													<a href="tel:<?php echo $this->params->get('telefoon');?>"><?php echo $this->params->get('telefoon');?></a>
												</div>
												<div class="contact-list" itemprop="email">
													<a href="mailto:<?php echo $this->params->get('mailadres');?>"><?php echo $this->params->get('mailadres');?></a>
												</div>
												<div class="custom_social">
													<?php if(!empty($this->params->get('social_facebook'))) { ?>
														<a href="<?php echo $this->params->get('social_facebook');?>" target="_blank"><i class="fab fa-facebook"></i></a>
													<?php } ?>
													<?php if(!empty($this->params->get('social_instagram'))) { ?>
														<a href="<?php echo $this->params->get('social_instagram');?>" target="_blank"><i class="fab fa-instagram"></i></a>
													<?php } ?>
													<?php if(!empty($this->params->get('social_twitter'))) { ?>
														<a href="<?php echo $this->params->get('social_twitter');?>" target="_blank"><i class="fab fa-twitter"></i></a>
													<?php } ?>
													<?php if(!empty($this->params->get('social_youtube'))) { ?>
														<a href="<?php echo $this->params->get('social_youtube');?>" target="_blank"><i class="fab fa-youtube"></i></a>
													<?php } ?>
												</div>
											</div>
									</div>
								</div>
                        </div>

                    <?php if(countModules('footer-3')) : ?>
                        <div class="footer-3 footerblok">
                            <jdoc:include type="modules" name="footer-3" style="clean" />
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </footer>



        <div class="copyright">
            <jdoc:include type="modules" name="copyright" style="clean" />
        </div>

        <!-- Search and book bottombar -->
        <?php if(countModules('zb-bottom-bar')) : ?>
            <div class="zb-bottom-bar">
                <div class="container">
                    <jdoc:include type="modules" name="zb-bottom-bar" style="clean" />
                </div>
            </div>
        <?php endif; ?>

		<link rel="preload" id="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/select2.css" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/select2.css"></noscript>
        <link rel="preload" id="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/swiper-bundle.min.css" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/swiper-bundle.min.css"></noscript>
		<link rel="preload" id="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/jquery.fancybox.min.css" as="style" onload="this.rel='stylesheet'">
		<noscript><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/jquery.fancybox.min.css"></noscript>
		<link rel="preload" id="stylesheet" href="https://cdn.harbor.fortizar.com/alkenhaer-2022/app.css" as="style" onload="this.rel='stylesheet'">
		<noscript><link rel="stylesheet" href="https://cdn.harbor.fortizar.com/alkenhaer-2022/app.css"></noscript>

        <!-- search and book JS -->
        <?php if(countModules('zb-javascript')) : ?>
            <jdoc:include type="modules" name="zb-javascript" style="clean" />
        <?php endif; ?>

        <!-- footer pagespeed -->
        <jdoc:include type="modules" name="pagespeedfooter" style="clean"/>

		<link rel="preload" id="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/preloader.css" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/preloader.css"></noscript>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/swiper-bundle.min.js" defer></script>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/select2.js" defer></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/jquery.fancybox.min.js" defer></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/menu_script.js" defer></script>
        <script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/custom.js" defer></script>
    </body>
</html>