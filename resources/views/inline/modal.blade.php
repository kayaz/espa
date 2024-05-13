@push('scripts')
    <link href="{{ asset('/css/less-partials/inline.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/editor/tinymce.min.js') }}" charset="utf-8"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <div class="modal" id="inlineModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edytuj</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Zamknij"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="inlineform">
                        <form method="POST" action="" enctype="multipart/form-data" id="inlineForm" name="inlineForm">
                            @csrf
                            <div class="form-group form-modaltytul">
                                <label for="modaltytul" class="required">Tytuł</label>
                                <div class="formRight"> <input type="text" name="modaltytul" id="modaltytul" value="" size="83" class="validate[required] form-control"> </div>
                            </div>
                            <div class="form-group form-modaleditor mt-3">
                                <label for="modaleditor" class="required">Tekst</label>
                                <div class="formRight"> <input type="text" name="modaleditor" id="modaleditor" value="" size="83" class="validate[required] form-control"> </div>
                            </div>
                            <div class="form-group form-modaleditortext mt-3">
                                <label for="modaleditortext" class="required">Treść</label>
                                <div class="fullformRowtext"> <textarea name="modaleditortext" id="modaleditortext" rows="19" cols="100" class="editor"></textarea> </div>
                            </div>
                            <div class="form-group form-modallink mt-3">
                                <label for="modallink" class="required">Button link</label>
                                <div class="formRight"> <input type="text" name="modallink" id="modallink" value="" size="83" class="validate[required] form-control"> </div>
                            </div>
                            <div class="form-group form-modallinkbutton mt-3">
                                <label for="modallinkbutton" class="required">Button tekst</label>
                                <div class="formRight"> <input type="text" name="modallinkbutton" id="modallinkbutton" value="" size="83" class="validate[required] form-control"> </div>
                            </div>
                            <div class="form-group form-file mt-3">
                                <label for="file" class="optional">Obrazek - szerokość: 1920 px - wysokość: 960 px</label>
                                <div class="formRight"> <input type="hidden" name="MAX_FILE_SIZE" value="16777216" id="MAX_FILE_SIZE"> <input type="file" name="file" id="file" class="validate[checkFileType[jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF]] form-control"> </div>
                            </div>
                            <div class="form-group form-file_alt mt-3">
                                <label for="file_alt" class="required">Tytuł obrazka</label>
                                <div class="formRight"> <input type="text" name="file_alt" id="file_alt" value="" size="83" class="validate[required] form-control"> </div>
                            </div>
                            <div class="form-group form-hidden">
                                <div class="formRight"> <input type="hidden" name="id_element" value="1" id="id_element"> </div>
                            </div>
                            <div> <input type="submit" name="submit" id="submit" value="Zapisz" class="btn btn-primary mt-4"> </div>
                        </form>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function process_response(obj) {
            const f = $("#inlineModal form");
            const newObj = Object.keys(obj).filter(e => obj[e] !== null).reduce((o, e) => {
                o[e] = obj[e];
                return o;
            }, {});
            ['id', 'id_place', 'sort', 'file'].forEach(i => delete newObj[i]);
            $.each(newObj, function(key, val) {
                f.find('[name="' + key + '"]').val(val.{{$current_locale}});
            });
        }

        function cleanModal(){$("#inlineForm, #inlineForm .form-group, .progress").removeAttr("style");$("#inlineForm")[0].reset();$("#file").val("");$("#id_element").val("");$("label[for='file']").text("Obrazek");$(".modal h5").text("Edytuj");$(".alert").remove()}

        const baseURL = 'https://volumetric.4dl.pl/';
        const myModal = document.getElementById('inlineModal');
        const is_editor_active = function (b) {
            if (typeof tinyMCE == "undefined") {
                return false
            }
            let editor;
            if (typeof b == "undefined") {
                editor = tinyMCE.activeEditor
            } else {
                editor = tinyMCE.EditorManager.get(b)
            }
            if (editor == null) {
                return false
            }
            return !editor.isHidden()
        };

        myModal.addEventListener('shown.bs.modal', function (j)
        {
            cleanModal();
            const form = document.forms.namedItem("inlineForm");
            let f = j.relatedTarget.dataset.inline,
                k = j.relatedTarget.dataset.place,
                c = j.relatedTarget.dataset.imgwidth,
                g = j.relatedTarget.dataset.imgheight,
                h = j.relatedTarget.dataset.hideinput;

            if (h)
            {
                const b = h.split(",");
                let d;
                for (d = 0; d < b.length; ++d)
                {
                    $(".form-" + b[d]).hide()
                }
            }
            if (f !== undefined)
            {
                $.ajax({
                    type: "GET",
                    url: baseURL + "inline/loadinline/" + f,
                    success: function (i) {
                        if (i.error) {
                            alert(i.error);
                            myModal.toggle();
                        } else {
                            process_response(i);
                            if (c !== undefined) {
                                $("label[for='file']").append(" - szerokość: " + c + " px")
                            }
                            if (g !== undefined) {
                                $("label[for='file']").append(" - wysokość: " + g + " px")
                            }
                            $("#id_element").val(f);

                            const e = h.split(",");
                            if (e.indexOf("modaleditortext") !== -1) {} else {

                                document.addEventListener('focusin', function (e) { if (e.target.closest('.tox-tinymce-aux, .moxman-window, .tam-assetmanager-root') !== null) { e.stopImmediatePropagation(); console.log('wylaczone')} });

                                tinymce.init({
                                    selector: ".editor",
                                    language: "pl",
                                    skin: "oxide",
                                    content_css: 'default',
                                    branding: false,
                                    height: 400,
                                    plugins: "searchreplace autolink directionality visualblocks visualchars fullscreen image link gallery media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern filemanager",
                                    toolbar1: "formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat | gallery",
                                    relative_urls: false,
                                    image_advtab: true,
                                    auto_focus: 'modaleditortext'
                                });
                            }
                        }
                    },
                    error: function () {
                        alert("Wystąpił błąd połączenia z bazą")
                    }
                })
            } else {
                if (c !== undefined)
                {
                    $("label[for='file']").append(" - szerokość: " + c + " px")
                }
                if (g !== undefined)
                {
                    $("label[for='file']").append(" - wysokość: " + g + " px")
                }
                $(".modal h5").text("Dodaj nowy element")
            }
            //console.log('Form shown');

            form.addEventListener( "submit", function (event) {
                //console.log('Submit form');
                event.preventDefault();
                event.stopImmediatePropagation();

                let formData = new FormData($(this)[0]);
                for(let pair of formData.entries()) {
                    //console.log(pair[0]+ ', '+ pair[1]);
                }

                //console.log(formData.get("id_element"));

                let n, type, l = formData.get("id_element");
                if (l === "") {
                    n = baseURL + "inline/create/" + k;
                    type = 'POST';
                    //console.log("Dodaje nowy element")
                    //console.log(n)
                } else {
                    n = baseURL + "inline/update/" + l;
                    type = 'POST';
                    //console.log("Aktualizuje element")
                    //console.log(n)
                }
                const i = $("input[type=file]")[0].files[0];
                if (i !== undefined) {
                    formData.append("obrazek", i);
                    formData.append("obrazek_width", c);
                    formData.append("obrazek_height", g)
                }
                if (is_editor_active()) {
                    const e = tinyMCE.activeEditor.getContent();
                    formData.set("modaleditortext", e)
                }
                formData.append("locale", "{{$current_locale}}");
                $.ajaxSetup({headers: {"X-CSRF-TOKEN": $('input[name="_token"]').val()}});
                $.ajax({
                    type        : type,
                    url         : n,
                    data        : formData,
                    enctype     : "multipart/form-data",
                    cache       : false,
                    contentType : false,
                    processData : false,
                    beforeSend: function () {
                        $(".modal form").hide();
                        $(".modal h5").text("Zapisuje...");
                        $(".modal .progress").css({
                            display: "flex"
                        })
                    },
                    success: function (p) {
                        if (p.status === "success") {
                            $(".progress").removeAttr("style");

                            if (p.items.modaltytul) {
                                $("[data-modaltytul=" + p.item + "]").text(p.items.modaltytul.{{$current_locale}})
                            }
                            if (p.items.modaleditor) {
                                $("[data-modaleditor=" + p.item + "]").text(p.items.modaleditor.{{$current_locale}})
                            }
                            if (p.items.modaleditortext) {
                                $("[data-modaleditortext=" + p.item + "]").html(p.items.modaleditortext.{{$current_locale}})
                            }
                            if (p.items.modallink) {
                                $("[data-modallink=" + p.item + "]").attr("href", p.items.modallink.{{$current_locale}})
                            }
                            if (p.items.modallinkbutton) {
                                $("[data-modalbutton=" + p.item + "]").text(p.items.modallinkbutton.{{$current_locale}})
                            }
                            if (p.items.file_alt) {
                                $("[data-img=" + p.item + "]").attr("alt", p.items.file_alt.{{$current_locale}})
                            }
                            if (p.items.file) {
                                $("[data-img=" + p.item + "]").attr("src", baseURL + "uploads/inline/" + p.items.file)
                            }
                            if (p.items.id_place) {
                                $("[data-placeholder=" + p.items.id_place + "]").append(p.html)
                            }

                            $(".modal h5").text("Gotowe");

                            $(".inlineform").append('<div class="alert alert-success border-0" role="alert">Edycja zakończona sukcesem!</div>');
                            setTimeout(function () {
                                $('.modal .close').click();
                                setTimeout(function () {
                                    cleanModal();
                                }, 200)
                            }, 2000)
                        } else {
                            //console.log("Coś poszło nie tak :)")
                        }
                    },
                    error: function () {
                        alert("Wystąpił bład połączenia z bazą");
                        $('.modal .close').click();
                    }
                });
                return false

            });
        })

        myModal.addEventListener('hide.bs.modal', function (j)
        {
            //console.log('Close modal');
            cleanModal();
            if (is_editor_active())
            {
                tinymce.activeEditor.destroy();
            }
        });
    </script>
@endpush

