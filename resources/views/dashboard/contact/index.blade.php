@extends('dashboard.base')

@section('content')

    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <div class="overview-wrap">
                        <button class="au-btn au-btn-icon au-btn--blue">
                            <i class="zmdi zmdi-plus"></i>add contact</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Chioma Chuckula
                            </strong>
                            <small>
                                    <span class="badge badge-primary float-right mt-1">Prospect</span>
                                </small>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <h5 class="text-sm-center mt-2 mb-1">08137507119</h5>
                                <div class="location text-sm-center">
                                    chiomachukuwka@gmail.com</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <a href="#" class="btn btn-success btn-sm">
                                    Send SMS
                                </a>
                                <a href="#" class="btn btn-primary btn-sm">
                                    Send Email
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest pr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Profile Card</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img class="rounded-circle mx-auto d-block" src="images/icon/avatar-01.jpg" alt="Card image cap">
                                <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                                <div class="location text-sm-center">
                                    <i class="fa fa-map-marker"></i> California, United States</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <a href="#">
                                    <i class="fa fa-facebook pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest pr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title mb-3">Profile Card</strong>
                        </div>
                        <div class="card-body">
                            <div class="mx-auto d-block">
                                <img class="rounded-circle mx-auto d-block" src="images/icon/avatar-01.jpg" alt="Card image cap">
                                <h5 class="text-sm-center mt-2 mb-1">Steven Lee</h5>
                                <div class="location text-sm-center">
                                    <i class="fa fa-map-marker"></i> California, United States</div>
                            </div>
                            <hr>
                            <div class="card-text text-sm-center">
                                <a href="#">
                                    <i class="fa fa-facebook pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin pr-1"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-pinterest pr-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection