<?php if($record->plan_id==4){
                $vip_date =1;
                $inCharge = 0;//$vip_charge->value;
                $todate = date('Y-m-d');
                if(date('Y-m-d')>=$record->end_date){
                  $inCharge =0;
                  $vip_date=0;
                }
            }
              ?>
            <input type="hidden" name="vip_charge" id="vip_charge" value="<?php echo $inCharge;?>">
            <input type="hidden" name="vip_date" id="vip_date" value="<?php echo $vip_date;?>">
            
<table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('Payment Due Date');?></th>
                    <th><?php echo $this->lang->line('Paid Amount');?>(<?php echo CURRENCY;?>)</th> 
                    <th><?php echo $this->lang->line('Earned Interest Amount');?>(<?php echo CURRENCY;?>)</th>
                    <th><?php echo $this->lang->line('Payment Status');?></th>
                    <th><?php echo $this->lang->line('Payment Date');?></th>
                    <!-- <th><?php echo $this->lang->line('Withdrawl in wallet');?></th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  if(isset($cash_payment) ){
                    foreach ($cash_payment as $crecord)
                    {
                        //print_r($crecord);//die;
                    ?>
                    <tr id="row-<?php echo $crecord->id?>">
                    <td><?php echo showDateFormate($crecord->cpdate)?></td>
                      <td><?php echo show_number($record->amount)?></td>
                      <td><?php echo show_number(($record->amount * $record->interest_rate)/100)?></td>
                      
                       
                      <td id="cash_payment-<?php echo $crecord->id;?>"><?php if(!$crecord->status ){?>Pending
                      <br/>
                      <?php if($record->status){?>
                        <button type="button" class="btn btn-primary" onclick="investmentPayment('<?php echo $crecord->id;?>')">Pay</button>
                      <?php }}else{echo "Done";}?></td>
                        
                      <td id="payment_date-<?php echo $crecord->id?>"><?php if($crecord->payment_date){echo showDateFormate($crecord->payment_date);}else{ echo "--";}?></td>
                      
                      <?php if(1==2){?>
                        <td id="wallet-<?php echo $record->id?>"><?php if($crecord->status){if($record->matured){?>Done<?php }else{?><button type="button" class="btn btn-block btn-primary btn-sm" onclick="move_to_wallet_vip('<?php echo $record->id?>')">Move to Wallet</button><?php }}else{echo '';}?></td>
                        <?php }?>
                    </tr>
                  <?php
                    }
                  }
                  ?>
                  
                  </tbody>
                 
                </table>