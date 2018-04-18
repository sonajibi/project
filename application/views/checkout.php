<?php
if (!defined('front_assets')) {
    define("front_assets", base_url() . "assets/");
}
$userInfo = $this->frontend_model->fetch_recordbyid('users', array('id' => $this->session->userdata('user_id')));
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" class="no-js windows chrome desktop page--no-banner page--logo-main page--show page--show card-fields">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0">

        <title>Checkout</title>

        <link href="<?= front_assets; ?>css/checkout.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="maxcdn/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

        <script src="<?= front_assets; ?>js/checkout.js"></script>
        <!--<script src="js/checkout-2.js"></script>-->
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
        </style>
    </head>

    <body>

        <div class="content" data-content>
            <div class="wrap">
                <div class="main" role="main">
                    <div class="main__header">
                        <a class="logo logo--left" href="#">
                            <img src="<?php echo front_assets; ?>images/logo.png" alt="Logo" class="logo__image logo__image--medium" />
                        </a>
                        <h1 class="visually-hidden">
                            Customer information
                        </h1>

                        <ul class="breadcrumb ">
                            <li class="breadcrumb__item breadcrumb__item--completed">
                                <a class="breadcrumb__link" href="<?= base_url(); ?>">Home</a>
                                <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4" /></svg>
                            </li>

                            <li class="breadcrumb__item breadcrumb__item--current">
                                <a class="breadcrumb__link" href="<?= base_url(); ?>cart">Cart</a>
                                <svg class="icon-svg icon-svg--size-10 breadcrumb__chevron-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4" /></svg>
                            </li>
                            <li class="breadcrumb__item breadcrumb__item--blank">
                                <span class="breadcrumb__text">Checkout</span>

                            </li>

                        </ul>
                    </div>

                    <div class="main__content">
                        <div class="step" data-step="contact_information">
                            <form method="post" class="edit_checkout" action="<?= base_url(); ?>checkout/order_now">
                                <div class="step__sections">
                                    <div class="section section--contact-information">
                                        <div class="section__header">
                                            <div class="layout-flex layout-flex--tight-vertical layout-flex--loose-horizontal layout-flex--wrap">
                                                <h2 class="section__title layout-flex__item layout-flex__item--stretch">Contact information</h2>
                                            </div>
                                        </div>
                                        <div class="section__content" data-section="customer-information">
                                            <input value="tony@gmail.com" size="30" type="hidden" name="email" id="checkout_email" />
                                            <div class="logged-in-customer-information">
                                                <div class="logged-in-customer-information__avatar-wrapper">
                                                    <div class="logged-in-customer-information__avatar gravatar" style="background-image: url('<?php echo front_assets; ?>images/profile-icon.png')"></div>
                                                </div>
                                                <p class="logged-in-customer-information__paragraph">
                                                    <span class="page-main__emphasis"><?= $userInfo->name; ?></span>
                                                    <span data-rtl-ensure>(<?= $userInfo->email; ?>)</span>
                                                    <br />
                                                    <a href="<?php echo base_url(); ?>login/logout">Logout</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="section section--shipping-address" >
                                        <div class="section__header">
                                            <h2 class="section__title">
                                                Shipping Address
                                            </h2>
                                        </div>
                                        <?php
                                        if (!empty($this->session->userdata('msg'))) {
                                            if (!($this->session->userdata('status'))) {
                                                ?>

                                                <div class="page-width">
                                                    <div class="alert-danger">
                                                        <?= $this->session->userdata('msg'); ?> 
                                                    </div>
                                                </div>


                                                <?php
                                            } else {
                                                ?>

                                                <div class="page-width">
                                                    <div class="alert-success">
                                                        <strong>Success!</strong> <?= $this->session->userdata('msg'); ?> 
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                            $data = array('status' => false, 'msg' => "");
                                            $this->session->set_userdata($data);
                                        }
                                        ?>
                                        <br>
                                        <div class="section__content">
                                            <div class="fieldset">
                                                <div class="field field--optional">
                                                    <label class="field__label" for="checkout_shipping_address_first_name">Name</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Name" class="field__input" size="30" type="text" value="<?= $userInfo->name; ?>" name="name" id="checkout_shipping_address_first_name" />
                                                    </div>
                                                </div>

                                                <div class="field field--required">
                                                    <label class="field__label" for="checkout_shipping_address_address1">Address</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Address" role="combobox" aria-expanded="false" aria-required="true" class="field__input" size="30" type="text" name="address" id="checkout_shipping_address_address1" />
                                                    </div>
                                                </div>

                                                <div class="field field--required">
                                                    <label class="field__label" for="checkout_shipping_address_city">City</label>
                                                    <div class="field__input-wrapper">

                                                        <select size="1" class="field__input field__input--select" aria-required="true" name="city" id="checkout_shipping_address_country">

                                                            <option value="">Select City</option>
                                                            <?php
                                                            $cityInfo = $this->frontend_model->fetch_record('cities');
                                                            if (!empty($cityInfo)) {
                                                                foreach ($cityInfo as $city) {
                                                                    ?>
                                                                    <option value="<?= $city['city']; ?>"><?= $city['city']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>


                                                    </div>
                                                </div>
                                                <div class="field--three-eights field field--required">
                                                    <label class="field__label" for="checkout_shipping_address_country">Province</label>
                                                    <div class="field__input-wrapper field__input-wrapper--select">
                                                        <select size="1" class="field__input field__input--select" aria-required="true" name="province" id="checkout_shipping_address_country">

                                                            <option value="">Select Province</option>
                                                            <?php
                                                            $cityInfo = $this->frontend_model->fetch_record('states');
                                                            if (!empty($cityInfo)) {
                                                                foreach ($cityInfo as $city) {
                                                                    ?>
                                                                    <option value="<?= $city['state']; ?>"><?= $city['state']; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>

                                                        </select>
                                                       
                                                    </div>
                                                </div>
                                                <div class="field--three-eights field field--required">
                                                    <label class="field__label" for="checkout_shipping_address_province">Country</label>
                                                    <div class="field__input-wrapper field__input-wrapper--select">
                                                        <input placeholder="Country" class="field__input" aria-required="true" value="USA" size="30" type="text" name="country" id="checkout_shipping_address_city" />
                                                    </div>
                                                </div>
                                                <div class="field--quarter field field--required">
                                                    <label class="field__label" for="checkout_shipping_address_zip">Postal Code</label>
                                                    <div class="field__input-wrapper">
                                                        <input placeholder="Postal code" class="field__input" aria-required="true" size="30" type="text" name="postal_code" id="checkout_shipping_address_zip" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="step__footer">
                                    <button name="button" type="submit" class="step__footer__continue-btn btn">
                                        <span class="btn__content">ORDER NOW</span>
                                        <i class="btn__spinner icon icon--button-spinner"></i>
                                    </button>
                                    <a class="step__footer__previous-link" href="<?= base_url(); ?>cart"><svg class="icon-svg icon-svg--color-accent icon-svg--size-10 previous-link__icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M8 1L7 0 3 4 2 5l1 1 4 4 1-1-4-4" /></svg><span class="step__footer__previous-link-content">Return to cart</span></a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="main__footer">
                        <div role="contentinfo" aria-label="Footer">
                            <ul class="policy-list">
                                <li class="policy-list__item">
                                    <a href="#">Privacy policy</a>
                                </li>
                                <li class="policy-list__item">
                                    <a href="#">Terms of service</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="sidebar" role="complementary">
                    <div class="sidebar__content">
                        <div id="order-summary" class="order-summary order-summary--is-collapsed" data-order-summary>
                            <div class="order-summary__sections">
                                <div class="order-summary__section order-summary__section--product-list">
                                    <div class="order-summary__section__content">
                                        <table class="product-table">
                                            <tbody>
                                                <?php if (!empty($cartInfo)) { ?>
                                                    <?php
                                                    $total = 0;
                                                    foreach ($cartInfo as $cart) {
                                                        $varInfo = $this->frontend_model->fetch_recordbyid('product_variation', array('id' => $cart['variation_id']));
                                                        $proInfo = $this->frontend_model->fetch_recordbyid('product', array('id' => $varInfo->product_id));
                                                        ?>
                                                        <tr class="product">
                                                            <td class="product__image">
                                                                <div class="product-thumbnail">
                                                                    <div class="product-thumbnail__wrapper">
                                                                        <img alt="Black Tuna - 3.5" class="product-thumbnail__image" src="<?= base_url() ?>uploads/<?= $proInfo->product_image ?>" />
                                                                    </div>
                                                                    <span class="product-thumbnail__quantity" aria-hidden="true"><?= $cart['quantity']; ?></span>
                                                                </div>
                                                            </td>
                                                            <td class="product__description">
                                                                <span class="product__description__name order-summary__emphasis"><?= $varInfo->name; ?></span>
                                                                <span class="product__description__variant order-summary__small-text">$<?= number_format($varInfo->price, 2) ?></span>
                                                            </td>
                                                            <td class="product__quantity visually-hidden">
                                                                1
                                                            </td>
                                                            <td class="product__price">
                                                                <span class="order-summary__emphasis"> $<?= number_format($varInfo->price * $cart['quantity'], 2) ?>
                                                                    <?php $total = $total + ($varInfo->price * $cart['quantity']); ?></span>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="order-summary__section order-summary__section--total-lines" >
                                    <table class="total-line-table">
                                        <tfoot class="total-line-table__footer">
                                            <tr class="total-line">
                                                <th class="total-line__name payment-due-label" scope="row">
                                                    <span class="payment-due-label__total">Total</span>
                                                </th>
                                                <td class="total-line__price payment-due">

                                                    <span class="payment-due__price">
                                                        $<?= number_format($total, 2); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
