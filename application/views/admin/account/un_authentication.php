<style>
.control-label {
	float: left;
}
</style>
<div id="content">
  <div id="content-header"> </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span10">
          <div class="widget-box">
            <div class="widget-title">
              <h5>Authentication Failed</h5>
            </div>
            <div class="widget-content">
             <div class="errorwrapper error404">
        	<div class="errorcontent">
                <h2>Authentication Required</h2>
                <h3>We couldn't find that page. It appears that you are lost.</h3>
                
                <p>The page you are looking for is not found. This could be for several reasons</p>
                <ul>
                    <li>It never existed.</li>
                    <li>It got deleted for some reason.</li>
                    <li>You were looking for something that is not here.</li>
                    <li>You like this page.</li>
                </ul>
                <br>
                <button onclick="history.back()" class="stdbtn btn_black">Go Back to Previous Page</button> &nbsp; 
                <button class="stdbtn btn_orange" onclick="location.href='<?php echo base_url(); ?>dashboard'">Go Back to Dashboard</button>
            </div><!--errorcontent-->
        </div>
             
            </div>
          </div>
        </div>
        <?php include("sidebar.php"); ?>
      </div>
    </div>
  </div>
</div>