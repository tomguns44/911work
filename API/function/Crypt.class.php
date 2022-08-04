<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * PHP Version 5
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * {@link http://gnu.org/licenses/gpl.txt}
 */

// {{{ Constants

/* Mode constants */
define('CRYPT_MODE_BINARY'     , 0);
define('CRYPT_MODE_BASE64'     , 1);
define('CRYPT_MODE_HEXADECIMAL', 2);

/* Hash algorithms constants */
define('CRYPT_HASH_MD5' , 'md5');
define('CRYPT_HASH_SHA1', 'sha1');

// }}}
// {{{ Crypt

/**
 * Crypt class
 *
 * The Crypt class provides an easy and secure way to encrypt, decrypt
 * and hash data. It implements a cryptography method based on private
 * keys. It traverses the data to be encrypted and applies the XOR
 * operation against the values of the characters of the encryption key.
 * The decryption employs the same operation, so you'll need the key
 * used on encryptation process to recover your original data.
 *
 * NOTE: All documentation available for this package is written below.
 * If you have any doubts or sugestions, feel free to contact me! :)
 *
 * @package     Crypt Class
 * @name        Crypt
 * @author      Arthur Furlan <arthur.furlan@gmail.com>
 * @copyright   2006 (c) - Arthur Furlan <arthur.furlan@gmail.com>
 * @license     GPL v3.0 {@link http://gnu.org/licenses/gpl.txt}
 * @version     2.1
 *
 * @todo        Improve class documentation
 */
class Crypt {

    // {{{ Attributes

    /**
     * Private key used in the creation process of the encrypted strings.
     * NOTE: This value should be as strange as possible :)
     *
     * @name        $key
     * @property    $Key
     * @access      private
     * @var         string
     */
    private $key  = __CLASS__;

    /**
     * Set the returning mode for the encrypted strings.
     *
     * @name        $mode
     * @property    $Mode
     * @access      private
     * @var         integer
     */
    private $mode = CRYPT_MODE_BASE64;

    /**
     * Set the hash algorithm for hash strings.
     *
     * @name        $hash
     * @property    $Hash
     * @access      private
     * @var         integer
     */
    private $hash = CRYPT_HASH_MD5;

    // }}}
    // {{{ __construct()

    /**
     * Constructor method.
     * Set the mode to be used in the new object.
     *
     * @name        __construct()
     * @access      public
     * @param       [$mode]     integer
     * @param       [$hash]     integer
     * @return      void
     */
    function __construct($mode = null, $hash = null) {
        $this->SetMode($mode);
        $this->SetHash($hash);
    }

    // }}}
    // {{{ __toString()

    /**
     * Overload to the object conversion to string.
     *
     * @name        __toString()
     * @access      public
     * @method      void
     * @return      string
     */
    function __toString() {
        return __CLASS__ . " object\n"
             . "(\n"
             . "    [Key]  => {$this->key}\n"
             . "    [Mode] => {$this->mode}\n"
             . "    [Hash] => {$this->hash}\n"
             . ")\n";
    }

    // }}}
    // {{{ __set()

    /**
     * Write methods for the class properties.
     *
     * @name        __set()
     * @access      public
     * @param       $property   string
     * @param       $value      mixed
     * @return      void
     */
    function __set($property, $value) {
        switch ($property) {
		    case 'Key' : return $this->SetKey($value);
            case 'Mode': return $this->SetMode($value);
            case 'Hash': return $this->SetHash($value);
        }
    }

    // }}}
    // {{{ __get()

    /**
     * Read methods for the class properties.
     *
     * @name        __get()
     * @access      public
     * @param       $property   string
     * @return      mixed
     */
    function __get($property) {
        switch ($property) {
            case 'Key' : return $this->key;
            case 'Mode': return $this->mode;
            case 'Hash': return $this->hash;
        }
    }

    // }}}
    // {{{ SetKey()

    /**
     * Set the private key used in the creation process of the
     * encrypted strings.
     *
     * @name        SetMode()
     * @access      protected
     * @param       $key        string
     * @return      void
     */
    protected function SetKey($key) {
        $this->key = (string) $key;
    }

    // }}}
    // {{{ SetMode()

    /**
     * Set the current returning mode of the class.
     *
     * @name        SetMode()
     * @access      protected
     * @param       $mode       integer
     * @return      void
     */
    protected function SetMode($mode) {
        Crypt::IsSupportedMode($mode) && $this->mode = (int)$mode;
    }

    // }}}
    // {{{ SetHash()

    /**
     * Set the current hash algorithm of the class.
     *
     * @name        SetHash()
     * @access      protected
     * @param       $hash       integer
     * @return      void
     */
    protected function SetHash($hash) {
        Crypt::IsSupportedHash($hash) && $this->hash = (int)$hash;
    }

    // }}}
    // {{{ SupportedModes()

    /**
     * Return the list of supported modes.
     *
     * @name        SupportedModes()
     * @access      public
     * @static
     * @param       void
     * @return      void
     */
    public static function SupportedModes() {
        return array(CRYPT_MODE_BINARY,
                     CRYPT_MODE_BASE64,
                     CRYPT_MODE_HEXADECIMAL);
    }

    // }}}
    // {{{ SupportedHashes()

    /**
     * Return the list of supported hashes.
     *
     * @name        SupportedHashes()
     * @access      public
     * @static
     * @param       void
     * @return      void
     */
    public static function SupportedHashes() {
        return array(CRYPT_HASH_MD5,
                     CRYPT_HASH_SHA1);
    }

    // }}}
    // {{{ IsSupportedMode()

    /**
     * Checks if $mode is a valid returning mode of the class.
     *
     * @name        IsSupportedMode()
     * @access      public
     * @static
     * @param       $mode       integer
     * @return      void
     */
    public static function IsSupportedMode($mode) { 
        return in_array($mode, Crypt::SupportedModes());
    }

    // }}}
    // {{{ IsSupportedHash()

    /**
     * Checks if $hash is a valid hash algorithm of the class.
     *
     * @name        IsSupportedHash()
     * @access      public
     * @static
     * @param       $mode       integer
     * @return      void
     */
    public static function IsSupportedHash($hash) { 
        return in_array($hash, Crypt::SupportedHashes());
    }

    // }}}
    // {{{ Encrypt()

    /**
     * Encrypt the data using the current returning mode.
     *
     * @name        Encrypt()
     * @access      public
     * @param       $data       mixed
     * @return      string
     */
   public function Encrypt($data) {
        $data = (string) $data;
        for ($i=0;$i<strlen($data);$i++)
            @$encrypt .= $data[$i] ^ $this->key[$i % strlen($this->key)];
        if ($this->mode == CRYPT_MODE_BINARY)
            return @$encrypt;
        @$encrypt = base64_encode(@$encrypt);
        if ($this->mode == CRYPT_MODE_BASE64)
            return @$encrypt;
        if ($this->mode == CRYPT_MODE_HEXADECIMAL)
            return $this->EncodeHexadecimal(@$encrypt);
    }

    // }}}
    // {{{ Decrypt()

    /**
     * Decrypt the data using the current returning mode.
     * NOTE: You must use the same mode of the creation process.
     *
     * @name        Decrypt()
     * @access      public
     * @param       $crypt      string
     * @return      string
     */
   public function Decrypt($crypt) {
        if ($this->mode == CRYPT_MODE_HEXADECIMAL)
            $crypt = $this->DecodeHexadecimal($crypt);
        if ($this->mode != CRYPT_MODE_BINARY)
            $crypt = (string)base64_decode($crypt);
        for ($i=0;$i<strlen($crypt);$i++)
            @$data .= $crypt[$i] ^ $this->key[$i % strlen($this->key)];
        return @$data;
    }

    // }}}
    // {{{ Hash()
    
    /**
     * Create a hash string using the algorithm defined in $hash.
     *
     * @name        Hash()
     * @access      public
     * @param       $data       mixed
     * @param       [$binary]   bool
     * @return      string
     */
    public function Hash($data, $binary = false) {
        $crypt = new Crypt(CRYPT_MODE_BINARY);
        $crypt->Key = $this->key;
        return hash($this->hash, $crypt->Encrypt($data), (bool)$binary);
    }

    // }}}
    // {{{ EncodeHexadecimal()

    /**
     * Encode the data using hexadecimal chars.
     *
     * @name        EncodeHexadecimal()
     * @access      protected
     * @param       $data       mixed
     * @return      string
     */
    protected function EncodeHexadecimal($data) {
        $data = (string) $data;
        for ($i=0;$i<strlen($data);$i++)
            @$hexcrypt .= dechex(ord($data[$i]));
        return @$hexcrypt;
    }

    // }}}
    // {{{ DecodeHexadecimal()

    /**
     * Decode hexadecimal strings.
     *
     * @name        DecodeHexadecimal()
     * @access      protected
     * @param       $data       string
     * @return      string
     */
    protected function DecodeHexadecimal($hexcrypt) {
        $hexcrypt = (string) $hexcrypt;
        for ($i=0;$i<strlen($hexcrypt);$i+=2)
            @$data .= chr(hexdec(substr($hexcrypt, $i, 2)));
        return @$data;
    }

    // }}}

}

// }}}


/*
 * @(#)CookieCrypt.php
 * 
 * Create Version:	1.0.0
 * Author:			Cobra Pang
 * Create Date:		2007-12-17
 * 
 * Copyright (c) 2006 UTStarcom(China) Corporation. All Right Reserved.
 * 必須 yum-y install libmcrypt php-mhash php-mcrypt
 */
class CookieCrypt {
	var $key;
	var $iv;
	
	function 	CookieCrypt($key) {
		$this->key = $key;	
	}
	
	function encrypt($input) {
		$size = mcrypt_get_block_size('des', 'ecb');
    	$input = $this->pkcs5_pad($input, $size);
   
		$key = $this->key;
    	$td = mcrypt_module_open('des', '', 'ecb', '');
	    $iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		$this->iv = $iv;
	    @mcrypt_generic_init($td, $key, $iv);
	    $data = mcrypt_generic($td, $input);
	    mcrypt_generic_deinit($td);
	    mcrypt_module_close($td);
	    $data = base64_encode($data);
	    return $data;
	}
	
	function decrypt($encrypted) {
		$encrypted = base64_decode($encrypted);
    	$key =$this->key;
    	$td = mcrypt_module_open('des','','ecb',''); //使用MCRYPT_DES算法,cbc模式      
    	$iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);   
    	$ks = mcrypt_enc_get_key_size($td);     
    	@mcrypt_generic_init($td, $key, $iv);       //初始處理      
 
    	$decrypted = mdecrypt_generic($td, $encrypted);       //解密      
 
    	mcrypt_generic_deinit($td);       //結束      
    	mcrypt_module_close($td);      
 
        $y=$this->pkcs5_unpad($decrypted);
        return $y;
	}
	
	function pkcs5_pad ($text, $blocksize) {
    	$pad = $blocksize - (strlen($text) % $blocksize);
    	return $text . str_repeat(chr($pad), $pad);
	}
 
	function pkcs5_unpad($text) {
		$pad = ord($text{strlen($text)-1});
		if ($pad > strlen($text)) 
			return false;
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) 
			return false;
    	return substr($text, 0, -1 * $pad);
	}
}

