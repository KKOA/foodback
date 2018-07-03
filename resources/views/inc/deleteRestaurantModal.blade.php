<div class="modal" id="confirm">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h4 class="modal-title text-center">Delete Confirmation</h4>
                <button type="button" class="close rounded-circle" data-dismiss="modal" aria-hidden="true">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body text-center">
                {{-- <p> --}}
                    Are you sure you, want to delete<br><strong>'{{$restaurant->name}}'</strong>?<br>
                    <strong>This change cannot undone.</strong>
                {{-- </p> --}}
            </div>
            <div class="modal-footer">
                {{-- <div class='row'>
                    <button type="button" class="btn btn-sm btn-default col-md-5" data-dismiss="modal">
                        Close <i class="fas fa-times"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-success col-md-5" id="delete-btn">
                        Delete <i class="fas fa-trash-alt"></i>
                    </button>
                </div> --}}
            {{-- </div> --}}
            {{-- center-offset-xs-1 col-11 --}}
            <hr>
            <div class='container-fluid'>
                <div class='row'>
                    <button type="button" class="btn btn-sm btn-dark center-offset-xs-1 col center-offset-md-1 mb-3" data-dismiss="modal">
                        Close <i class="fas fa-times"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-success center-offset-xs-1 col center-offset-md-1 mb-3" id="delete-btn">
                        Delete <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
            </div>

        </div>
    </div>
</div>
