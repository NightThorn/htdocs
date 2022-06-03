<?php
if( !function_exists("the_nonce") ){
	function the_nonce(){
	    $nonce = base64_encode(uniqid());
	    $nonce = preg_replace('~[\W]~','',$nonce);
	    return $nonce;
	}
}

if( !function_exists("calculateSignature") ){
	function calculateSignature( $method, $url, $parameters, $accessToken = '' )
	{   
	    foreach( $parameters as $key => $val )
	    {
	        $foo = urlencode( $key );
	        unset( $parameters[$key] );

	        $parameters[$foo] = urlencode( $val );      
	    }

	    ksort( $parameters );   

	    $signBase = '';
	    $j = count( $parameters );
	    foreach( $parameters as $key => $val )
	    {
	        $signBase .= "{$key}={$val}";

	        if( $j-- > 1 )
	        {
	            $signBase .= '&';
	        }
	    }

	    $signBase = strtoupper( $method ) . '&' . urlencode( $url ) . '&' . urlencode( $signBase );

	    $signKey = urlencode( get_option('twitter_consumer_secret', '') ) . '&' . urlencode( $accessToken );

	    $signature = hash_hmac( 'SHA1', $signBase, $signKey);

	    return $signature;
	}
}

if( !function_exists("getAuthorizationHeader") ){
	function getAuthorizationHeader( $parameters )
	{
	    $authorization = 'OAuth ';
	    $j = count( $parameters );
	    foreach( $parameters as $key => $val )
	    {
	        $authorization .= $key . '="' . urlencode( $val ) . '"';

	        if( $j-- > 1 )
	        {
	            $authorization .= ', ';
	        }   
	    }

	    return $authorization;
	}
}