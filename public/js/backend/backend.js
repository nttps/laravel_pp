var strToThaiSlug = function (str) {
    return str.replace(/\s+/g, '-') // Replace spaces with -
        .replace('%', 'เปอร์เซนต์') // Translate some charactor
        .replace(/[^\u0E00-\u0E7F\w\-]+/g, '') // Remove all non-word chars
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
        .replace(/^-+/, '') // Trim - from start of text
        .replace(/-+$/, '');
}

var editor_config = {
    path_absolute: "",
    menubar: false,
    branding: false,
    selector: ".mce",
    plugins: [
        "advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools",
        " lists link media noneditable powerpaste preview",
        " searchreplace table template textcolor visualblocks"
    ],
    toolbar: 'mybutton link media | undo redo | formatselect fontselect fontsizeselect forecolor | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fullscreen code ',
    custom_colors: false,
    powerpaste_allow_local_images: true,
    content_css: [
        '//fonts.googleapis.com/css?family=Kanit:300,300i,400,400i'
    ],

    relative_urls: false,
    height: 300,
    setup: function (editor) {
        editor.addButton('mybutton', {
            text: 'Add Image',
            icon: 'image',
            onclick: function () {
                tinyMCE.execCommand('mceImage')
            }
        });
    },
    file_browser_callback: function (field_name, url, type, win) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
        if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
        } else {
            cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.open({
            file: cmsURL,
            title: 'Media',
            width: x * 0.8,
            height: y * 0.8,
            resizable: "yes",
            close_previous: "no"
        });
    }
};


$("#short_description").keyup(function () {

    $("#short_description_count").text("Characters left: " + (150 - $(this).val().length));
    if ($(this).val().length == 150) {
        $("#short_description_count").css({
            'color': 'red',
            'font-weight': 'bold'
        });
    }
});
