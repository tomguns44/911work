<?

/*
使用說明：
構造函數 cart 可以使用參數：
cart($cartname = 'myCart', $session_id = '', $savetype = 'session', $cookietime = 86400, $cookiepath = '/', $cookiedomain = '')
$cartname 是購物車的標識，可以指定，可以保證不重名，不會有相關衝突
$session_id 是 session_id，默認是使用 cookie 來傳輸，也可以自定義，如果存儲類型是 session 才起效
$savetype 存儲類型，有 session 和 cookie 方式
... 其他是 cookie 需要的參數

如果程序本身也需要使用 session，建議購物車使用 cookie 存儲




添加一個商品
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

// 商品已經存在 修改數據
if ($cart->data[$id]) {
$cart->data[$id]['count'] += $count;
$cart->data[$id]['money'] += $cart->data[$id]['price'] * $count;
// 添加商品
} else {
$cart->data[$id]['name'] = $name;
$cart->data[$id]['price'] = $price;
$cart->data[$id]['count'] = $count;
$cart->data[$id]['money'] = $price * $count;
}
// 保存購物車數據
$cart->save();
============================================================



編輯一個商品數量
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

// 商品已經存在 修改數據
if ($cart->data[$id]) {
$cart->data[$id]['count'] = $count;
$cart->data[$id]['money'] = $cart->data[$id]['price'] * $count;

// 保存購物車數據
$cart->save();
}
============================================================



刪除一個商品
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

// 刪除商品
unset($cart->data[$id]);

// 保存購物車數據
$cart->save();
============================================================



列表購物車
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

foreach ($cart->data AS $k => $v) {
echo '商品 ID: '.$k;
echo '商品名稱: '.$v['name'];
echo '商品單價: '.$v['price'];
echo '商品數量: '.$v['count'];
echo '商品總價: '.$v['money'];
}
============================================================



某字段總累計 --- 如所有商品總價格
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

// 累計 money 字段
$cart->sum('money')
============================================================



清空購物車
============================================================
// 引用類
require_once './cart.class.php';
// 建立類實例
$cart = new cart();

// 清除數據
unset($cart->data);

// 保存購物車數據
$cart->save();
============================================================
*/

class cart {

// 購物車標識
var $cartname = '';
// 存儲類型
var $savetype = '';
// 購物車中商品數據
var $data = array();
// Cookie 數據
var $cookietime = 0;
var $cookiepath = '/';
var $cookiedomain = '';

// 構造函數 (購物車標識, $session_id, 存儲類型(session或cookie), 默認是一天時間, $cookiepath, $cookiedomain)
function cart($cartname = 'myCart', $session_id = '', $savetype = 'session', $cookietime = 86400, $cookiepath = '/', $cookiedomain = '') {

	// 採用 session 存儲
	if ($savetype == 'session') {
		if (!$session_id && $_COOKIE[$cartname.'_session_id']) {
			session_id($_COOKIE[$cartname.'_session_id']);
		}elseif($session_id)
			session_id($session_id);
	
			session_start();
	
		if (!$session_id && !$_COOKIE[$cartname.'_session_id'])
			setcookie($cartname.'_session_id', session_id(), $cookietime + time(), $cookiepath, $cookiedomain);
	}
	
	$this->cartname = $cartname;
	$this->savetype = $savetype;
	$this->cookietime = $cookietime;
	$this->cookiepath = $cookiepath;
	$this->cookiedomain = $cookiedomain;
	$this->readdata();
}

// 讀取數據
function readdata() {
	if ($this->savetype == 'session') {
		if ($_SESSION[$this->cartname] && is_array($_SESSION[$this->cartname]))
			$this->data = $_SESSION[$this->cartname];
		else 
			$this->data = array();
	} elseif ($this->savetype == 'cookie') {
		if ($_COOKIE[$this->cartname])
			$this->data = unserialize($_COOKIE[$this->cartname]);
		else 
			$this->data = array();
	}

}

// 保存購物車數據
function save() {
	if ($this->savetype == 'session') {
		$_SESSION[$this->cartname] = $this->data;
	}elseif ($this->savetype == 'cookie') {
		if ($this->data)
			setcookie($this->cartname, serialize($this->data), $this->cookietime + time(), $this->cookiepath, $this->cookiedomain);
	}
}

// 返回商品某字段累加
function sum($field) {
	$sum = 0;
	if ($this->data)
	foreach ($this->data AS $v)
	if ($v[$field])
	$sum += $v[$field] + 0;
	
	return $sum;
}

}
?>