   <!-- Modal -->

                        <div id="package_modal" class="modal fade" role="dialog">  
                          <div class="modal-dialog modal-md">  
                            <!-- Modal content--> 
                            <div class="modal-content know-more-div"> 
                              <div class="modal-header"> 
                                <button type="button" class="close" data-dismiss="modal">&times;</button> 
                              </div>

                              <div class="modal-body">

                                <div class="text-center">

                                  <h3>What is included in this package?</h3>

                                  <?php foreach ($packDetails as $item) { ?>

                                    <p> Name : <?php echo $item['package_name'];?></p>

                                    <p>* <?php echo $item['short_description'];?></p>

                                    <p>* <?php echo $item['long_description'];?></p>
                                    <p>Validity <?php echo $item['year'];?>  Year</p>
                                    <p>Service count <?php echo $item['service_used_validity'];?></p>

                                <?php   }  
                                
                                      $url=base_url().'book-service?id='.$packDetails[0]['id'];  
                                      ?> 
                                    <center>
                                    <table class="table" style="text-align: left; width: 70%">
                                    <thead>
                                        <tr>
                                    <th>Service Name</th>
                                    <th>Count</th>
                                    <tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($services as $value)   { ?>
                                        <tr>
                                        <td><?= $value['servicename']?></td>  
                                         <td><?= $value['service_used_validity']?></td>
                                        <tr> 
                                 <?php }?>
                                            </tbody>
                                    </table>
                                    </center>     
                                  <div class="inline-flex"> 
                                    <br/> 
                                    <button type="button" class="custom-btn1"  onclick="setPackage('<?=$item['id'];?>')">Select Now</button> 
                                  </div> 
                                </div> 
                              </div> 
                            </div> 
                          </div>

                        </div>

                      <!-- Modal -->  

    <script> 
    function setPackage(id){   
        if(id==""){
              swal('','Please select Package','error'); 
        }else{
            $.post(base_url+'setPackage',{package_id:id},function(data){
              if(data.status==1){
                window.location.href=base_url+'select-subcategory';
              }
            },'json');
          }

      }
    </script>