@extends('Store::layouts.static')
@section('content')
    <div class="sale-channel-container">
        <div class="page-heading">General</div>
        <div class="row">
            <div class="col-md-3">
                <div class="sc_left">
                    <p>Cartimatic will use this information for billing and to setup your store.</p>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <div class="sc-right-content">
                    <div class="general-store-block">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="text" class="form-control" placeholder="xyz@domain.com">
                            </div>

                            <div class="form-group">
                                <label>Street Address</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Apt, suite, etc. (optional)</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Postal / ZIP code</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country</label>
                                        <select class="form-control">
                                            <option>Pakistan</option>
                                            <option>Pakistan</option>
                                            <option>Pakistan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State / Province</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-3">
                <div class="sc_left">
                    <div class="sub-heading">Store details</div>
                    <p>Cartimatic and your customers will use this information to contact you.</p>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-1">
                <div class="sc-right-content">
                    <div class="general-store-block">
                        <form>
                            <div class="form-group">
                                <label class="with-info">Store Name
                                    <span class="info-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                    <span class="info-tooltip">Your store name will be used as your URL</span>
                                </label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label><b>URL Preview</b></label>
                                <div class="url-preview">
                                    <div class="img">
                                        <img class="url-img" src="{{asset('local/public/assets/gentelella/images/images-new/url-preview-img.jpg')}}" alt="">
                                    </div>
                                    <div class="title-text">title text</div>
                                    <div class="url-text">url text</div>
                                </div>
                                <div class="url-preview">
                                    <div class="img">
                                        <img class="url-img" src="{{asset('local/public/assets/gentelella/images/images-new/url-preview-img.jpg')}}" alt="">
                                    </div>
                                    <div class="title-text">title text</div>
                                    <div class="url-text">url text</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="with-info">Store Logo
                                    <span class="info-icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                                    <span class="info-tooltip">Your store name will be used as your URL</span>
                                </label>
                                <br>
                                <label>Upload your store logo</label>
                                <input type="file" name="file" id="file" class="inputfile" />
                                <label class="inputlabel" for="file"><strong>Browse</strong></label>
                            </div>

                            <div class="form-group">
                                <div class="img">
                                    <img src="{{asset('local/public/assets/gentelella/images/images-new/upload-file-img.jpg')}}" alt="">
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
