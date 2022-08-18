<?php

namespace Carparkdashboard\Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class BaseServiceProvider extends ServiceProvider
{
	public function register()
	{
	}

	public function boot()
	{
		$this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
		$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'carparkdashboard-base');
		View::share('gitlog', $this->getInfoCommit());
	}

	public function getInfoCommit()
	{
		exec('git log', $output);
	   	$history = array();

	   	foreach($output as $line) {
	       	if(strpos($line, 'commit') === 0) {
	           	if(!empty($commit)) {
	               	array_push($history, $commit);   
	               	unset($commit);
	           	}
	           	$commit['hash']   = substr($line, strlen('commit'));
	        }
	        else if(strpos($line, 'Author') === 0) {
	           $commit['author'] = substr($line, strlen('Author:'));
	        }
	        else if(strpos($line, 'Date') === 0) {
	            $commit['date']   = substr($line, strlen('Date:'));
	        }
	        else {
	            if(isset($commit['message']))
	                 $commit['message'] .= $line;
	            else
	                 $commit['message'] = $line;
	        }
	    }
	    if(count($history) > 0)
	    {
	    	$str = $history[0];
	    	$result = "Commit: " . $str["hash"]. " | Commit date: " . $str["date"];
	    	//dd($result);
	    	return $result;
	    }
	    else
	    	return "";
	}
}

?>