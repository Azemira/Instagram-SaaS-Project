<?php
namespace Plugins\Boost;

// Disable direct access
if (!defined('APP_VERSION')) 
    die("Yo, what's up?");

/**
 * Cron Controller
 */
class CronController extends \Controller
{
    /**
     * idname of the plugin for internal use
     */
    const IDNAME = 'boost';
  
  
    public $boostBuildVersion = '10141'; //debug


    /**
     * Process
     */
    public function process()
    {
      //\Event::trigger("crongrow.tst"); return;
      
      if (\Input::get('build')) {
        echo $this->boostBuildVersion . ' - ' . $GLOBALS['_PLUGINS_']['boost']['config']['version'];
        exit;
      }
      
      $Route  = $this->getVariable("Route");
      $param  = isset($Route->params->id) ? $Route->params->id : null;
      $type   = is_null($param) ? "dedicated" : "multiple";
      \Event::trigger("cron.boost", $type, $param);
    }
}
