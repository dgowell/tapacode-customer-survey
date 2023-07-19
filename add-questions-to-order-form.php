<?php

//add a select field after the checkout billing form with the label "How did you hear about us?" and the responses Web search (Google, Bing, etc), Referral/word of mouth, Social Media (Facebook, Instagram, etc), Advertisements and Other - please specify, if they choose other display a textfield where the user can input their answer

add_action( 'woocommerce_after_checkout_billing_form', 'add_select_field' );

function add_select_field( $checkout ) {
//add a select field with the label "How did you hear about us?" and the responses Web search (Google, Bing, etc), Referral/word of mouth, Social Media (Facebook, Instagram, etc), Advertisements and Other - please specify, if they choose other display a textfield where the user can input their answer
    woocommerce_form_field( 'source-of-awareness', array(
        'type'          => 'select',
        'class'         => array('source-of-awareness form-row-wide'),
        'label'         => __('How did you hear about us?'),
        'options'       => array(
            'web-search'   => __('Web search (Google, Bing, etc)', 'woocommerce' ),
            'referral-word-of-mouth'   => __('Referral/word of mouth', 'woocommerce' ),
            'social-media'   => __('Social Media (Facebook, Instagram, etc)', 'woocommerce' ),
            'advertisements'   => __('Advertisements', 'woocommerce' ),
            'other'   => __('Other - please specify', 'woocommerce' )
        )
    ), $checkout->get_value( 'source-of-awareness' ));

    // Add a text field for the "Other" option
    ?>
    <div class="woocommerce-additional-fields">
        <div class="woocommerce-additional-fields__field-wrapper">
            <p class="form-row form-row-wide" id="other-source-of-awareness-field" style="display:none;">
                <label for="other-source-of-awareness"><?php _e( 'Please specify', 'woocommerce' ); ?> <span class="required">*</span></label>
                <input type="text" class="input-text" name="other-source-of-awareness" id="other-source-of-awareness" required>
            </p>
        </div>
    </div>
    <?php

    // Add JavaScript to show or hide the text field based on the selected value
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('#source-of-awareness').change(function() {
                if ($(this).val() == 'other') {
                    $('#other-source-of-awareness-field').show();
                    $('#other-source-of-awareness').prop('required', true);
                } else {
                    $('#other-source-of-awareness-field').hide();
                    $('#other-source-of-awareness').prop('required', false);
                }
            });
        });
    </script>
    <?php
}


add_action( 'woocommerce_after_checkout_billing_form', 'add_question_where_will_product_be_used' );

function add_question_where_will_product_be_used( $checkout ) {
//add a select field with the label "Where will your new purchase be used?" and the options Boat, Motor Vehicle, Garden Building, Home, Glamping/Camping Site, Allotment/Community Garden, School/Nursery, Church/Cemetery, and Other - please specify
    woocommerce_form_field( 'customer-category', array(
        'type'          => 'select',
        'class'         => array('customer-category form-row-wide'),
        'label'         => __('Where will your new purchase be used?'),
        'options'       => array(
            'boat'   => __('Boat', 'woocommerce' ),
            'motor-vehicle'   => __('Motor Vehicle', 'woocommerce' ),
            'garden-building'   => __('Garden Building', 'woocommerce' ),
            'home'   => __('Home', 'woocommerce' ),
            'glamping-camping-site'   => __('Glamping/Camping Site', 'woocommerce' ),
            'allotment-community-garden'   => __('Allotment/Community Garden', 'woocommerce' ),
            'school-nursery'   => __('School/Nursery', 'woocommerce' ),
            'church-cemetery'   => __('Church/Cemetery', 'woocommerce' ),
            'other'   => __('Other - please specify', 'woocommerce' )
        )
    ), $checkout->get_value( 'customer-category' ));
// Add a text field for the "Other" option
?>
<div class="woocommerce-additional-fields">
    <div class="woocommerce-additional-fields__field-wrapper">
        <p class="form-row form-row-wide" id="other-customer-category-field" style="display:none;">
            <label for="other-customer-category"><?php _e( 'Please specify', 'woocommerce' ); ?> <span class="required">*</span></label>
            <input type="text" class="input-text" name="other-customer-category" id="other-customer-category" required>
        </p>
    </div>
</div>
<?php

// Add JavaScript to show or hide the text field based on the selected value
?>
<script>
    jQuery(document).ready(function($) {
        $('#customer-category').change(function() {
            if ($(this).val() == 'other') {
                $('#other-customer-category-field').show();
                $('#other-customer-category').prop('required', true);
            } else {
                $('#other-customer-category-field').hide();
                $('#other-customer-category').prop('required', false);
            }
        });
    });
</script>
<?php
}
?>