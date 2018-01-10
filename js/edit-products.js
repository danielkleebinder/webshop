/*
 Created on : 20.04.2015
 Author     : Daniel Kleebinder
 
 Please do not copy or redistribute this source!
 */

var cropper;
window.addEventListener('DOMContentLoaded', function () {
    var image = document.getElementById('image');

    var dataX = document.getElementById('data-x');
    var dataY = document.getElementById('data-y');
    var dataWidth = document.getElementById('data-width');
    var dataHeight = document.getElementById('data-height');

    cropper = new Cropper(image, {
        viewMode: 3,
        dragMode: 'crop',
        autoCropArea: 1,
        restore: false,
        modal: false,
        guides: true,
        highlight: true,
        cropBoxMovable: false,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: true,
        crop: function (e) {
            var data = e.detail;
            dataX.value = Math.round(data.x);
            dataY.value = Math.round(data.y);
            dataWidth.value = Math.round(data.width);
            dataHeight.value = Math.round(data.height);
        }
    });
});