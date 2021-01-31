<?

class _cookie
{
function __construct()
{
if($_COOKIE)
 foreach($_COOKIE as $key => $value){
        $this->{$key} = $value;
}}
function yap($d,$s)
{
setcookie($d,$s,time()+360000);
}
}

class _get
{
function __construct()
{
if($_GET)
 foreach($_GET as $key => $value){
        $this->{$key} = $value;
}
}

}


class _post
{
function __construct()
{
if($_POST)
 foreach($_POST as $key => $value){
        $this->{$key} = $value;
}
}}


class _session
{
function __construct()
{
if($_SESSION)
 foreach($_SESSION as $key => $value){
        $this->{$key} = $value;
}}
function yap($d,$s)
{$_SESSION[$d]=$s;}
}


class _server
{
function __construct()
{
if($_SERVER)
 foreach($_SERVER as $key => $value){
        $this->{$key} = $value;
}
}}


$server= new _server();
$session= new _session();
$cookie= new _cookie();
$get= new _get();
$post= new _post();

?>