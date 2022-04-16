<?php if($this->session->flashdata('success') != ""){ ?>
                            <div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Success ! </strong><?php echo $this->session->flashdata('success')?>
										</div>
                            <?php }elseif($this->session->flashdata('errordata') != ""){?>
                            
                            <div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
											<strong>Oops ! </strong><?php echo $this->session->flashdata('errordata')?>
										</div>
                            
                            <?php }?>