<div class="overlay">
    <div id="custom-popup-form">
        <button id="close-popup-button">&times;</button>
        <div class="popup-header">
            <div class="popup-subheader">
                <h2>Customer Satisfaction Survey</h2>
                <p>Please answer the questions below to help us improve your experience.</p>
            </div>
        </div>
        <form id="customer-satisfaction-form">
            <!-- Add a hidden input field for the order number -->
            <input type="hidden" id="order-key" name="order-key" value="<?php echo $order_key ?>">

            <div class="question selected">
                <label for="ease-of-use">How would you rate the ease of using our website?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">
                        <input type="radio" id="ease-of-use-<?php echo $i; ?>" name="ease-of-use"
                            value="<?php echo $i; ?>" required>
                        <label for="ease-of-use-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>">
                            <?php echo ($i == 1) ? 'Poor' : ''; ?><?php echo ($i == 5) ? 'Excellent' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>

                <div id="ease-of-use-feedback-container" style="display:none;">
                    <label for="ease-of-use-feedback">How can we improve to enhance your experience
                        on our website?</label>
                    <textarea id="ease-of-use-feedback" name="ease-of-use-feedback"></textarea>
                </div>
            </div>
            <div class="question">
                <label for="quality-of-info">How would you rate the quality of information provided on our
                    website?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">
                        <input type="radio" id="quality-of-info-<?php echo $i; ?>" name="quality-of-info"
                            value="<?php echo $i; ?>" required>
                        <label for="quality-of-info-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>">
                            <?php echo ($i == 1) ? 'Poor' : ''; ?><?php echo ($i == 5) ? 'Excellent' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>

                <div id="quality-of-info-container" style="display:none;">
                    <label for="quality-of-info-feedback">How can we improve the quality of our information?</label>
                    <textarea id="quality-of-info-feedback" name="quality-of-info-feedback"></textarea>
                </div>
            </div>
            <div class="question">
                <label for="consideration-of-competition">Did you consider other options before placing this
                    order?</label>
                <div class="radio-group even">
                    <div class="radio">
                        <input type="radio" id="consideration-of-competition-yes" name="consideration-of-competition"
                            value="yes">
                        <label for="consideration-of-competition-yes">Yes</label>
                    </div>
                    <div class="radio">
                        <input type="radio" id="consideration-of-competition-no" name="consideration-of-competition"
                            value="no">
                        <label for="consideration-of-competition-no">No</label>
                    </div>
                </div>

                <div id="consideration-of-competition-container" style="display:none;">
                    <label for="considered-products">Which products did you consider?</label>
                    <textarea id="considered-products" name="considered-products"></textarea>
                </div>

            </div>
            <div class="question">
                <label for="purchase-decision">What made you decide to buy from WooWoo?</label>
                <textarea id="purchase-decision" name="purchase-decision"></textarea>
            </div>
            <div class="question">
                <label for="recommendation">How likely are you to recommend WooWoo to a friend or colleague?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">
                        <input type="radio" id="recommendation-<?php echo $i; ?>" name="recommendation"
                            value="<?php echo $i; ?>" required>
                        <label for="recommendation-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>">
                            <?php echo ($i == 1) ? 'Very Unlikely' : ''; ?><?php echo ($i == 5) ? 'Very Likely' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>
    <div id="custom-form-success">
        <h2>Thank you for your feedback!</h2>
        <p>We appreciate you taking the time to help us improve your experience.</p>
        <button id="close-success-button">Close</button>
    </div>
</div>