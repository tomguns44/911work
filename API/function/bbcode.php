<?php
function bbcode_convert($string){
    // 移除 HTML tags
    $string = htmlentities($string, ENT_QUOTES);
 
    $bbcode_search = array(
                '/\[b\](.*?)\[\/b\]/is',
                '/\[i\](.*?)\[\/i\]/is',
                '/\[u\](.*?)\[\/u\]/is',
                '/\[url\=(.*?)\](.*?)\[\/url\]/is',
                '/\[url\](.*?)\[\/url\]/is',
                '/\[img\](.*?)\[\/img\]/is',
				'/::(.*?):/is'
                );
 
    $bbcode_replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<a href="$1">$2</a>',
                '<a href="$1">$1</a>',
                '<img src="$1" />',
				'<img src="images/Smilies/$1" />'
                );
 
    return preg_replace($bbcode_search, $bbcode_replace, $string);
}

/** 
 * 處理論壇的BBCode代碼，返回經過替換後的HTML代碼。 
 * Authors: YZHForce <yzhforce@hotmail.com> 
 * 
 * @param string $string 輸入字符串 
 * @return srting 返回字符串 
 */  
function BBCode($string)  
{  
    /* [url]URL[/ url] */  
    $string = preg_replace("/\[url](.*?)\[\/url]/i",'<A href="$1">$1</A>',$string);  
    /* [url=URL]URL描述[/ url] */  
    $string = preg_replace("/\[url=(.*?)](.*?)\[\/url]/i",'<A href="$1">$2</A>',$string);  
    /* [email]yzhforce@123.com[/ email] */  
    $string = preg_replace("/\[email](.*?)\[\/email]/i",'<A href="mailto:$1">$1</A>',$string);  
    /* [email=yzhforce@123.com]email描述[/ email] */  
    $string = preg_replace("/\[email=(.*?)](.*?)\[\/email]/i",'<A href="mailto:$1">$2</A>',$string);  
    /* [img]貼圖的URL[/ img] */  
    $string = preg_replace("/\[img](.*?)\[\/img]/i",'<IMG src="$1" border=0>',$string);  
    /* [b]粗體字[/ b]  */  
    $string = preg_replace("/\[b](.*?)\[\/b]/is",'<STRONG>$1</STRONG>',$string);  
    /* [i]斜體字[/ i] */  
    $string = preg_replace("/\[i](.*?)\[\/i]/is",'<EM>$1</EM>',$string);  
    /* [u]下劃線[/ u] */  
    $string = preg_replace("/\[u](.*?)\[\/u]/is",'<U>$1</U>',$string);  
    /* [color=red]改變顏色[/ color] */  
    $string = preg_replace("/\[color=(.*?)](.*?)\[\/color]/is",'<FONT color="$1">$2</FONT>',$string);  
    /* [size=4]改變字體大小[/ size] */  
    $string = preg_replace("/\[size=(.*?)](.*?)\[\/size]/is",'<FONT size="$1">$2</FONT>',$string);  
    /* [font=黑體]改變字體[/ font] */  
    $string = preg_replace("/\[font=(.*?)](.*?)\[\/font]/is",'<FONT face="$1">$2</FONT>',$string);  
    /* [align=center(可以是向左left，向右right)]位於中間[/ align] */  
    $string = preg_replace("/\[align=(.*?)](.*?)\[\/align]/is",'<DIV align="$1">$2</DIV>',$string);  
    /* [code]echo"代碼內容";[/ code] */  
    $string = preg_replace("/\[code](.*?)\[\/code]/is",'<TEXTAREA style="WIDTH: 100%" name=textfield rows=10>$1</TEXTAREA>',$string);  
    /* [quote]被引用的內容[/ quote] */  
    $string = preg_replace("/\[quote](.*?)\[\/quote]/is",'<TABLE cellSpacing=0 cellPadding=0 width="94%" align=center><TBODY><TR><TD><TABLE width="100%" border=0 cellPadding=5 cellSpacing=0 style="border: 1px solid #000000;"><TBODY><TR><TD>$1</TD></TR></TBODY></TABLE></TD></TR></TBODY></TABLE>',$string);  
    /* [fly]飛行文字特效[/ fly]  */  
    $string = preg_replace("/\[fly](.*?)\[\/fly]/is",'<MARQUEE scrollAmount=3 behavior=alternate width="90%">$1</MARQUEE>',$string);      
    /* [move]滾動文字特效[/ move] */  
    $string = preg_replace("/\[move](.*?)\[\/move]/is",'<MARQUEE scrollAmount=3 width="90%">$1</MARQUEE>',$string);  
	/* [i]斜體字[/ i] */  
    $string = preg_replace("/::(.*?):/is",'<img src="images/Smilies/face$1.gif" />',$string);  
  
    return $string;  
}  
?>