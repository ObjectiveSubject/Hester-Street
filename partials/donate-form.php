<form>
    
    <div class="form-group u-mt-4">
        <div class="h4">Amount</div>
        <ul class="u-clearfix">
            <?php foreach( array( 25, 50, 100, 500, 1000 ) as $amount ) : ?>
            <li class="u-float-left u-mr-1">
                <input id="amount-<?php echo $amount; ?>" class="form-field" value="<?php echo $amount; ?>" type="radio" name="amount"/>
                <label for="amount-<?php echo $amount; ?>" class="label">$<?php echo $amount; ?></label>
            </li>
            <?php endforeach; ?>
            <li class="u-mr-1">
                <input id="amount-other" class="form-field" value="other" type="radio" name="amount"/>
                <label for="amount-other" class="label">Other</label>
                <span class="u-show-on-checked u-ml-1">
                    <input class="form-field u-text-center u-font-gta-extended" value="" type="text" name="other-amount" style="max-width:100px" placeholder="$10"/><br/>
                    <span class="u-font-size-sm u-color-gray">minimum is $10</span>
                </span>
            </li>
        </ul>
    </div>

    <div class="form-group u-mt-4">
        <div class="h4">Payment Info</div>
        <p class="u-mt-0">*required input</p>
        <ul>
            <li>
                <div>
                    <label for="first-name" class="label u-display-inline">First Name</label>
                    <input id="first-name" class="form-field" value="" type="text" name="first-name"/>
                </div>
                <div>
                    <label for="last-name" class="label u-display-inline">Last Name</label>
                    <input id="last-name" class="form-field" value="" type="text" name="last-name"/>
                </div>
            </li>
            <li>
                <div>
                    <label for="address-street" class="label u-display-inline">Address</label>
                    <input id="address-street" class="form-field" value="" type="text" name="address-street"/>
                </div>
                <div>
                    <label for="address-city" class="label u-display-inline">City</label>
                    <input id="address-city" class="form-field" value="" type="text" name="address-city"/>
                </div>
                <div>
                    <label for="address-state" class="label u-display-inline">State/Province</label>
                    <select id="address-state" class="form-field" name="address-state">
                        <option>Alabama</option>
                    </select>
                </div>
                <div>
                    <label for="address-zip" class="label u-display-inline">Zip/Postal Code</label>
                    <input id="address-zip" class="form-field" value="" type="text" name="address-zip"/>
                </div>
            </li>
            <li>
                <div>
                    <label for="phone" class="label u-display-inline">Phone</label>
                    <input id="phone" class="form-field" value="" type="tel" name="phone"/>
                </div>
                <div>
                    <label for="email" class="label u-display-inline">Email</label>
                    <input id="email" class="form-field" value="" type="email" name="email"/>
                </div>
            </li>
        </ul>
    </div>

    <div class="form-group u-mt-4">
        <div class="h4">Frequency (hidden)</div>
        <ul class="u-clearfix">
            <li class="u-float-left u-mr-1">
                <input id="frequency-one-time" class="form-field" value="one-time" type="radio" name="amount"/>
                <label for="frequency-one-time" class="label">One Time</label>
            </li>
            <li class="u-float-left u-mr-1">
                <input id="frequency-recurring" class="form-field" value="recurring" type="radio" name="amount"/>
                <label for="frequency-recurring" class="label">Recurring</label>
            </li>
        </ul>
    </div>

    <div class="form-group u-mt-4">
        <div class="h4">Credit Card</div>
        <ul>
            <li>
                <div>
                    <label class="label u-display-inline">Card Number</label>
                    <input class="form-field" value="" type="text"/>
                </div>
                <div>
                    <label class="label u-display-inline">Expiry</label>
                    <input class="form-field" value="" type="text"/>
                </div>
                <div>
                    <label class="label u-display-inline">CVV2</label>
                    <input class="form-field" value="" type="text"/>
                </div>
            </li>
        </ul>
    </div>

    <p class="u-mt-3">Your data is secure. <a href="#"><strong>Learn more.</strong></a></p>

    <p class="u-mt-3"><input type="submit" value="Process Donation" class="button"/></p>

    <p class="u-mt-5">For questions regarding your donation, please contact Lori Schlabach at <a href="mailto:lori@hesterstreet.org"><strong>lori@hesterstreet.org</strong></a> or 917-265-8591 x 204.</p>

    <p>HSC is a 501(c)(3) nonprofit organization, and all cash and in-kind contributions are tax deductible. Please consider giving today!</p>

</form>