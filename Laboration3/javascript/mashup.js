"use strict";

var maps = {
      
    init:function(e){
        var markers = []; 

        var roadTraffic = [];
        var publicTransport = [];
        var plannedInterference = [];
        var other = [];
        var allCategories = [];

        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 62, lng: 15},
            zoom: 5
        });

        // $.ajax istället? alternativ i php. 
        $.getJSON('./src/model/sr.json', function(result){
           
           for(var i=0; i > result.messages.length; i++){
                console.log(result.messages[0].category);
                if(result.messages[i].category == 0){
                    roadTraffic.push(result.messages[i]);
                }else if(result.messages[i].category == 1){
                    publicTransport.push(result.messages[i]);
                }else if(result.messages[i].category == 2){
                    plannedInterference.push(result.messages[i]);
                }else if(result.messages[i].category == 3){
                    other.push(result.messages[i]);
                }

                allCategories.push(result.messages[i]);
             } 
        });


        var marker = new google.maps.Marker({
            position: {lat: 63.049167633056641, lng: 18.325990676879883},
            map: map,
            title: 'HEJ'
        });

        markers.push(marker);


        var marker1 = new google.maps.Marker({
            position: {lat: 62.06, lng: 18.325990676879883},
            map: map,
            title: 'HEJ'
        });

        markers.push(marker1);
            var infowindow = new google.maps.InfoWindow();
            for(var i=0; i < markers.length; i++){
            maps.markerWindow('hoho',markers[i], map, infowindow); 
        }

        //Gör marker osynliga 
        var b = document.getElementById("b");
        b.onclick = function(){
            marker.setVisible(false);
        }; 


        var a = document.getElementById("HEJ");
        a.onclick = function(){
            var name = marker.getTitle();
            google.maps.event.trigger(marker, "click");
            marker1.infoWindow1.close();
        //   window.alert(aa);
    
        };

    },

    markerWindow:function(cont, marker, map, infowindow){
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.setContent(cont);
            infowindow.open(map, marker);
        });

    },
        
};
    
window.onload = maps.init;