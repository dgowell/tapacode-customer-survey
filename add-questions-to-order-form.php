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

    $other_source_of_awareness_class = array( 'form-row-wide', 'other-source-of-awareness-wrapper' );
if ( $checkout->get_value( 'customer-source-of-awareness' ) !== 'other' ) {
    // If the previous field doesn't have "Other" selected, hide the field and remove the "required" attribute
    $other_source_of_awareness_class[] = 'hidden';
    $other_source_of_awareness_required = false;
} else {
    // If the previous field has "Other" selected, show the field and make it required
    $other_source_of_awareness_required = true;
}

woocommerce_form_field( 'other-source-of-awareness', array(
    'type'          => 'text',
    'class'         => $other_source_of_awareness_class,
    'label'         => __( 'Please specify', 'woocommerce' ),
    'required'      => $other_source_of_awareness_required,
    'placeholder'   => '',
    'autocomplete' => 'other-source-of-awareness',
), $checkout->get_value( 'other-source-of-awareness' ));
   

    // Add JavaScript to show or hide the text field based on the selected value
    ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const customerSourceOfAwarenessSelect = document.getElementById('source-of-awareness');
        const otherSourceOfAwarenessWrapper = document.querySelector('.other-source-of-awareness-wrapper');

        customerSourceOfAwarenessSelect.addEventListener('change', () => {
            if (customerSourceOfAwarenessSelect.value === 'other') {
                otherSourceOfAwarenessWrapper.classList.remove('hidden');
                document.getElementById('other-source-of-awareness').required = true;
            } else {
                otherSourceOfAwarenessWrapper.classList.add('hidden');
                document.getElementById('other-source-of-awareness').required = false;
            }
        });
    });
</script>
<?php
}


add_action( 'woocommerce_after_checkout_billing_form', 'add_question_where_will_product_be_used' );

function add_question_where_will_product_be_used( $checkout ) {
    // Add a select field with the label "Where will your new purchase be used?" and the options Boat, Motor Vehicle, Garden Building, Home, Glamping/Camping Site, Allotment/Community Garden, School/Nursery, Church/Cemetery, and Other - please specify
    woocommerce_form_field( 'where-will-product-be-used', array(
        'type'          => 'select',
        'class'         => array('where-will-product-be-used form-row-wide'),
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
    ), $checkout->get_value( 'where-will-product-be-used' ));

    $other_where_will_product_be_used_class = array( 'form-row-wide', 'other-where-will-product-be-used-wrapper' );
    if ( $checkout->get_value( 'where-will-product-be-used' ) !== 'other' ) {
        // If the previous field doesn't have "Other" selected, hide the field and remove the "required" attribute
        $other_where_will_product_be_used_class[] = 'hidden';
        $other_where_will_product_be_used_required = false;
    } else {
        // If the previous field has "Other" selected, show the field and make it required
        $other_where_will_product_be_used_required = true;
    }
    
    woocommerce_form_field( 'other-where-will-product-be-used', array(
        'type'          => 'text',
        'class'         => $other_where_will_product_be_used_class,
        'label'         => __( 'Please specify', 'woocommerce' ),
        'required'      => $other_where_will_product_be_used_required,
        'placeholder'   => '',
        'autocomplete' => 'other-where-will-product-be-used',
    ), $checkout->get_value( 'other-where-will-product-be-used' ));

    // Add JavaScript to show or hide the text field based on the selected value
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const whereWillProductBeUsedSelect = document.getElementById('where-will-product-be-used');
            const otherWhereWillProductBeUsedWrapper = document.querySelector('.other-where-will-product-be-used-wrapper');

            whereWillProductBeUsedSelect.addEventListener('change', () => {
                if (whereWillProductBeUsedSelect.value === 'other') {
                    otherWhereWillProductBeUsedWrapper.classList.remove('hidden');
                    document.getElementById('other-where-will-product-be-used').required = true;
                } else {
                    otherWhereWillProductBeUsedWrapper.classList.add('hidden');
                    document.getElementById('other-where-will-product-be-used').required = false;
                }
            });
        });
    </script>
    <?php
}
?>