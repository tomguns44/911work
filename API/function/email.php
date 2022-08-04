<?
if ( ! defined( 'MAIL_CLASS_DEFINED' ) ) 
{
	define('MAIL_CLASS_DEFINED', 1 );
	class email {
	
			//vrഫutf8rꬰbig5
			function  utf8_2_big5($utf8_str)  {
				$i=0;
				$len  =  strlen($utf8_str);
				$big5_str="";
				for  ($i=0;$i<$len;$i++)  {
						$sbit  =  ord(substr($utf8_str,$i,1));
						if  ($sbit  <  128)  {
								$big5_str.=substr($utf8_str,$i,1);
						}  else  if($sbit  >  191  &&  $sbit  <  224)  {
								$new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,2));
								$big5_str.=($new_word=="")?"":$new_word;
								$i++;
						}  else  if($sbit  >  223  &&  $sbit  <  240)  {
								$new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,3));
								$big5_str.=($new_word=="")?"":$new_word;
								$i+=2;
						}  else  if($sbit  >  239  &&  $sbit  <  248)  {
								$new_word=iconv("UTF-8","Big5",substr($utf8_str,$i,4));
								$big5_str.=($new_word=="")?"":$new_word;
								$i+=3;
						}
				}
				return  $big5_str;
			}
	
	
					// the constructor!
					function email ( $subject, $message, $senderName, $senderEmail, $toList, $encode=true, $ccList=0, $bccList=0, $replyTo=0)
			{
				if (!$encode)
				{
					$subject = $this->utf8_2_big5($subject);
					$message = $this->utf8_2_big5($message);
					$senderName = $this->utf8_2_big5($senderName);
					$senderEmail = $this->utf8_2_big5($senderEmail);
					$toList = $this->utf8_2_big5($toList);
					$ccList = $this->utf8_2_big5($ccList);
					$bccList = $this->utf8_2_big5($bccList);
					$replyTo = $this->utf8_2_big5($replyTo);
				}
	
				$this->sender = $senderName . " <$senderEmail>";
				$this->replyTo = $replyTo;
				$this->subject = $subject;
				$this->message = $message;
	
				// set the To: recipient(s)
				if ( is_array($toList) ) {
						$this->to = join( $toList, "," );
				} else {
						$this->to = $toList;
				}
	
				// set the Cc: recipient(s)
				if ( is_array($ccList) && sizeof($ccList) ) {
						$this->cc = join( $ccList, "," );
				} elseif ( $ccList ) {
						$this->cc = $ccList;
				}
	
				// set the Bcc: recipient(s)
				if ( is_array($bccList) && sizeof($bccList) ) {
						$this->bcc = join( $bccList, "," );
				} elseif ( $bccList ) {
						$this->bcc = $bccList;
				}
	
					}
	
					// send the message; this is actually just a wrapper for
					// PHP's mail() function; heck, it's PHP's mail function done right :-)
					// you could override this method to:
					// (a) use sendmail directly
					// (b) do SMTP with sockets
					function send ($code)
			{
									// create the headers needed by PHP's mail() function
	
									// sender
					/* To send HTML mail, you can set the Content-type header. */
					$this->headers = "MIME-Version: 1.0;\n";
					if ($code=="ISO-2022-JP")
						$this->headers .= "Content-Transfer-Encoding: 7bit\n";
					$this->headers .= "Content-type: text/html; charset=".$code.";\n";
					if ($code=="utf-8")
						$this->headers .= "Content-Transfer-Encoding: 8bit\n";
					//$this->headers .= "Content-Transfer-Encoding: base64;\n";
					$this->headers .= "Content-Transfer-Encoding: quoted-printable;\n";
	
	
									$this->headers .= "From: " . $this->sender . ";\n";
	
									// reply-to address
									if ( $this->replyTo ) {
													$this->headers .= "Reply-To: " . $this->replyTo . ";\n";
									}
	
									// Cc: recipient(s)
					if (!empty($this->cc))
					{
										if ( $this->cc ) {
													$this->headers .= "Cc: " . $this->cc . ";\n";
							}
									}
	
									// Bcc: recipient(s)
									if (!empty($this->bcc))
					{
						if ( $this->bcc ) {
													$this->headers .= "Bcc: " . $this->bcc . ";\n";
							}
									}
	
									return mail ( $this->to, $this->subject, $this->message, $this->headers );
					}
	}
	
	class d_email {
	
					// the constructor!
					function d_email ( $subject, $message, $senderName, $senderEmail, $toList, $encode=true, $ccList=0, $bccList=0, $replyTo=0)
			{
				$this->sender = $senderName . " <$senderEmail>";
				$this->replyTo = $replyTo;
				$this->subject = $subject;
				$this->message = $message;
	
				// set the To: recipient(s)
				if ( is_array($toList) ) {
						$this->to = join( $toList, "," );
				} else {
						$this->to = $toList;
				}
	
				// set the Cc: recipient(s)
				if ( is_array($ccList) && sizeof($ccList) ) {
						$this->cc = join( $ccList, "," );
				} elseif ( $ccList ) {
						$this->cc = $ccList;
				}
	
				// set the Bcc: recipient(s)
				if ( is_array($bccList) && sizeof($bccList) ) {
						$this->bcc = join( $bccList, "," );
				} elseif ( $bccList ) {
						$this->bcc = $bccList;
				}
	
					}
	
					// send the message; this is actually just a wrapper for
					// PHP's mail() function; heck, it's PHP's mail function done right :-)
					// you could override this method to:
					// (a) use sendmail directly
					// (b) do SMTP with sockets
					function send ($code="utf-8")
					{
									// create the headers needed by PHP's mail() function
	
									// sender
					/* To send HTML mail, you can set the Content-type header. */
					$this->headers = "MIME-Version: 1.0;\n";
					$this->headers .= "Content-type: text/html; charset=".$code.";\n"; //utf-8
					$this->headers .= "Content-Transfer-Encoding: quoted-printable;\n";
	
	
									$this->headers .= "From: " . $this->sender . ";\n";
	
									// reply-to address
									if ( $this->replyTo ) {
													$this->headers .= "Reply-To: " . $this->replyTo . ";\n";
									}
	
									// Cc: recipient(s)
					if (!empty($this->cc))
					{
										if ( $this->cc ) {
													$this->headers .= "Cc: " . $this->cc . ";\n";
							}
									}
	
									// Bcc: recipient(s)
									if (!empty($this->bcc))
					{
						if ( $this->bcc ) {
													$this->headers .= "Bcc: " . $this->bcc . ";\n";
							}
									}
	
									return mail ( $this->to, $this->subject, $this->message, $this->headers );
					}
	}
}
?>