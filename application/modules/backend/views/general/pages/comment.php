							<?php 
							if(!empty($comments)) { foreach($comments as $comment){?>
                                <div class="comment-body col-md-12">
                                    <div class="user-img"> <img src="<?php echo asset_url();?>images/user.png" alt="user" class="img-circle"></div>
                                    <div class="mail-contnet" id="<?php echo "comment_".$comment['ticketid']?>">
                                        <h5><?php //echo $comment['first_name'].' '.$comment['last_name']; ?></h5>
                                        	    <span class="mail-desc" id="msg_<?php echo $comment['ticketid']; ?>"><?php echo $comment['comment'];?> </span>
                                        	    <?php if(($_SESSION['adminsession']['id'] == $comment['created_by']) || ($_SESSION['adminsession'] == 1)){ ?><a href="javascript:editComment(<?php echo $comment['id'];?>);"><span class="label label-rouded label-info">Edit</span></a>
                                        	   	 <a href="javascript:deleteComment(<?php echo $comment['ticketid'];?>)"><span class="label label-rouded label-info">Delete</span></a>
                                        	   	 <?php }  ?>
                                        	      <span class="time pull-right"><?php echo $comment['created_datetime'];?></span>
                                      </div>
				                 </div>
				                                 <!-- <div class="row" id="<?php echo "comment_".$comment['id']?>"></div>  -->
                                <?php }} else {?>
                                <h3>No Comments yet.</h3>
                                
                                <?php } ?>