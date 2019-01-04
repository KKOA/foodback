{{-- <div class="modal" id="confirmLogout"> --}}
<div class="modal" id="{{$modal['id']}}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h4 class="modal-title text-center mx-auto">{{$modal['HeaderText']}}</h4>
                    <button type="button" class="close rounded-circle" data-dismiss="modal" aria-hidden="true">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-center">{{$modal['BodyText']}}</div>
                <div class="modal-footer">
                    <div class='container-fluid'>
                        <div class='row'>
                            <button type="button" class="btn btn-sm btn-dark center-offset-xs-1 col center-offset-md-1 mb-3" data-dismiss="modal">
                                    {{$modal['cancelBtn']}} <i class="fas fa-times"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-success center-offset-xs-1 col center-offset-md-1 mb-3" id="logout-btn">
                                    {{$modal['confirmationBtn']}} <i class="fas fa-sign-out-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>