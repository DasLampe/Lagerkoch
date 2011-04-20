<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2011 DasLampe <dasLampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
class helper
{
	public static function deleteDirName($path)
	{
		$path	= str_replace(DIR_MAIN, "", $path);
		return $path;
	}
	
	public static function isEventMethod($object, $event)
	{
		$event = explode("/", $event);
		
		if(is_array($event) && method_exists($object, $event[1]))
		{
			return true;
		}
		return false;
	}
	
	/**
	 * Encodiert String in JSON
	 * @param string $a
	 */
	public static function json_encode($a=false)
	{
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a))
		{
			if (is_float($a))
			{// Always use "." for floats.
				return floatval(str_replace(",", ".", strval($a)));
      		}

			if (is_string($a))
			{
				static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
				return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
			}
			else
			{
				return $a;
			}
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a))
		{
			if (key($a) !== $i)
			{
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList)
		{
			foreach ($a as $v) $result[] = self::json_encode($v);
			return '[' . join(',', $result) . ']';
		}
		else
		{
			foreach ($a as $k => $v) $result[] = self::json_encode($k).':'.self::json_encode($v);
			return '{' . join(',', $result) . '}';
		}
	}
	
	public static function in_multiarray($elem, $array)
    {
        // if the $array is an array or is an object
         if( is_array( $array ) || is_object( $array ) )
         {
             // if $elem is in $array object
             if( is_object( $array ) )
             {
                 $temp_array = get_object_vars( $array );
                 if( in_array( $elem, $temp_array ) )
                     return TRUE;
             }
            
             // if $elem is in $array return true
             if( is_array( $array ) && in_array( $elem, $array ) )
                 return TRUE;
                
            
             // if $elem isn't in $array, then check foreach element
             foreach( $array as $array_element )
             {
                 // if $array_element is an array or is an object call the in_multiarray function to this element
                 // if in_multiarray returns TRUE, than return is in array, else check next element
                 if( ( is_array( $array_element ) || is_object( $array_element ) ) && self::in_multiarray( $elem, $array_element ) )
                 {
                     return TRUE;
                     exit;
                 }
             }
         }
        
         // if isn't in array return FALSE
         return FALSE;
    }
    
    /**
     * Searches haystack for needle and 
     * returns an array of the key path if 
     * it is found in the (multidimensional) 
     * array, FALSE otherwise.
     *
     * @mixed array_searchRecursive ( mixed needle, 
     * array haystack [, bool strict[, array path]] )
     */
 
	public static function array_searchRecursive( $needle, $haystack, $strict=false, $path=array() )
	{
	    if( !is_array($haystack) ) {
	        return false;
	    }
	 
	    foreach( $haystack as $key => $val ) {
	        if( is_array($val) && $subPath = self::array_searchRecursive($needle, $val, $strict, $path) ) {
	            $path = array_merge($path, array($key), $subPath);
	            return $path;
	        } elseif( (!$strict && $val == $needle) || ($strict && $val === $needle) ) {
	            $path[] = $key;
	            return $path;
	        }
	    }
	    return false;
	}
	
	public static function placeholders( $array ){
		return "(?".str_repeat(",?",count($array)-1).")";
	}
}