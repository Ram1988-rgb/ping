<ul class="list-unstyled">
            <!--1-->
            <?php foreach($details as $line){?>
            
                <li class="card mb-2">
                    
                    <div class="card-body">
                        <div class="row">
                         <div class="col-lg-10">
                            <b><?php echo showDateFormate($line['date']);?></b>
                         </div>
                        </div>
                        <?php 
                        foreach($line['detail'] as $inline){
                        ?>
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="font-weight-bold"><?php echo $inline['title']?></div>
                                <div><?php echo $inline['message']?></div>
                            </div>
                            <div class="col-lg-2 text-right">
                                <strong class="text-success">
                                
                                <?php echo $inline['sign'].CURRENCY.' '.$inline['amount']?></strong>
                            </div>
                        </div>
                        <div class="dropdown-divider my-3"></div>
                        <?php }?>
                       
                    </div>
                </li>
            <?php }?>
            <!--2-->
           
        </ul>
		