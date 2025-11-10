@php
    if (!isset($actionBtnIcon)) {
        $actionBtnIcon = null;
    } else {
        $actionBtnIcon = $actionBtnIcon . ' fa-fw';
    }
    if (!isset($modalClass)) {
        $modalClass = null;
    }
    if (!isset($btnSubmitText)) {
        $btnSubmitText = trans('laravelroles::laravelroles.modals.btnConfirm');
    }
@endphp
<div class="modal fade modal-{{ $modalClass }}" id="{{ $formTrigger }}" role="dialog" aria-labelledby="{{ $formTrigger }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header row g-0 align-items-center w-100 m-0 {{$modalClass}}">
                <div class="col-11 text-start">
                    <h5 class="modal-title">Confirm</h5>
                </div>
                <div class="col-1 text-end">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

            </div>




            <div class="modal-body">
                <p class="text-start">
                    Are you sure?
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-outline pull-left float-left" type="button" data-dismiss="modal" >
                    <i class="fa fa-fw fa-close" aria-hidden="true"></i>
                    {!! trans('laravelroles::laravelroles.modals.btnCancel') !!}
                </button>
                <button class="btn btn-{{ $modalClass }} pull-right" id="confirm" type="button" >
                    <i class="fa {{  $actionBtnIcon  }}" aria-hidden="true"></i>
                    {{ $btnSubmitText }}
                </button>
            </div>
        </div>
    </div>
</div>
