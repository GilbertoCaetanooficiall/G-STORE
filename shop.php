<?php 
$active='Shop';
include('includes/header.php'); ?>


   <div id="content">
     <div class="container">
        <div class="col-md-12">

            <ul class="breadcrumb">
                <li><a href="index.php">HOME</a>
                </li>
                <li>
                     Shop
                 </li>
            </ul>

        </div>
        <div class="col-md-3">
            <?php
             include ("includes/sidebar.php");
             ?>
        </div>
        <div class="col-md-9">
       
         <div class='box'>
            <h1>Shop</h1>
             <p>
                 Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                 Laborum iure rem officiis architecto! Delectus optio inventore sint nulla asperiores dolor cumque, minus exercitationem necessitatibus recusandae saepe dolore accusamus ut reprehenderit!
             </p>
           </div> 
    
            <div class="row">
            <?php   getptoducts();?>
            
        
                        
                    
      
          </div>
          
          <center>
            <ul class="pagination">
            <?php  pagination() ;?>
            </ul>
          </center>
          
          
          
      </div>
    </div>
  </div>

<?php include ("includes/footer.php");?>
<script src="js/jquery-331.min.js"></script>
    <script src="js/bootstrap-337.min.js"></script>
    <script> $(document).ready(function(){
        $('.nav-toggle').click(function(){
            $('.panel-collapse,.collapse-data').slideToggle(700,function(){

                if ($(this).css('display')=='none') {
                    $(".hide-show").html('Show');
                }else{
                    $(".hide-show").html('Hide');
                }

            });
        });
        
    //////////////////////////////////////

    $(function(){
        $.fn.extend({
            FilterTable : function(){
                return this.each(function(){
                    $(this).on('keyup', function() {
                     var $this = $(this),
                     search =$this.val().toLowerCase(),
                     target =$this.attr("data-filters"),
                     handle=$(target),
                     rows = handle.find('li a');
                     
                     if (search =='') {
                        rows.show();
                     } else {
                        rows.each(function () {
                            var $this =$(this);
                            $this.text().toLowerCase().indexOf(search)=== -1? $this.hide(): $this.show();
                        });
                     }
                    });
                    
                });
            }
        });

        $('[data-action="filter"][id="dev-table-filter"]').filterTable();

    });
});

    </script>
</body>
</html>