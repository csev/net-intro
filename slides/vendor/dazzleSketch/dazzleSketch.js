'use strict';

// This file is Copyright 2015 - Charles R. Severance (@drchuck) and
// made available under the MIT license.

// Create a div the size of the window and hide it behind the content
// until it is time to draw
// http://intridea.github.io/sketch.js/
$(document).ready( function() {
    var w = $(window).width();
    var h = $(window).height();
    if ( h > 30 ) h = h - 20;

    // Take 20px off because of the bottom bar of the browser
    $('body').append("<div id='sketchDiv' style=\"position:fixed; top:1px; left:1px; z-index:-2\">\
        <canvas id='sketchCanvas' height=\""+h+"px\" width=\""+(w-5)+"px\"> \
            Your browser does not support HTML5 Canvas.\
        </canvas> \
      </div>");
    $(function() {
        $('#sketchCanvas').sketch();
    });
});

// Global variable for pen size
var currentSketchSize = 2; 

// Grab and process a few keypreses

// ctrl-` (next to the 1) erase and turn off drawing

// ctrl-1 Yellow
// ctrl-2 Green
// ctrl-3 Cyan
// ctrl-4 Red
// ctrl-5 White
// ctrl-6 Blue
// ctrl-7 Magenta
// ctrl-8 Black

// ctrl-- Make pen smaller
// ctrl-= Make pen larger

// http://stackoverflow.com/questions/8510470/capturing-document-level-keypress-events-with-javascript
// https://github.com/SethosII/reveal.js-jump-plugin/blob/master/jump/jump.js

//
$(document).keypress(function(event)
{
    var isSpecialKey = event.shiftKey || event.ctrlKey || event.altKey || event.metaKey;
    var w = event.which;

    var colors = ['#ff0', '#0f0', '#0ff', '#f00', '#fff', '#00f', '#f0f', '#000'];
    var sizes = [1, 2, 3, 5, 8, 10, 15];

    if ( event.ctrlKey && w >=49 && w < 49+colors.length) {
        var newcolor = colors[w-49];
        $('#sketchCanvas').sketch().set('color', newcolor);
        $('#sketchDiv').css( "zIndex", 2);
    } else if ( w == 96 && event.ctrlKey ) {
        // It would be nice to move this code into sketch.js
        var ske = $('#sketchCanvas').sketch();
        ske.actions = [];
        ske.action = [];

        $('#sketchCanvas').sketch().redraw();
        $('#sketchDiv').css( "zIndex", -2);
    } else if ( w == 31 && event.ctrlKey ) { // Minus key
        if ( currentSketchSize > 0 ) {
            currentSketchSize--;
            $('#sketchCanvas').sketch().set('size', sizes[currentSketchSize]);
        }
    } else if ( w == 61 && event.ctrlKey ) { // Equals key
        if ( currentSketchSize < sizes.length-1 ) {
            currentSketchSize++;
            $('#sketchCanvas').sketch().set('size', sizes[currentSketchSize]);
        }
    }
});

