<script src="{{ URL::asset('js/editor/tinymce.min.js') }}" charset="utf-8"></script>
<script>
    tinymce.init({
        selector: ".tinymce",
        language: "pl",
        skin: "oxide",
        content_css: 'default',
        branding: false,
        height: 400,
        plugins: "searchreplace autolink directionality visualblocks visualchars fullscreen image link gallery media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern filemanager code",
        toolbar1: "formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | gallery | code",
        relative_urls: false,
        image_advtab: true,
        content_style:
            "@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');"
    });
</script>
