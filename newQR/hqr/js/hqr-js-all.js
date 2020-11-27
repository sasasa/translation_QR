//============================================================
// このファイル hqr-js-all.js は type="module" で呼び出される
//============================================================




//============================================================
// 汎用の関数と定数

//------------------------------------------------------------
// 改行コードの扱いが面倒なので定数で定義しておく
const crlf =`
`;

//------------------------------------------------------------
// ラジオボタンの現在値を返す関数（要素<form>がない場合）
function getRadioValueByName(name) {
  var elements = document.getElementsByName(name) ;
  for ( var a="", i=elements.length; i--; ) {
    if ( elements[i].checked ) {
      var a = elements[i].value ;
      break ;
    }
  }
  return a;
}

//------------------------------------------------------------
// セッションストレージに保存したJSON形式のデータを取り出してオブジェクトに変換する関数
function getJsonFromSessionStorage (strage) {
  let json = sessionStorage.getItem(strage);
  let object = {};
  console.log('hqr-js-common.js getJsonFromSessionStorage');
  console.log(json);
  if (json !== null) {
    object = JSON.parse(json);
  }
  return object;
}





//============================================================
// ほんやくQR関数群
// アイテムの数を増減させる
// 結果は常にセッションストレージに反映させる


//------------------------------------------------------------
// アイテムのカウントを加算する関数
//（存在しなければアイテムを追加したのち加算）
function increaseItem (key) {  
  console.log('key : ' + key);
  if (!items.hasOwnProperty(key)) {
    items[key] = { count: 0 };
  }
  if (items[key].count < itemDefs[key].max) {
    items[key].count++;
  }
  sessionStorage.setItem(strageOrderList, JSON.stringify(items));
}

//------------------------------------------------------------
// アイテムのカウントを減算する関数
function decreaseItem (key) {
  if (items[key]) {
    if (items[key].count > 1) 
      items[key].count--;
  }
  sessionStorage.setItem(strageOrderList, JSON.stringify(items));
}

//------------------------------------------------------------
// アイテムを削除する関数
function removeItem (key) {
  delete items[key];
  sessionStorage.setItem(strageOrderList, JSON.stringify(items));
}

//------------------------------------------------------------
// 現在の合計金額を算出する
function calcTotal()
{
  let amo = 0;
  Object.keys(items).forEach(function (key) {
    amo += items[key].count * itemDefs[key].price;
  });
  return amo;
}

//------------------------------------------------------------
// アイテムの個数を返す
function sumItemCount () {
  let ic = 0;
  Object.keys(items).forEach(function (key) {
    ic += items[key].count;
  })
  return ic;
}

//------------------------------------------------------------
// 登録済みアイテム数の表示を更新する 
function updateItemCount () {
  // 右下の茶碗アイコンの中心部
  document.getElementById('hqr-view-items-count').textContent = sumItemCount();
}




//============================================================
// お客様向け注文リストを構築し表示する


//------------------------------------------------------------
// お客様向け注文リストを構築して表示する関数
// hqr-view-items-button から onClick で呼ばれる
function hqrListForCustomer ()
{
  console.log('function: hqrListForCustomer @ hqr-js-restaurant-list-for-customers.js');

  // 全体の大枠
  const divContainer = document.createElement('div');
  // フッター
  const divFooter = document.createElement('div');
  // 合計金額の表示
  const spanTotal = document.createElement('span');
  // 店舗向けリストを表示するボタン
  const buttonForShop = document.createElement('button');
  // 閉じるボタン
  const buttonOrderClose = document.createElement('button');

  // 要素の構造
  document.body.appendChild(divContainer);
  divContainer.appendChild(hqrListForCustomerItemsDom());
  divContainer.appendChild(divFooter);
  divFooter.appendChild(buttonForShop);
  divFooter.appendChild(buttonOrderClose);
  divFooter.appendChild(spanTotal);

  // コンテナ
  divContainer.id = 'hqr-list-for-customer-container';

  // 合計金額 total amount の表示
  const totalHTML = '<span>Total </span> <span id="hqr-list-for-customer-total">' + calcTotal() + '</span> <span>yen</span>';
  spanTotal.id = 'hqr-list-for-customer-total-container';
  spanTotal.innerHTML = totalHTML;

  // 閉じるボタン
  buttonOrderClose.classList.add('hqr-list-for-customer-button');
  buttonOrderClose.textContent = 'Close';
  // buttonOrderClose.addEventListener('click', closeOrderContainer, false);
  buttonOrderClose.addEventListener('click', () => {
    document.getElementById('hqr-list-for-customer-container').remove();
    updateItemCount();
  }, false);
  buttonOrderClose.addEventListener('click', updateItemCount, false);

  // 店舗向けリストを表示するボタン
  buttonForShop.classList.add('hqr-list-for-customer-button');
  buttonForShop.textContent = 'Order';
  buttonForShop.addEventListener('click', hqrListForShop, false);

  // 合計金額と閉じるボタンを表示する部分
  divFooter.id = 'hqr-list-for-customer-footer';
}


