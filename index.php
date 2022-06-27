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
  </head>
  <body onload="init()">
    <h1 class="heading">単位管理ページ</h1>
    <noscript>
      <h1 class="heading">JavaScriptが有効ではありません</p>
    </noscript>
    <div class="table">
      <div id="background">
      </div>
      <input type="button" class="addElement" value="要素を追加" onclick="ShowAddDialog(-1)">
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
  </body>
</html>

