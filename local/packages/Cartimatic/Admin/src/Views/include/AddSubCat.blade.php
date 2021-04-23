
    <div class="modal-box" id="{{$id}}">
        <a href="#" class="js-modal-close close">×</a>

        <div class="modal-body">
            <div class="edit-photo-poup">
                <h3 style="color: #0080e8">{{$title}}</h3>
                <p class="mt10" style="width: 315px;line-height: normal">{{$name}}</p>
                <div class="wall-photos">
                    <div class="photoDetail">
                        <div class="form-container">
                            <div class="saveArea">
                                <input required="required" type="text" id="edited_name" name="sub_cate" value="" placeholder="" class="storeInput cata-input"><div class="clrfix"></div>
                                {!! Form::submit($submitButtonText, ['class' => '']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#edited_name').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z]+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }

            e.preventDefault();
            return false;
        });

    </script>

