function addlocpar(par, val){ //funzione per aggiungere un parametro get
    if(location.search == ''){
        location.search += '?' + par + '=' +val;
    } else{
        var s = location.search.substr(1);
        var v = s.split('&');  // Suddivido la stringa e creo un vettore.
        var found = false;

        for(var i=0; i< v.length; i++){
            var p = v[i].split('=');
            if (p[0] == par){
                p[1] = val;
                v[i] = p.join('=');
                found=true;
                //break;
            }
        }

        if(!found){
            v.push(par + '=' + val);
        }
        s = '?' + v.join('&');
        location.search = s;
    }
    return false;
}

function ajax(url, dest){ //funzione per richieste ajax
    var xhttp;
    if(window.XMLHttpRequest){
        // Codice per IE7+, Firefox, Chrome, Opera, Safari
        xhttp=new XMLHttpRequest();
    } else{
        // Codice per IE5, IE6
        xhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState==4 && xhttp.status==200){
            document.getElementById(dest).innerHTML = xhttp.responseText;
            //dim(dest);
        }
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}
