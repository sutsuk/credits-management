<?php
  if(empty($_SERVER['HTTPS'])){
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="robots" content="noindex,nofollow,noarchive">
    <meta charset="UTF-8">
    <title>単位管理サイト</title>
    <link rel="stylesheet" href="credits.css">
    <script type="text/javascript" src="credits.js"></script>
    <script type="text/javascript">
      function LoadData(){
<?php
  if(!empty($_POST['category'])){
    chdir('category');
    while(1){
      $code = "";
      for($i = 0; $i < 9; $i++){
        if($i == 3 || $i == 6){
          $code = $code . '-';
        }
        $code = $code . substr("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789", mt_rand(0, 35), 1);
      }
      $frw = fopen($code, "r");
      if($frw == false){
        fclose($frw);
        break;
      }else{
        fclose($frw);
      }
    }
    $frw = fopen($code, "w");
    $data = str_replace('<', '', $_POST['category']);
    $data = str_replace('>', '', $data);
    fwrite($frw, sprintf("%s", $data));
    fclose($frw);
    if(!empty($_POST['subject'])){
      chdir('../subject');
      $frw = fopen($code, "w");
      $data = str_replace('<', '', $_POST['subject']);
      $data = str_replace('>', '', $data);
      fwrite($frw, sprintf("%s", $data));
      fclose($frw);
    }
    echo('alert("生成したコード [' . $code . ']");');
    chdir('../');
  }
?>
<?php
  if(!empty($_GET['category'])){
    chdir('category');
    $fre = fopen($_GET['category'], "r");
    if($fre == false){
      echo('alert("File Open Error");');
    }else{
      while(1){
        if(feof($fre)){
          break;
        }
        $load = str_replace("\r", "", str_replace("\n", "", fgets($fre)));
        echo($load);
      }
    }
    fclose($fre);
    chdir('../');
  }
?>
<?php
  if(!empty($_GET['load'])){
    chdir('category');
    $fre = fopen($_GET['load'], "r");
    if($fre == false){
      echo('alert("File Open Error");');
    }else{
      while(1){
        if(feof($fre)){
          break;
        }
        $load = str_replace("\r", "", str_replace("\n", "", fgets($fre)));
        echo($load);
      }
    }
    fclose($fre);
    chdir('../subject');
    $fre = fopen($_GET['load'], "r");
    if($fre == true){
      while(1){
        if(feof($fre)){
          break;
        }
	$load = str_replace("\r", "", str_replace("\n", "", fgets($fre)));
	echo($load);
      }
    }
    chdir('../');
  }
?>
        return;
      }
    </script>
  </head>
  <body onload="init()">
    <div class="row">
      <ul>
        <li>
          <h1 class="heading">単位管理ページ</h1>
        </li>
        <li>
          <select id="showmode" onchange="ChangeShowMode()">
            <option value="0">編集モード</option>
            <option value="1">閲覧モード</option>
          </select>
	</li>
        <li>
          <input type="button" value="単位計算" onclick="CreditCalc()">
        </li>
      </ul>
    </div>
    <noscript>
      <h1 class="heading">JavaScriptが有効ではありません</p>
    </noscript>
    <div class="table">
      <div id="background">
      </div>
      <input type="button" class="addElement" value="要素を追加" onclick="ShowAddDialog(-1)">
    </div>
    <h1 class="heading">データ管理</h1>
    <div class="row">
      <ul>
        <li>
          <h1 class="heading">カテゴリ</h1>
        </li>
        <li>
          <input type="text" id="categorycode" placeholder="コード">
        </li>
        <li>
          <input type="button" value="読み込む" onclick="LoadCategory()">
        </li>
      </ul>
      <ul>
        <li>
          <h1 class="heading">すべて</h1>
        </li>
        <li>
          <input type="text" id="loadcode" placeholder="コード">
        </li>
        <li>
          <input type="button" value="読み込む" onclick="LoadAll()">
        </li>
      </ul>
      <ul>
        <li>
          <input type="button" value="カテゴリだけ保存する" onclick="SaveCategory()">
        </li>
        <li>
          <input type="button" value="すべて保存する" onclick="SaveAll()">
        </li>
      </ul>
    </div>
    <dialog close id="adddialog">
      <div class="row">
        <ul>
          <li>
            <h1 class="heading">追加する要素を選択</h1>
          </li>
          <li>
            <select id="addmode" onchange="ChangeAddMode()">
              <option value="">--選択してください--</option>
              <option value="s">科目を追加</option>
              <option value="c">カテゴリを追加</option>
            </select>
          </li>
        </ul>
      </div>
      <div id="smode" class="row" style="display:none;">
        <ul>
          <li>
            <h1 class="heading">教科名</h1>
          </li>
          <li>
            <input id="newsubject">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">単位数</h1>
          </li>
          <li>
            <input id="credits">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">年</h1>
          </li>
          <li>
            <input id="grade">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">学期</h1>
          </li>
          <li>
            <input id="term">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">曜日</h1>
          </li>
          <li>
            <input id="day">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">時間</h1>
          </li>
          <li>
            <input id="time">
          </li>
        </ul>
        <input type="button" onclick="EnterAddDialog()" value="追加">
      </div>
      <div id="cmode" style="display:none;" class="row">
        <ul>
          <li>
            <h1 class="heading">カテゴリ名</h1>
          </li>
          <li>
            <input id="newcategory">
          </li>
        </ul>
        <ul>
          <li>
            <h1 class="heading">必要単位数</h1>
          </li>
          <li>
            <input id="necessarycredits" value="0">
          </li>
        </ul>
        <input type="button" value="追加" onclick="EnterAddDialog()">
      </div>
    </dialog>
    <form id="dataform" method="POST" action="index.php" style="display:none;">
      <textarea id="category" name="category"></textarea>
      <textarea id="subject" name="subject"></textarea>
    </form>
  </body>
</html>

