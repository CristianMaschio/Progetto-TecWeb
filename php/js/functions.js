//funzione per aggiungere un parametro get
function addlocpar(par, val){
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
