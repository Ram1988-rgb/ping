			<div class="card-body">
                  <div class="form-group">
                    <label for="name">Select your loan request</label>
                    <label for="name">You can loan up to HTG 80,000</label><span class="validate-star">*</span>
                    <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" data-validation="required">
					<label for="name">(Your Interest will be <span id="plan_rate">3%</span>)</label>
                 </div>
                
                 
                  <div class="form-group">
                      <label for="name">Payment Duration will be?</label>                
                  <div>
                  
                       <select name="payment_duration" id="payment_duration" class="form-control" data-validation="required" onchange="loan_validation()">
                            <option value="">Select</option>
                            <?php
                                if($payment_duration ){
                                    foreach ($payment_duration as $record){
                            ?>  
                                <option value="<?php echo $record->paymenttype_id;?>"><?php echo $record->label?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                   
                  </div>
                 </div>
                 <div class="form-group">
                    <label for="name">Your Loan Duration</label><span class="validate-star">*</span>                 
                    <div>
                        <select name="loan_duration" id="loan_duration" class="form-control" data-validation-param-name="payment_duration" data-validation-url="<?php echo base_url('/user/cash/check_plan_duration');?>" data-validation-req-params="" onchange="get_rate_according_plan(this.value,'<?php echo $plan_id?>')" data-validation="required,server">
                            <option value="">Select</option>
                            <?php
                                if($loan_duration ){
                                    foreach ($loan_duration as $record){
                            ?>  
                                <option value="<?php echo $record->paymentduration_id;?>"><?php echo $record->label?></option>
                            <?php 
                                    }
                                }
                            ?>
                        </select>
                      </div>
                  </div>
             </div>
              