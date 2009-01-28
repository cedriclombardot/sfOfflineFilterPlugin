<?php

class sfOfflineFilter extends sfFilter{
	public function execute ($filterChain)
  {
    // Code to execute before the action execution
    if(!$this->getContext()->getUser()->hasCredential(sfConfig::get('app_is_offline_credential','offline'))){
    	$url=sfConfig::get('app_is_offline_module',false);
    	
    	if($url!=false){
    		$url=array(
    		'module'=>sfConfig::get('app_is_offline_module','default'),
    		'action'=>sfConfig::get('app_is_offline_action','index'),
    		'params'=>sfConfig::get('app_is_offline_params',array()),
    		);
    		
	    	if( $this->getContext()->getModuleName()!=$url['module'] || $this->getContext()->getActionName()!=$url['action']){
	    		foreach($url['params'] as $k=>$v)
	    			$this->getContext()->getRequest()->setParameter($k,$v);
	    		
	    	   //	 $this->getContext()->getResponse()->setStatusCode(302);
	    		 $this->getContext()->getController()->forward($url['module'],$url['action']);
	    		exit;
	    	}
    	}
    }
    
    // Execute next filter in the chain
    $filterChain->execute();
 
    // Code to execute after the action execution, before the rendering
    
  }
	
}
?>