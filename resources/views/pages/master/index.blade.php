@extends('pages.master.master')
@section('index')
    <div class="content-wrapper">
        <div class="container-full">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="box">
                            <div class="box-header">
                                <h2 class="box-title">
                                    What is UPortal?
                                </h2>
                            </div>
                            <div class="box-body py-20">
                                <img src="{{ asset('backend/images/uportal_banner.png') }}" alt="UPortal"
                                    class="img-fluid">
                                <h4 class="text-white my-20 font-weight-500">Hussle free access to university portal. The
                                    chatbot that can help students who don't have enough money to buy a data promo. Students
                                    can access the announcements, activities, resources, etc. without going to school
                                    portal.</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-12">
                        <div class="box bg-info bg-img">
                            <div class="box-body text-center">
                                <div class="max-w-500 mx-auto">
                                    <h2 class="text-white mb-20 font-weight-500">The Team behind UPortal</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="box overflow-hidden">
                                    <div class="box-body pb-0">
                                        <div>
                                            <h2 class="text-white mb-0 font-weight-500">Jay-Are Ocero</h2>
                                            <p class="text-mute mb-0 font-size-20">Developer - BSIT</p>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <img src="{{ asset('backend/images/ja.jpg') }}" alt="Jay-Are Ocero"
                                            class="img-fluid rounded-circle mx-auto d-block" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="box overflow-hidden">
                                    <div class="box-body pb-0">
                                        <div>
                                            <h2 class="text-white mb-0 font-weight-500">Shanon Jamlan</h2>
                                            <p class="text-mute mb-0 font-size-20">Project Manager - BSIT</p>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <img src="{{ asset('backend/images/shan.jpg') }}" alt="Shanon Jamlan"
                                            class="img-fluid rounded-circle mx-auto d-block" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="box overflow-hidden">
                                    <div class="box-body pb-0">
                                        <div>
                                            <h2 class="text-white mb-0 font-weight-500">Jay-Ann Arquiza</h2>
                                            <p class="text-mute mb-0 font-size-20">QA/Tester - BSIT</p>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <img src="{{ asset('backend/images/jay-ann.jpg') }}" alt="Jay-Ann Arquiza"
                                            class="img-fluid rounded-circle mx-auto d-block" style="width: 200px">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="box overflow-hidden">
                                    <div class="box-body pb-0">
                                        <div>
                                            <h2 class="text-white mb-0 font-weight-500">Ryza Sapitanan</h2>
                                            <p class="text-mute mb-0 font-size-20">QA/Tester - BSIT</p>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <img src="{{ asset('backend/images/ryza.jpg') }}" alt="Ryza Sapitanan"
                                            class="img-fluid rounded-circle mx-auto d-block" style="width: 200px">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    </div>
@endsection
