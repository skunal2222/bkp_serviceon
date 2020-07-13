<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {
   
   function show_404($page = '',$log_error = false)
   {
      $code = '404';
      $text = 'Page not found';
     
      $server_protocol = (isset($_SERVER['SERVER_PROTOCOL'])) ? $_SERVER['SERVER_PROTOCOL'] : FALSE;
      $segments = explode('/',$_SERVER['REQUEST_URI']);
   
      if (substr(php_sapi_name(), 0, 3) == 'cgi')
      {
         header("Status: {$code} {$text}", TRUE);
      }
      elseif ($server_protocol == 'HTTP/1.1' OR $server_protocol == 'HTTP/1.0')
      {
         header($server_protocol." {$code} {$text}", TRUE, $code);
      }
      else
      {
         header("HTTP/1.1 {$code} {$text}", TRUE, $code);
      }
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'http://api.freightbazaar.in/error/e404.json');
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, 'originalURL=' . urlencode($_SERVER['REQUEST_URI']));
      curl_exec($ch);
      curl_close($ch);
   }
}