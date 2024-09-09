function tinyInit(id) {
    tinymce.init({
        selector: id,
        theme: "modern",
        skin: 'light',
        width: "98%",
        height: 450,
        menubar: false,
        plugins: [
            "advlist autolink link image lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
            "table contextmenu directionality emoticons paste textcolor filemanager template"],
        templates: "/wat-bo/assets/templates/templates.php",
        image_advtab: true,
        toolbar: "undo redo styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print table preview | forecolor backcolor code",
        forced_root_block: false,
        force_br_newlines: true,
        force_p_newlines: false,
        relative_urls: false,     
        remove_script_host: false
    });
}