//------------------------------------------------------------
// お客様向け注文リストのDOMを作る関数
function hqrListForCustomerItemsDom ()
{

  // 外箱
  const orderItems = document.createElement('div');
  orderItems.id = 'hqr-list-for-customer-items';

  // 内箱
  Object.keys(items).forEach(function (key) {
    
    // 注文リストの外箱
    const orderItem = document.createElement('div');
    orderItem.id = 'orderItem-' + key;
    orderItem.classList.add('hqr-list-for-customer-item');
    
    // 内箱の左右
    const orderItemLeft = document.createElement('div');
    orderItemLeft.classList.add('hqr-list-for-customer-item-left');
    const orderItemRight = document.createElement('div');
    orderItemRight.classList.add('hqr-list-for-customer-item-Right');

    // 商品画像の表示
    const orderImg = document.createElement('img');
    orderImg.classList.add('hqr-list-for-customer-item-img');
    orderImg.src = itemDefs[key].img;

    // 商品名の表示
    const orderName = document.createElement('div');
    orderName.innerHTML = itemDefs[key].name[lang];
    console.log('itemDefs[key].name[lang] = "' + itemDefs[key].name[lang] + '"');
    console.log('orderName.innerHTML = "' + orderName.innerHTML + '"');

    // 価格の表示
    const orderPriceBefore = document.createElement('span');
    const orderPrice = document.createElement('span');
    const orderPriceAfter = document.createElement('span');
    orderPrice.classList.add('hqr-list-for-customer-item-price');
    orderPriceBefore.textContent = '一個 ';
    orderPrice.textContent = itemDefs[key].price;
    orderPriceAfter.textContent = ' 円';
    const orderPriceContainer = document.createElement('div');
    orderPriceContainer.classList.add('hqr-list-for-customer-item-price-container');
    orderPriceContainer.appendChild(orderPriceBefore);
    orderPriceContainer.appendChild(orderPrice);
    orderPriceContainer.appendChild(orderPriceAfter);

    // 個数の表示
    const orderCount = document.createElement('div');
    orderCount.id = 'orderCount-' + key;
    orderCount.classList.add('hqr-list-for-customer-item-count');
    orderCount.textContent = items[key].count;
    
    // 注文数を増やすボタン
    const orderIncrease = document.createElement('button');
    orderIncrease.value = key;
    orderIncrease.textContent = '+';
    orderIncrease.classList.add('bottun');
    orderIncrease.classList.add('increase');
    orderIncrease.addEventListener('click', function(event){
      let key = event.target.value;
      increaseItem(key);
      document.getElementById('orderCount-' + key).textContent = items[key].count;
      // 現在の合計金額を算出する
      document.getElementById('hqr-list-for-customer-total').textContent = calcTotal();
    }, false);

    // 注文数を減らすボタン
    const orderDecrease = document.createElement('button');
    orderDecrease.value = key;
    orderDecrease.textContent = '-';
    orderDecrease.classList.add('bottun');
    orderDecrease.classList.add('decrease');
    orderDecrease.addEventListener('click', function(event){
      let key = event.target.value;
      decreaseItem(key);
      document.getElementById('orderCount-' + key).textContent = items[key].count;
      // 現在の合計金額を算出する
      document.getElementById('hqr-list-for-customer-total').textContent = calcTotal();
    }, false);

    // 商品を削除するボタン
    const orderRemove = document.createElement('button');
    orderRemove.value  = key;
    orderRemove.textContent = '×';
    orderRemove.classList.add('bottun');
    orderRemove.classList.add('remove');
    orderRemove.addEventListener('click', function(event) {
      let result = window.confirm("Are you sure you want to remove this item?");
      if (result) {
        let key = event.target.value;
        removeItem(key);
        document.getElementById('orderItem-' + key).remove();
        document.getElementById('hqr-list-for-customer-total').textContent = calcTotal();
      }
    }, false);

    // ボタンをまとめるコンテナ
    const orderButtons = document.createElement('div');
    orderButtons.classList.add('orderButtons');
    if (itemDefs[key].fluctuation === true) {
      orderButtons.appendChild(orderCount);
      orderButtons.appendChild(orderIncrease);
      orderButtons.appendChild(orderDecrease);
    }
    orderButtons.appendChild(orderRemove);

    // アイテムを組み立てる
    orderItemLeft.appendChild(orderImg);
    orderItemLeft.appendChild(orderName);
    if (itemDefs[key].fluctuation === true) {
      orderItemLeft.appendChild(orderPriceContainer);
    }
    orderItemRight.appendChild(orderButtons);
    orderItem.appendChild(orderItemLeft);
    orderItem.appendChild(orderItemRight);
    //箱に中身を入れる
    orderItems.appendChild(orderItem);
  });
  return orderItems;
}




