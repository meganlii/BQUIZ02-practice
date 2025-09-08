<?php
session_start();

date_default_timezone_set('Asia/Taipei');

function dd($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function q($sql){
    $dsn='mysql:host=localhost;dbname=db02;charset=utf8';
    $pdo=new PDO($dsn,'root','');
    return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

function to($url){
    header('location:'.$url);
}

class DB{
    private $dsn='mysql:host=localhost;dbname=db02;charset=utf8';
    private $pdo;
    private $table;

    function __construct($table) {
        $this->table=$table;
        $this->pdo=new PDO($this->dsn,'root','');
    }

    // 第1個
    function all(...$arg){
        $sql="select * from $this->table ";
        
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." where ".join(" AND " , $tmp ) ;   
            }else{
                 $sql .= $arg[0];
            }
        }

        if (isset($arg[1])){
            $sql .= $arg[1];
        }
        
        return $this->pdo->query($sql)->fetchColumn();

    }

    // 第2個
    function count(...$arg){
        $sql="select count(*) from $this->table ";
        
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." where ".join(" AND " , $tmp ) ;   
            }else{
                 $sql .= $arg[0];
            }
        }

        if (isset($arg[1])){
            $sql .= $arg[1];
        }
        
        return $this->pdo->query($sql)->fetchColumn();

    }

    // 第3個
    // 統計瀏覽總人數
    function sum($col,...$arg){
        $sql="select sum($col) from $this->table ";
        
        if (isset($arg[0])) {
            if (is_array($arg[0])) {
                $tmp=$this->arraytosql($arg[0]);
                $sql=$sql." where ".join(" AND " , $tmp ) ;   
            }else{
                 $sql .= $arg[0];
            }
        }

        if (isset($arg[1])){
            $sql .= $arg[1];
        }
        
        return $this->pdo->query($sql)->fetchColumn();

    }

    // 第4個
    function find($id){
        $sql="select * from $this->table ";

        if (is_array($id)) {
            $tmp=$this->arraytosql($id);
            $sql=$sql." where ".join(" AND " , $tmp ); 

        }else{
                $sql .= " WHERE `id`='$id' ";
        }
        
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

    }

    // 第5個
    function save($array){
        // update
        if (isset($array['id'])) {
            $sql=" update $this->table set ";
            
            $tmp=$this->arraytosql($array);
            
            // 符號打錯.= 不是=
            $sql .= join(" , ", $tmp) . "WHERE `id`= '{$array['id']}'";
        
        // insert
        // 反斜線跟單引號 不要打錯
        }else{
            $cols = join("`,`", array_keys($array));

            $values = join("','", $array);

            $sql = "insert into $this->table (`$cols`) values('$values')";
        
        }
        
        return $this->pdo->exec($sql);
        

    }

    // 第6個
    function del($id){
        $sql="delete * from $this->table ";

        if (is_array($id)) {
            $tmp=$this->arraytosql($id);
            $sql=$sql." where ".join(" AND " , $tmp ); 

        }else{
                $sql .= " WHERE `id`='$id' ";
        }
        
        return $this->pdo->exec($sql);

    }


    // 第7個
    private function arraytosql($array){
        $tmp=[];
        foreach ($array as $key => $value) {
            $tmp[]="`$key`='$value'";
        }

        return $tmp;

    }

}

$User = new DB('users');
$Visit = new DB('visit');
$News = new DB('news');
$Que = new DB('que');
$Log = new DB('log');

// 回到首頁 加上 include db.php
// 少打胖箭頭
// 要關閉瀏覽器重新進入首頁 算一次
// 回到首頁 加上今日瀏覽 變數$Visit
if (!isset($_SESSION['visit'])) {
    $today = $Visit->find(['date' => date("Y-m-d")]);
    // $today = $Visit->find(['date' => date("Y-m-d")]);
    // $today=$Total->find(1);

    if (empty($today)) {
    //沒有今天資料
    $Visit->save(['date'=>date("Y-m-d"),'visit'=>1]);

    }else{
    $today['visit']++;
    $Visit->save($today);

    }

    // $t['total']++;
    // $Total->save($t);

    // 關閉此段，隨便點頁面連結都算次數
    $_SESSION['visit']=1;
}

