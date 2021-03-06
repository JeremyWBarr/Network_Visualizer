window.addEventListener('load', function(){

    // Process errors and messages embedded in the url.
    var error = getParameterByName('error');
    var message = getParameterByName('message');

    if(error !== ''){
        var errorElm = document.getElementById('errors');
        errorElm.style.display = 'block';
        errorElm.innerHTML = error;
    }

    if(message !== ''){
        var messageElm = document.getElementById('messages');
        messageElm.style.display = 'block';
        messageElm.innerHTML = message;
    }
});

/**
 * Extracts GET parameters from the url. Taken from: 
 * https://stackoverflow.com/a/901144
 * 
 * @param name The parameter to extract.
 * @param url The url to extract it from (optional; defaults to current
 *            window location).
 * @return The value associated with the given parameter.
 */
function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return '';
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}