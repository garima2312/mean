<?php
 require 'config.php';
require 'DropboxClient.php';
	// you have to create an app at https://www.dropbox.com/developers/apps and enter details below:
  $dropbox = new DropboxClient(array(
    'app_key' => $drop_app_key,
    'app_secret' => $drop_app_secret,
    'app_full_access' => true,
  ),'en');
   #echo "<pre>";print_r($dropbox); die();
  handle_dropbox_auth($dropbox); // see below
  // // ================================================================================
  // // store_token, load_token, delete_token are SAMPLE functions! please replace with your own!
  function store_token($token, $name)
  {
  	file_put_contents("tokens/$name.token", serialize($token));
  }
  function load_token($name)
  {
  	if(!file_exists("tokens/$name.token")) return null;
  	return @unserialize(@file_get_contents("tokens/$name.token"));
  }

  function delete_token($name)
  {
  	@unlink("tokens/$name.token");
  }
  // // ================================================================================

	function handle_dropbox_auth($dropbox)
	{
		// first try to load existing access token
		$access_token = load_token("access");
		if(!empty($access_token)) {
			$dropbox->SetBearerToken($access_token);
		}
		elseif(!empty($_GET['auth_callback'])) // are we coming from dropbox's auth page?
		{
			 $return_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
			//die();
			$_GET['code'];
			// get & store access token, the request token is not needed anymore
			 $access_token = $dropbox->GetBearerToken($_GET['code'],$return_url);
			store_token($access_token, "access");
			delete_token($_GET['oauth_token']);
		}
echo "<pre>";print_r($dropbox); die();
		// checks if access token is required
		if(!$dropbox->IsAuthorized())
		{
			//$return_url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?auth_callback=1";
			$return_url = "https://www.p2h5.com/v2/auth.php?auth_callback=1";
		  $auth_url = $dropbox->BuildAuthorizeUrl($return_url);
		//die();
		die("Authentication required. <a href='$auth_url'>Click here.</a>");
		}
	}
?>
