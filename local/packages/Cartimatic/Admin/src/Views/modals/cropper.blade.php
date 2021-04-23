{{--

    * Created by   :  Muhammad Yasir
    * Project Name : shalmi
    * Product Name : PhpStorm
    * Date         : 05-May-16 11:59 AM
    * File Name    : cropper

--}}
<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
     tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form" action="{{$url}}" enctype="multipart/form-data"
                  method="post" role="form" data-toggle="validator">
                {!! csrf_field() !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <label for="avatarInput">Local upload</label>
                            <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div id="loadingIconCropper" style="text-align:center; display: none;"><img src="{!! asset('local/public/images/loading.gif') !!}" title="Loading please wait.."/></div>

                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg"></div>
                                <div class="avatar-preview preview-md"></div>
                                <div class="avatar-preview preview-sm"></div>
                            </div>
                        </div>

                        <div class="row avatar-btns">
                            <div class="col-md-9">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="-90" title="Rotate -90 degrees">Rotate Left
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="-15">-15deg
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="-30">-30deg
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="-45">-45deg
                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="90" title="Rotate 90 degrees">Rotate Right
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="15">15deg
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="30">30deg
                                    </button>
                                    <button type="button" class="btn btn-primary" data-method="rotate"
                                            data-option="45">45deg
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-default btn-block avatar-save">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </form>
        </div>
    </div>
</div><!-- /.modal -->

<!-- Loading state -->
<div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
<!-- Cropping modal -->
