<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="modal fade" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">{{ $description }}</div>
                @if ($name=='logoutModal')
                    <div class="modal-footer">
                        <form action="/logout" method="POST">
                            @csrf
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">YES</button>
                    </div>
                @endif
            </div>
        </div>
    </div> 
</div>
