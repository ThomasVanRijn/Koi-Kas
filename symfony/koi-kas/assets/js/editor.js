/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import Image from '@editorjs/image';
import $ from 'jquery';
import ajax from '@codexteam/ajax';
const editor = new EditorJS({
    tools: {
        header: {
            class: Header,
            inlineToolbar: ['bold']
        },
        image: {
            class: Image,
            config: {
                endpoints: {
                    byFile: 'http://127.0.0.1:8000/admin/uploadFile', // Your backend file uploader endpoint
                    // byUrl: 'http://localhost:8008/fetchUrl', // Your endpoint that provides uploading by Url
                }
                // uploader: {
                //     /**
                //      * Upload file to the server and return an uploaded image data
                //      * @param {File} file - file selected from the device or pasted by drag-n-drop
                //      * @return {Promise.<{success, file: {url}}>}
                //      */
                //     uploadByFile(file){
                //         // your own uploading logic here
                //         debugger;
                //         MyAjax(file).json()
                //     },
                //
                // }
            }
        }
    }
});



function MyAjax(file){
    debugger;
    $.ajax({
        type:'post',
        url: 'uploadFile',
        data: {file: file},
        cache:false,
        processData: false,  // tell jQuery not to process the data
        contentType: false, // and this
        success:function(data){
            debugger;
            console.log("success");
            console.log(data);
        },
        error: function(jqXhr, textStatus, errorMessage){
            debugger;
            console.log("error");
            console.log(jqXhr, textStatus, errorMessage);
        }
    })
}
console.log('Hello Webpack Encore! Edit me in assets/js/editor.js');
