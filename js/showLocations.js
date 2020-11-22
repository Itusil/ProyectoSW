// set endpoint and your access key
var ip = '134.201.250.155'
var access_key = '8249e3ea791e655e29fb052c47a228e8';

// get the API result via jQuery.ajax
$.ajax({
    url: 'http://api.ipstack.com/' + ip + '?access_key=' + access_key,   
    dataType: 'jsonp',
    success: function(json) {

        // output the "capital" object inside "location"
        alert(json.location.capital);
        
    }
});