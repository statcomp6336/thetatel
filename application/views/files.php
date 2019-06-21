<style type="text/css">
    .folder {
   
    width: 150px;
    height: 105px;
    margin: 0 auto;
    margin: 5px;
    position: relative;
     /*position: relative;*/
     padding-top: 30px;
    text-align: center;
    background-color: orange;
    border-radius: 0 6px 6px 6px;
    box-shadow: 4px 4px 7px rgba(0, 0, 0, 0.59);
}

.folder:before {
    content: '';
    text-align:center;
    width: 50%;
    height: 12px;
    border-radius: 0 20px 0 0;
    background-color: orange;
    position: absolute;
    top: -12px;
    left: 0px;
}
.folder-text{
    /*font-style: italic;*/
    font-family: cursive;
    color: #25244d;
    font-size: xx-large;
}
.folder:hover{
   transform: scale(1.1); 
}

</style>


<div class="container">
    <div class="row">
        <!-- for design letter  -->
        <!-- <div class="col-xs-3 col-sm-3">
            <div class="folder">
                
            </div>
            <span class="folder-text text-center" style="text-align: center; padding: 30px">2015</span>
        </div> -->
       <!--  <div class="col-xs-3 col-sm-3">
            <div class="folder">
                <span class="folder-text center"><b>2016</b></span>
            </div>
        </div> -->
        
       <!--  <div class="col-xs-3 col-sm-3">
            <div class="folder">
                <span class="folder-text center">2018</span>
            </div>
        </div> -->
        <!-- end there is not selected designs -->
        <!-- start the files explore -->
        <?php 
        $start_year= 2015;
        $current_year= date("Y");

        for ($i=$start_year; $i < $current_year ; $i++) {  ?>      

        <div class="col-xs-3 col-sm-3">
            <div class="folder">
                <span class="folder-text center"><i> <?php echo $i;?></i></span>
            </div>
        </div>
        <?php } ?>








        </div>
    </div>
    

</div>

</div>