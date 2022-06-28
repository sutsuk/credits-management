var addto;

var default_element_height = 30;
var timetable_rows = 7;

var parent_category = new Array();
var category = new Array();
var necessary_credits = new Array();
var earned_credits = new Array();

var subject = new Array();
var credits = new Array();
var grade = new Array();
var term = new Array();
var day = new Array();
var time = new Array();
var category_number = new Array();

function $(id){
  return document.getElementById(id)
}

function CreditCalc(){
  var i;
  for(i = 0; i < category.length; i++){
    earned_credits[i] = 0;
  }
  for(i = 0; i < subject.length; i++){
    SumCredits(category_number[i], credits[i]);
  }
  return;
}

function SumCredits(target_category, add_credits){
  var diff;
  var earned = earned_credits[target_category];
  var calcto = parent_category[target_category];
  var necessary = necessary_credits[target_category];
  earned_credits[target_category] = earned + add_credits;
  earned = earned_credits[target_category];
  if(necessary > 0){
    $("c" + target_category).innerHTML = "　" + earned + " / " + necessary;
    diff = earned - necessary;
    if(diff < 0){
      $("c" + target_category).innerHTML = $("c" + target_category).innerHTML + "（あと " + diff + " 単位）";
    }else{
      $("c" + target_category).innerHTML = $("c" + target_category).innerHTML + "（完了）";
    }
  }
  if(calcto > -1){
    SumCredits(calcto, add_credits);
  }
  return;
}

function ChangeShowMode(){
  var i;
  var mode = $("showmode").value;
  var target = document.getElementsByClassName("addElement");
  if(mode == 0){
    for(i = 0; i < target.length; i++){
      target[i].style.display = "inline";
    }
  }else{
    for(i = 0; i < target.length; i++){
      target[i].style.display = "none";
    }
  }
  return;
}

function ShowAddDialog(target_number){
  addto = target_number;
  $("smode").style.display = "none";
  $("cmode").style.display = "none";
  $("addmode").selectedIndex = 0;
  $("newcategory").value = "";
  $("necessarycredits").value = "0";
  $("newsubject").value = "";
  $("credits").value = "";
  $("grade").value = "";
  $("term").value = "";
  $("day").value = "";
  $("time").value = "";
  $("adddialog").showModal();
  return;
}

function ChangeAddMode(){
  var add_mode = $("addmode").value;
  if(add_mode == "s"){
    $("smode").style.display = "";
    $("cmode").style.display = "none";
  }else if(add_mode == "c"){
    $("smode").style.display = "none";
    $("cmode").style.display = "";
  }else{
    $("smode").style.display = "none";
    $("cmode").style.display = "none";
  }
  return;
}

function EnterAddDialog(){
  var add_mode = $("addmode").value;
  var add_subject, add_credits, add_grade, add_term;
  var add_day, add_time, add_category, add_necessary_credits;
  if(add_mode == "s"){
    add_subject = $("newsubject").value;
    add_credits = $("credits").value;
    add_grade = $("grade").value;
    add_term = $("term").value;
    add_day = $("day").value;
    add_time = $("time").value;
    if(add_subject == ""){
      alert("教科を入力してください");
      return;
    }
    if(add_credits == ""){
      alert("単位数を入力してください");
      return;
    }
    if(add_grade == ""){
      alert("開講年を入力してください");
      return;
    }
    if(add_term == ""){
      alert("開講学期を入力してください");
      return;
    }
    if(add_day == ""){
      alert("開講曜日を入力してください");
      return;
    }
    if(add_time == ""){
      alert("開講時間を入力してください");
      return;
    }
    if(add_necessary_credits == ""){
      add_necessary_credits = 0;
    }
    addSubject(addto, add_subject, parseFloat(add_credits), parseInt(add_grade), parseInt(add_term), add_day, add_time, 0);
  }else if(add_mode == "c"){
    add_category = $("newcategory").value;
    add_necessary_credits = $("necessarycredits").value;
    if(add_category == ""){
      alert("カテゴリを入力してください");
      return;
    }
    if(add_necessary_credits == ""){
      alert("必要単位数を入力してください");
      return;
    }
    addCategory(addto, add_category, parseInt(add_necessary_credits), 0);
  }else{
    alert("追加する要素を選択してください");
  }
  $("adddialog").close();
  return;
}

function addCategory(add_parent, add_category, add_necessary_credits, mode){
  var tar;
  var len = category.length;
  if(add_parent == -1){
    tar = $("background");
  }else{
    tar = $("l" + add_parent);
  }
  if(mode == 0){
    parent_category.push(add_parent);
    category.push(add_category);
    necessary_credits.push(add_necessary_credits);
    earned_credits.push(0);
  }
  if(add_necessary_credits > 0){
    tar.insertAdjacentHTML('beforeend', '<div class="row border"><ul><li>　' + add_category + '　</li><li><div id="l' + len + '"></div><input type="button" class="addElement" value="要素を追加" onclick="ShowAddDialog(' + len + ')"></li><li id="c' + len + '">　' + add_necessary_credits + '　</li></ul></div>');
  }else{
    tar.insertAdjacentHTML('beforeend', '<div class="row border"><ul><li>　' + add_category + '　</li><li><div id="l' + len + '"></div><input type="button" class="addElement" value="要素を追加" onclick="ShowAddDialog(' + len + ')"></li></ul></div>');
  }
  return;
}

function addSubject(add_parent, add_subject, add_credits, add_grade, add_term, add_day, add_time, mode){
  var tar;
  var len = subject.length;
  if(add_parent == -1){
    tar = $("background");
  }else{
    tar = $("l" + add_parent);
  }
  if(mode == 0){
    subject.push(add_subject);
    credits.push(add_credits);
    grade.push(add_grade);
    term.push(add_term);
    day.push(add_day);
    time.push(add_time);
    category_number.push(add_parent);
  }
  tar.insertAdjacentHTML('beforeend', '<div class="row border"><ul><li>　' + add_subject + '　</li><li>　' + add_credits + '　</li></ul></div>');
  return;
}

function init(){
  var i, cnm, tar;
  for(i = 0; i < category.length; i++){
    addCategory(parent_category[i], category[i], necessary_credits[i], 1);
  }
  for(i = 0; i < subject.length; i++){
    addSubject(category_number[i], subject[i], credits[i], 0, 0, 0, 0, 1);
  }
  return;
}