//============================================================
// ショップ向け注文リスト

// 使用するグローバル変数
// items
// itemDefs

const hqrListForShop = () => {

  // リスト全体のコンテナ
  const container = document.createElement('div');
  container.id = 'hqr-list-for-shop-container';

  // 閉じるボタン
  const closeButton = document.createElement('button');
  closeButton.classList.add('hqr-list-for-customer-button');
  closeButton.id = 'closeButton';
  closeButton.textContent = 'Close';
  let close = () => { document.getElementById('hqr-list-for-shop-container').remove(); };
  closeButton.addEventListener('click', close, false);

  // リスト
  let tableHTML = '';
  tableHTML += '<table class="hqr-list-for-shop">';
  tableHTML += '<caption>注文リスト</caption>';
  Object.keys(items).forEach(function (key) {
    if(itemDefs[key].fluctuation === true) {
      tableHTML += 
        '<tr>' +
        '<td>' + itemDefs[key].name['ja'] + '</td>' +
        '<td>' + items[key].count + '</td>';
        '</tr>';
    } else {
      tableHTML += '<tr><td colspan="2">' + itemDefs[key].name['ja'] + '</td></tr>';
    }
  });
  tableHTML += '</table>';

  // コンテナに詰め込む
  container.innerHTML = tableHTML;
  container.appendChild(closeButton);

  // bodyに追加する
  document.body.appendChild(container);
}





//============================================================
// ページ表示の直後にやること
// JavaScriptとしては全ての定数や関数の最後に記述すること
//
// セッションストレージの読み込み
// 入力項目の初期化
// DOMイベントの登録

// console.log('file: "hqr-js-prepare.js"');

//------------------------------------------------------------
// lang
// URLからページの言語を割り出す
const lang = location.pathname.split('/').slice(-1)[0].split(',')[0];

// ついでにページのlangを変更する
document.body.lang = lang;
document.getElementById('spa_panel_main').lang = lang;



//------------------------------------------------------------
// データの定義を読み込む
import itemDefinition from "./hqr-js-itemDataBound.js";
// ゆくゆくは JSON で分離して fetch で読み込む
// import itemDefinition from "./hqr-js-itemDataSeparated.js";


//------------------------------------------------------------
// ストレージの名前を決めておく
const strageOrderList = 'hqr-order';//注文内容の記録
const strageItemDefinition = 'hqr-item-def';//アイテムの定義


//------------------------------------------------------------
// ストレージに保存してあるアイテムの定義データをストレージから取り出す
// ストレージが null なら itemDefinition の内容をコピー＆ストレージに保存する
let json = sessionStorage.getItem(strageItemDefinition);
if (json === null) {
  var itemDefs = itemDefinition;
  sessionStorage.setItem(strageItemDefinition, JSON.stringify(itemDefs));
} else {
  var itemDefs = JSON.parse(json);
}


//------------------------------------------------------------
// ストレージに保存してある注文データ(JSON)を取り出す
var items = getJsonFromSessionStorage (strageOrderList);

//------------------------------------------------------------
// 現時点での合計金額を表示する（注文データがあることが前提）
updateItemCount();




//============================================================
// モジュールの外で使えるようにglobalThisに追加する
// （このjsファイルは type="module" で呼び出されるので）
globalThis.hqrListForCustomer = hqrListForCustomer;
globalThis.increaseItem = increaseItem;
globalThis.updateItemCount = updateItemCount;

