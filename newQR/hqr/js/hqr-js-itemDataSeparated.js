

var itemDataSeparated = {};


// fetch('https://grow-up-webmarketing.co.jp/demo/hqr/insyoku20191214/hqr/items.json') // フルパス
// fetch('../../../../hqr/items.json') // 相対パス（files/1/data/が基準）
// fetch('./hqr/items.json') // 相対パス（サイトのルートが基準）
// fetch('../items.json') // 相対パス（サイトのルート/hqr/js/が基準）
fetch('../items.json')
  .then(function(response) {
    return response.json();
  })
  .then(function(myJson) {
    console.log(JSON.stringify(myJson));
    itemDataSeparated = myJson;
  });



export default itemDataSeparated;
