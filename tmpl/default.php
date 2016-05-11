<div>
    <div class="ui top attached tabular menu">
        <a class="active item" data-tab="first">Service Request</a>
        <a class="item" data-tab="second">Rant Or Rave</a>
    </div>

    <!-- SERVICE REQUEST -->
    <div class="ui bottom attached active tab segment" data-tab="first">

        <h2>Service Request</h2>

        <!-- Grid -->
        <div class="ui grid">
            <div class="sixteen wide column">
                <form class="ui service form" action="<?php print Juri::current();?>" method="post">
                    <p class="lead">Please complete the following details:</p>
                    <div class="required field">
                        <label>Full name:</label>
                        <input type="text" name="service[name]" placeholder="Your full name">
                    </div>
                    <div class="required field">
                        <label>Contact number:</label>
                        <input type="text" name="service[number]" class="numeric" placeholder="You contact number">
                    </div>
                    <div class="required field">
                        <label>Email:</label>
                        <input type="text" name="service[email]" placeholder="Your email address">
                    </div>
                    <div class="required field">
                        <label>Service required:</label>
                        <div id="type" class="ui fluid selection dropdown">
                            <input type="hidden" name="service[type]">
                            <div class="default text">Select...</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div class="item" data-value="accounts">Accounts</div>
                                <div class="item" data-value="consumables">Consumables</div>
                                <div class="item" data-value="gardening">Gardening</div>
                                <div class="item" data-value="cleaning_hygiene">Cleaning Hygiene</div>
                                <div class="item" data-value="pest_control">Pest Control</div>
                                <div class="item" data-value="other">Other</div>
                            </div>
                        </div>
                    </div>
                    
                    <p class="lead">Please tell us more about your service request so that we can direct your enquiry appropriatly:</p>
                    <div class="field">
                        <textarea name="service[message]" placeholder="Please provide additional information here.">Please contact me regarding my service request.</textarea>
                    </div>
                    <div class="ui right labeled service icon submit small button">Submit<i class="right arrow icon"></i></div>
                    <div class="ui error message">
                        <div class="header">We noticed some issues</div>
                    </div>
                    <input type="hidden" name="service[birthday]" value="" style="display:none;" />
                    <input type="hidden" name="service[token]" value="<?php print uniqid(); ?>" />
                </form>
            </div>
        </div>
    </div>

    <!-- RANT OR RAVE -->
    <div class="ui bottom attached tab segment" data-tab="second">

        <h2>Rant or Rave</h2>
        
        <!-- Grid -->
        <div class="ui grid">
            <div class="sixteen wide column">
                <form class="ui rantrave form" action="<?php print Juri::current();?>" method="post">
                    <p class="lead">Please complete the following details:</p>
                    <div class="required field">
                        <label>Full name:</label>
                        <input type="text" name="rantrave[name]" placeholder="Your full name">
                    </div>
                    <div class="required field">
                        <label>Contact number:</label>
                        <input type="email" name="rantrave[number]" class="numeric" placeholder="Your contact number">
                    </div>
                    <div class="required field">
                        <label>Email:</label>
                        <input type="email" name="rantrave[email]" placeholder="Your email address">
                    </div>

                    <div class="required field">
                        <label>I would like to:</label>
                        <div id="rant_or_rave" class="ui fluid selection dropdown">
                            <input type="hidden" name="rantrave[rant_or_rave]">
                            <div class="default text">Select...</div>
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div class="item" data-value="rant">Rant</div>
                                <div class="item" data-value="rave">Rave</div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="required field">
                        <label>Because:</label>
                        <textarea name="rantrave[message]" placeholder="Please provide additional information here."></textarea>
                    </div>
                    <div class="ui right labeled rantrave icon submit small button">Submit<i class="right arrow icon"></i></div>
                    <div class="ui error message">
                        <div class="header">We noticed some issues</div>
                    </div>
                    <input type="hidden" name="rantrave[birthday]" value="" style="display:none;" />
                    <input type="hidden" name="rantrave[token]" value="<?php print uniqid(); ?>" />
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    // Ready state 
    jQuery(document).ready(function() {

        // Tabs
        $('.tabular.menu .item').tab();
        
        // Dropdowns
        jQuery('#province').dropdown();
        jQuery('#type').dropdown();
        jQuery('#rant_or_rave').dropdown();

        // Service Validation
        $('.ui.service.form').form({
            fields: {
                fullName: {
                identifier  : 'service[name]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your full name'
                    }]
                },
                number: {
                identifier  : 'service[number]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your contact number'
                    },{
                        type : 'length[10]',
                        prompt : 'Your contact number is too short'
                    },{
                        type : 'maxLength[10]',
                        prompt : 'Your contact number is too long'
                    }]
                },
                email: {
                identifier  : 'service[email]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your email address'
                    },{
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    }]
                },
                province: {
                identifier  : 'service[type]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter the service required'
                    }]
                }
            }
        });

        // Rantrave Validation
        $('.ui.rantrave.form').form({
            fields: {
                fullName: {
                identifier  : 'rantrave[name]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your full name'
                    }]
                },
                number: {
                identifier  : 'rantrave[number]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your contact number'
                    },{
                        type : 'length[10]',
                        prompt : 'Your contact number is too short'
                    },{
                        type : 'maxLength[10]',
                        prompt : 'Your contact number is too long'
                    }]
                },
                email: {
                identifier  : 'rantrave[email]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Please enter your email address'
                    },{
                        type   : 'email',
                        prompt : 'Please enter a valid email address'
                    }]
                },
                province: {
                identifier  : 'rantrave[rant_or_rave]',
                rules: [{
                        type   : 'empty',
                        prompt : 'Are you ranting or raving?'
                    }]
                }
            }
        });

        // Submit the form on click
        jQuery(".ui.service.button").click(function(){
            jQuery(".ui.service.form").submit();
        });

        // Submit the form on click
        jQuery(".ui.rantrave.button").click(function(){
            jQuery(".ui.rantrave.form").submit();
        });
    });

</script>