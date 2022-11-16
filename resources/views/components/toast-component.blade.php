@if(session('toast_error') !== null)
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast fade show  border-1 border-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto text-danger">IWMS API Error</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               {{ session('toast_error') }}
            </div>
        </div>
    </div>
@endif
