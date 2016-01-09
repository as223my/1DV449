"use strict";

var maps = {

    markers : [], 
    map : {},
    lat : 62,
    lng : 15,
    zoom : 5,
      
    init:function(e){

        var roadTraffic = [];
        var publicTransport = [];
        var plannedInterference = [];
        var other = [];
        var allCategories = [];

        maps.map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: maps.lat, lng: maps.lng},
            zoom: maps.zoom
        });

        // Hämtar och sorterar innehållet från sr-api (sparat i json fil). 
        $.ajax({ 
                type: 'GET', 
                url: './src/model/sr.json', 
                dataType:'json',
                success: function (result) { 
                    for (var i=0; i < result.messages.length; i++){ 
                        var split1 = result.messages[i].createddate.split("(");
                        var split2 = split1[1].split("+");
                        var date = split2[0];  
                        result.messages[i].createddate = date; 
                    }  

                    //sorterar på datum. 
                    result.messages.sort(function(y, x){
                        return x.createddate - y.createddate;
                    });

                    for(var i=0; i < result.messages.length; i++){
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
                }
            });

        // Styr vad som händer vid val av kategori att visa. 
        $("#roadTraffic").click(function(){
             maps.markerAndListHandler(roadTraffic); 
        });

        $("#publicTransport").click(function(){
             maps.markerAndListHandler(publicTransport); 
        });

        $("#plannedInterference").click(function(){
             maps.markerAndListHandler(plannedInterference); 
        });

        $("#other").click(function(){
             maps.markerAndListHandler(other); 
        });

        $("#allCategories").click(function(){
             maps.markerAndListHandler(allCategories); 
        });
    },

    /* Lägger till markörer över händelser på kartan med tillhörande infowindow, 
    skapar också en lista över händelser som är kopplade till markörerna. */  
    markerAndListHandler:function(category){
        maps.deleteMarker();
        $("#list ul li").remove();

        maps.map.setZoom(maps.zoom);
        maps.map.setCenter(new google.maps.LatLng(maps.lat, maps.lng));

        for(var i=0; i < category.length; i++){
                maps.addMarker(category[i]); 
            } 
        maps.infoWindow(category); 
         $("a").click(function(){
             var content = $(this).text();

            for(var i=0; i < maps.markers.length; i++){
                if(maps.markers[i].title == content){
                    google.maps.event.trigger(maps.markers[i], "click");
                }  
            }   
        });
    },

    addMarker:function(content){ 
        var marker = new google.maps.Marker({
            position: {lat: content.latitude, lng: content.longitude},
            map: maps.map,
            title: content.title
        });
        $("#list ul").append('<li><a href=#>'+ content.title +'</a></li>');
        maps.markers.push(marker); 
    },

    infoWindow:function(content){
        var infowindow = new google.maps.InfoWindow();
        for(var i=0; i < maps.markers.length; i++){
            maps.clickWindow(content[i],maps.markers[i], infowindow);
        }
    },

    clickWindow:function(content, marker, infowindow){
        var date = new Date(parseInt(content.createddate));
        var split = date.toString().split(" ", 5);
        var dateString = split[2] + ' ' + split[1] + ' ' + split[3] + ', ' + split[4]; 

        var categories = ["vägtrafik", "kollektivtrafik", "planerad störning", "övrigt", "alla kategorier"]; 
        var chooseCategorie = categories[content.category]; 
        
        var contentString = '<h3>' + content.title + '</h3> <ul><li> Datum: ' + dateString + ' </li><li>Kategori: ' + chooseCategorie + '</li></ul><p>' + content.description + '</p>'; 
        google.maps.event.addListener(marker, 'click', function() {
            maps.map.setZoom(9);
            maps.map.setCenter(marker.getPosition());
            infowindow.setContent(contentString);
            infowindow.open(maps.map, marker);
        });
    },

    deleteMarker:function(){
       for(var i=0; i < maps.markers.length; i++){
                maps.markers[i].setMap(null); 
        } 
        maps.markers = []; 
    },       
};
    
window.onload = maps.init;