class Encrypt3des {
    var $key = '0E617C7A4C8FCDE90B199DA1D6D323CB04A7FB4AA80BBC7F';
    var $iv ='0102030405060708';

    function pad($text) {
        $text_add = strlen($text) % 8;

        for($i = $text_add; $i < 8; $i++) {
            $text .= chr(8 - $text_add);
        } 
        return $text;
    } 

    function unpad($text) {

        $pad = ord($text{strlen($text)-1});

        if ($pad > strlen($text)) {
            return false;
        } 
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
            return false;
        } 
        return substr($text, 0, -1 * $pad);
    } 

    function encrypt($key, $iv, $text) {

        $key_add = 24 - strlen($key);
        $key .= substr($key, 0, $key_add);

        $text = $this -> pad($text);
        $td = mcrypt_module_open (MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');

        mcrypt_generic_init ($td, $key, $iv);

        $encrypt_text = mcrypt_generic ($td, $text);

        mcrypt_generic_deinit($td);

        mcrypt_module_close($td);

        return $encrypt_text;
    } 

    function decrypt($key, $iv, $text) {
        $key_add = 24 - strlen($key);

        $key .= substr($key, 0, $key_add);

        $td = mcrypt_module_open (MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');

        mcrypt_generic_init ($td, $key, $iv);

        $text = mdecrypt_generic ($td, $text);

        mcrypt_generic_deinit($td);

        mcrypt_module_close($td);

        return $this -> unpad($text);
    } 

    function encode($text){
        $key = pack('H*',$this->key);
        $iv  = pack('H*',$this->iv);
		$data = $this->encrypt($key, $iv, $text);
		$data = base64_encode($data);
        return $data;

    }

    function decode($text){
        $key = pack('H*',$this->key);
        $iv  = pack('H*',$this->iv);
        return $this->decrypt($key, $iv, $text);
    }
}

class Crypt3Des
{    
    public $key    = "01234567890123456789012345678912";
    public $iv    = "12341234"; //like java: private static byte[] myIV = { 50, 51, 52, 53, 54, 55, 56, 57 };
    
    //加密
    public function encrypt($input)
    {
        $input = $this->padding( $input );
        $key = base64_decode($this->key);
        $td = mcrypt_module_open( MCRYPT_3DES, '', MCRYPT_MODE_CBC, '');
        //使用MCRYPT_3DES算法,cbc模式
        mcrypt_generic_init($td, $key, $this->iv);
        //初始处理
        $data = mcrypt_generic($td, $input);
        //加密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $data = $this->removeBR(base64_encode($data));
        return $data;
    }
    
    //解密
    public function decrypt($encrypted)
    {
        $encrypted = base64_decode($encrypted);
        $key = base64_decode($this->key);
        $td = mcrypt_module_open( MCRYPT_3DES,'',MCRYPT_MODE_CBC,'');
        //使用MCRYPT_3DES算法,cbc模式
        mcrypt_generic_init($td, $key, $this->iv);
        //初始处理
        $decrypted = mdecrypt_generic($td, $encrypted);
        //解密
        mcrypt_generic_deinit($td);
        //结束
        mcrypt_module_close($td);
        $decrypted = $this->removePadding($decrypted);
        return $decrypted;
    }
    
    //填充密码，填充至8的倍数
    public function padding( $str )
    {
        $len = 8 - strlen( $str ) % 8;
        for ( $i = 0; $i < $len; $i++ )
        {
            $str .= chr( 0 );
        }
        return $str ;
    }
    
    //删除填充符
    public function removePadding( $str )
    {
        $len = strlen( $str );
        $newstr = "";
        $str = str_split($str);
        for ($i = 0; $i < $len; $i++ )
        {
            if ($str[$i] != chr( 0 ))
            {
                $newstr .= $str[$i];
            }
        }
        return $newstr;
    }
    
    //删除回车和换行
    public function removeBR( $str ) 
    {
        $len = strlen( $str );
        $newstr = "";
        $str = str_split($str);
        for ($i = 0; $i < $len; $i++ )
        {
            if ($str[$i] != '\n' and $str[$i] != '\r')
            {
                $newstr .= $str[$i];
            }
        }
    
        return $newstr;
    }

}

class tgs_php_code
{
	//简单编码函数（与php_decode函数对应）
	function php_encode($str)
	{
		if ($str=='' && strlen($str)>128) return false;
		
		for($i=0; $i<strlen($str); $i++){
			$c = ord($str[$i]);
			if ($c>31 && $c<107) $c += 20;
			if ($c>106 && $c<127) $c -= 75;
			$word = chr($c);
			$s .= $word;
		}
	
		return $s;
	}
	
	
	//简单解码函数（与php_encode函数对应）
	function php_decode($str)
	{
		if ($str=='' && strlen($str)>128) return false;
		
		for($i=0; $i<strlen($str); $i++){
			$c = ord($word);
			if ($c>106 && $c<127) $c = $c-20;
			if ($c>31 && $c<107) $c = $c+75;
			$word = chr($c);
			$s .= $word;
		}
	
		return $s;
	}
	
	
	//简单加密函数（与php_decrypt函数对应）
	function php_encrypt($str)
	{
		$encrypt_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$decrypt_key = 'ikq0jp1g2fro3enz4mslcy5d6b7vx8tha9uw';
		
		if (strlen($str) == 0) return false;
		
		$enstr = "";
		
		for ($i=0; $i<strlen($str); $i++){
			for ($j=0; $j<strlen($encrypt_key); $j++){
				if ($str[$i] == $encrypt_key[$j]){
					$enstr .= $decrypt_key[$j];
					break;
				}
			}
		}
	
		return $enstr;
	}
	
	
	//简单解密函数（与php_encrypt函数对应）
	function php_decrypt($str)
	{
		$encrypt_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
		$decrypt_key = 'ikq0jp1g2fro3enz4mslcy5d6b7vx8tha9uw';
		
		if (strlen($str) == 0) return false;
		
		$enstr = "";
		
		for ($i=0; $i<strlen($str); $i++){
			for ($j=0; $j<strlen($decrypt_key); $j++){
				if ($str[$i] == $decrypt_key[$j]){
					$enstr .= $encrypt_key[$j];
					break;
				}
		}
	}
	
	return $enstr;
	}
}

?>
