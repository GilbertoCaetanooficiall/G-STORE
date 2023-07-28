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
                     Resultados
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
            <h1>Pesquisa</h1>
             <p>
             <?php
             box();?>
                </p>
           </div> 
    
            <div class="row">
            <?php   showresults();?>
            
        
                        
                    
      
          </div>
          
          <center>
            <ul class="pagination">
            <?php  showpaginator() ;?>
            </ul>
          </center>
          
          
          
      </div>
    </div>
  </div>

<?php include ("includes/footer.php");?>
        <script src="js/jquery-331.min.js"></script>
        <script src="js/bootstrap-337.min.js"></script>
</body>
</html>