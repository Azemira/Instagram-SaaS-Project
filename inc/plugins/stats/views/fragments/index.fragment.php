<?php 
    // Disable direct access
    if (!defined('APP_VERSION')) die("Yo, what's up?"); 
?>
        <div class="skeleton" id="statistics">
            <div class="container-1200">
                <div class="row clearfix">                    
                    <div class="clearfix">
                        <?php 
                          if ($Accounts->getData()) {
                            require_once(PLUGINS_PATH."/".$this->getVariable("idname")."/views/fragments/dashboard.fragment.php");
                          } else {
                            require_once(PLUGINS_PATH."/".$this->getVariable("idname")."/views/fragments/nodata.fragment.php");
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>