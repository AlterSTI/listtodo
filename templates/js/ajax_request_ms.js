/** start class Reqest **/
/*async(url, data, callback)*//*асинхронный запрос с колбеком*/
/*reqest(url, data, element)*//*асинхронный запрос без колбека*/

function MsRequest(url){
    if(!url) return error.log();
    this._url = url;
}
MsRequest.prototype.request = function (data, element){
    var xhr = new XMLHttpRequest();
    xhr.open('POST', this._url, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState != 4) return;
        if (xhr.status != 200) {
            element.innerHTML = xhr.status + ': ' + xhr.statusText;
        } else {
            element.innerHTML = xhr.responseText;
        }
    };
    element.innerHTML =  'Загрузка данных...';
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(data);
};
MsRequest.prototype.async = function(data, callback, file){
    let
        xhr  = new XMLHttpRequest(),
        form = new FormData();

    for (let key in data){
        if (data.hasOwnProperty(key)){
            form.append(key, data[key]);
        }
    }
    if (typeof file === 'object'){
        form.append('FILE', file);
    }
    xhr.open('POST', this._url, true);
    xhr.onreadystatechange = function(){
        if (xhr.readyState === 4 && xhr.status === 200){
            callback.call(xhr.responseText);
        }
    };
    xhr.send(form);
};
/** start class msReqest **/