<style>
    .grid-view-item__image{
        width:225px;
		height:225px
    }
    /* Contain floats: nicolasgallagher.com/micro-clearfix-hack/ */
    .clearfix:before, .clearfix:after {
        content: "";
        display: table;
    }

    .clearfix:after {
        clear: both;
    }

    .clearfix {
        zoom: 1;
    }
    /* Subnavigation styles */
    .subnav {
        clear: both;
        list-style-type: none;
        margin: 35px 0;
        padding: 0;
    }

    .subnav li {
        display: block;
        float: left;
    }

    .subnav li a {
        display: block;
        height: 28px;
        line-height: 28px;
        padding: 0 7px;
        -webkit-border-radius: 7px;
        -moz-border-radius: 7px;
        border-radius: 7px;
        background: #eee;
        margin: 0 7px 7px 0;
        color: #666;
    }

    .subnav li a:hover, .subnav li.active a {
        background: #a4c129;
        color: #fff;
    }

    .collec {
        margin-left: auto;
        margin-right: auto;
        width: 365px;
        margin-top: 0px;
    }
			 .product-list{
				background: #105436;
				padding: 25px 30px 25px 0px;
			 }
		 .grid-view-item__title{
			 color:#fff
		 }
		 .product-price__price{
			 color: #aaadaf;
		 }
</style>
<div class="page-container" id="PageContainer">
    <main class="main-content" id="MainContent" role="main">
        <div id="shopify-section-collection-template" class="shopify-section">
            <div data-section-id="collection-template" data-section-type="collection-template">
                <header class="collection-header">
                    <div class="grid">
                        <div class="grid__item one-whole">
                            <ul class="subnav clearfix collec">
                                <?php
                                $category = $this->frontend_model->fetch_record('category');
                                ?>
                                <li class="<?= (empty($this->uri->segment(3)))?'active':''; ?>" id="allList"><a href="<?php echo base_url(); ?>">All</a>
                                 </li>
                                <?php
                                if (!empty($category)) {
                                    foreach ($category as $cat) {
                                        ?>
                                        <li class="<?= (($this->uri->segment(3)==$cat['id']))?'active':''; ?>"><a href="<?php echo base_url(); ?>products/index/<?= $cat['id']; ?>"><?= $cat['name']; ?></a>
                                       
                                      </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <hr class="header-hr" />
                </header>

                <div class="page-width" id="Collection">
				<div id="all" class="custom-box" style="display:none">
						Enjoy our collection of refreshing beverages which includes our special smoothies, soothing teas and many more.
					</div>
					<div id="expresso" class="custom-box" style="display:none">
						<b class="theme-color">Espresso</b> is generally thicker than coffee brewed by other methods, has a higher concentration of suspended and dissolved solids, and has crema on top.
					</div>
					<div id="coffee" class="custom-box" style="display:none">
						<b class="theme-color">Coffee</b> is a brewed drink prepared from roasted coffee beans, the seeds found inside 'berries' of the Coffea plant.
					</div>
					<div id="tea" class="custom-box" style="display:none">
						<b class="theme-color">Tea</b> is an aromatic beverage commonly prepared by pouring hot or boiling water over cured leaves. After water, it is the most widely consumed drink in the world.
					</div>
					<div id="smoothie" class="custom-box" style="display:none">
						<b class="theme-color">Smoothie</b> is a thick beverage made from blended raw fruit, vegetables or ice cream and cookies with other ingredients such as water, ice, or sweeteners.
					</div>
                    <div class="grid grid--uniform grid--view-items product-list">
                        <?php if (!empty($productInfo)) {
             ?>
                            <form name="frm" method="post" action="<?= base_url(); ?>products/order_sub">
                                

                                    <?php
                                    foreach ($productInfo as $product) {
                                        ?>

                                        <input type="hidden" name="product[]" value="<?= $product['id'] ?>">
									<div class="grid__item grid__item--collection-template small--one-half medium-up--one-quarter mb-50">
                                        <div class="grid-view-item mb-0">
                                            <div class="imgfix">
                                                <img class="grid-view-item__image" src="<?= base_url() ?>uploads/<?= $product['product_image'] ?>" alt="Black Tuna">
                                            </div>
                                            <?php
                                            $variations = $this->frontend_model->fetch_condrecord('product_variation', ['product_id' => $product['id']]);
                                            if (!empty($variations)) {
                                                foreach ($variations as $varInfo) {
                                                    ?>
                                                    <input type="hidden" name="variation[<?= $product['id'] ?>][]" value="<?= $varInfo['id'] ?>">
                                                    <div class = "h4 grid-view-item__title"><?= $varInfo['name'] ?></div>
                                                    <div class = "grid-view-item__meta mb-40">
                                                        <div class = "float-left">
                                                            <span class = "shopify-product-reviews-badge"></span>
                                                            <span class = "product-price__price">$<?= number_format($varInfo['price'], 2) ?></span>
                                                        </div>
                                                        <div class = "float-right">
                                                            <div class = "input-group">
                                                                <!--<span class = "input-group-btn">
                                                                    <button type = "button" class = "quantity-right-plus btn add-btn" data-type = "minus" data-field = "">
                                                                        <i class = "fa fa-plus" aria-hidden = "true"></i>
                                                                    </button>
                                                                </span>-->
                                                                <input type = "number" name="quantity[<?= $product['id'] ?>][]" class = "form-control quantity-input" value = "0" min = "0" max = "25">
                                                                <!--<span class = "input-group-btn">
                                                                    <button type = "button" class = "quantity-left-minus btn minus-btn" data-type = "plus" data-field = "">
                                                                        <i class = "fa fa-minus" aria-hidden = "true"></i>
                                                                    </button>
                                                                </span>-->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </div>
										
										 </div>
                                        <?php
                                    }
                                    ?>




                               
                                <div style="clear:both;">
                                    <div class="text-center">
                                        <p>
                                            <input type="submit" class="btn" value="ORDER">
                                        </p>

                                    </div>
                                </div>
                            </form>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
	
	<script type="text/javascript">

  var url = window.location.href;
  
  var msg = document.getElementById('all');
  if ($("#allList").hasClass("active")) {
      msg.style.display = "block";
  }

  var msg = document.getElementById('expresso');
  if( url.search( '1' ) > 0 ) {
      msg.style.display = "block";
  }
  
  var msg = document.getElementById('coffee');
  if( url.search( '2' ) > 0 ) {
      msg.style.display = "block";
  }
  
  var msg = document.getElementById('tea');
  if( url.search( '3' ) > 0 ) {
      msg.style.display = "block";
  }
  
  var msg = document.getElementById('smoothie');
  if( url.search( '4' ) > 0 ) {
      msg.style.display = "block";
  }
</script>