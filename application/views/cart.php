<div class="page-container drawer-page-content" id="PageContainer">
    <main class="main-content" id="MainContent" role="main">
        <div id="shopify-section-cart-template" class="shopify-section">
            <div class="page-width" data-section-id="cart-template" data-section-type="cart-template">
                <div class="section-header text-center">
                    <h1>Your cart</h1>
                </div>
                <?php if (!empty($cartInfo)) { ?>
                    <form name="frm" class="cart" method="post" action="<?= base_url(); ?>products/order_sub">
                        <table>
                            <thead class="cart__row cart__header">
                                <tr>
                                    <th colspan="2">Product</th>
                                    <th>Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                foreach ($cartInfo as $cart) {
                                    $varInfo = $this->frontend_model->fetch_recordbyid('product_variation', array('id' => $cart['variation_id']));
                                    $proInfo = $this->frontend_model->fetch_recordbyid('product', array('id' => $varInfo->product_id));
                                    ?>
                                <input type="hidden" name="product[]" value="<?= $proInfo->id ?>">
                                <input type="hidden" name="variation[<?= $proInfo->id ?>][]" value="<?= $varInfo->id ?>">
                                <tr class="cart__row border-bottom line1 cart-flex border-top">
                                    <td class="cart__image-wrapper cart-flex-item">
                                        <img class="cart__image" src="<?= base_url() ?>uploads/<?= $proInfo->product_image ?>" alt="">
                                    </td>
                                    <td class="cart__meta small--text-left cart-flex-item">
                                        <div class="list-view-item__title">
                                            <?= $varInfo->name; ?>
                                        </div>

                                        <p class="small--hide">
                                            <a href="<?= base_url(); ?>cart/delete_cart_item/<?= $cart['id']; ?>" class="btn btn--small btn--secondary cart__remove">Remove</a>
                                        </p>
                                    </td>
                                    <td class="cart__price-wrapper cart-flex-item">
                                        $<?= number_format($varInfo->price, 2) ?>
                                    </td>
                                    <td class="cart__update-wrapper cart-flex-item text-right">
                                        <div class="cart__qty">
                                            <input class="cart__qty-input" type="number" name="quantity[<?= $proInfo->id ?>][]" value="<?= $cart['quantity']; ?>" min="1" max="25">
                                        </div>
                                    </td>
                                    <td class="text-right small--hide">
                                        <div>
                                            $<?= number_format($varInfo->price * $cart['quantity'], 2) ?>
                                            <?php $total = $total + ($varInfo->price * $cart['quantity']); ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                        <footer class="cart__footer">
                            <div class="grid">
                                <div class="grid__item text-right small--text-center">
                                    <div>
                                        <span class="cart__subtotal-title">Subtotal</span>
                                        <span class="cart__subtotal">$<?= number_format($total, 2); ?></span>
                                    </div>
                                    <div class="cart__shipping">Shipping &amp; taxes calculated at checkout</div>
                                    <a href="<?= base_url() ?>" class="btn btn--secondary cart__update cart__continue--large small--hide">Continue shopping</a>
                                    <input type="submit" name="update" class="btn btn--secondary cart__update cart__update--large small--hide" value="Update">
                                    <?php if (empty($this->session->userdata('name'))) { ?>
                                        <a href="<?php echo base_url(); ?>auth/login"  name="checkout" class="btn btn--small-wide" value="Check out">Check out</a>
                                        <?php
                                    } else {
                                        $userInfo = $this->frontend_model->fetch_recordbyid('users', array('id' => $this->session->userdata('user_id')));
                                        if (empty($userInfo->id_proof)) {
                                            $data = array('status' => false, 'msg' => "Please upload your id proof for proceed checkout process.");
                                            $this->session->set_userdata($data);
                                            ?>
                                            <a href="<?= base_url(); ?>dashboard"  name="checkout" class="btn btn--small-wide" value="Check out">Check out</a>
                                        <?php } else {
                                            ?>
                                            <a href="<?= base_url(); ?>checkout"  name="checkout" class="btn btn--small-wide" value="Check out">Check out</a>  
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </footer>
                    </form> 
                <?php } else { ?>
                    <main class="main-content" id="MainContent" role="main">
                        <div class="page-width">
                            <div class="alert-danger">
                                Your cart is empty.
                            </div>
                        </div>
                    </main>
                <?php } ?>
            </div>
        </div>
    </main>
</div> 
